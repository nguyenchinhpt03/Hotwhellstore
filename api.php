<?php
// File: api.php
// -------------------------
// RESTful JSON API for HotwheelsStore
// Xử lý login, sản phẩm (GET/POST), đơn hàng (GET/POST)
// Author: Your Name

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/config.php';

// Đảm bảo client dùng đúng `action`
$action = $_REQUEST['action'] ?? '';

// Hàm kiểm tra admin
function requireAdmin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        http_response_code(403);
        echo json_encode(['error' => 'Forbidden']);
        exit;
    }
}

try {
    switch ($action) {
        // Đăng nhập
        case 'login':
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            if (empty($username) || empty($password)) {
                throw new Exception('Username và password bắt buộc');
            }
            $stmt = $mysqli->prepare("SELECT id, username, role, password_hash FROM users WHERE username = ? LIMIT 1");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res->num_rows === 1) {
                $user = $res->fetch_assoc();
                if (password_verify($password, $user['password_hash'])) {
                    $_SESSION['user_id']  = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role']     = $user['role'];
                    echo json_encode(['success' => true, 'role' => $user['role']]);
                } else {
                    throw new Exception('Sai mật khẩu');
                }
            } else {
                throw new Exception('Không tìm thấy user');
            }
            break;

        // Logout
        case 'logout':
            session_destroy();
            echo json_encode(['success' => true]);
            break;

        // Lấy tất cả sản phẩm
        case 'get_products':
            $stmt = $mysqli->prepare("SELECT id, name, price, image_url, description FROM products ORDER BY id DESC");
            $stmt->execute();
            $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            echo json_encode($products);
            break;

        // Thêm sản phẩm (admin only)
        case 'add_product':
            requireAdmin();
            // Validate inputs
            $name        = $_POST['name']        ?? '';
            $price       = $_POST['price']       ?? 0;
            $image_url   = $_POST['image_url']   ?? '';
            $description = $_POST['description'] ?? '';
            $stmt = $mysqli->prepare(
                "INSERT INTO products (name, price, image_url, description) VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param('sdss', $name, $price, $image_url, $description);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'product_id' => $stmt->insert_id]);
            } else {
                throw new Exception('Thêm sản phẩm thất bại: ' . $stmt->error);
            }
            break;

        // Lấy danh sách đơn hàng
        case 'get_orders':
            requireAdmin();
            $stmt = $mysqli->prepare(
                "SELECT o.order_id, o.customer_name, o.address, o.phone, o.total_price, o.payment_method,
                        JSON_ARRAYAGG(JSON_OBJECT(
                          'product_id', od.product_id,
                          'quantity', od.quantity,
                          'price', od.price
                        )) AS items
                 FROM orders o
                 JOIN order_details od ON o.order_id = od.order_id
                 GROUP BY o.order_id
                 ORDER BY o.created_at DESC"
            );
            $stmt->execute();
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            echo json_encode($orders);
            break;

        // Thêm đơn hàng
        case 'add_order':
            // Khách hàng có thể thêm đơn mà không cần login
            // Validate
            $customer_name  = $_POST['customer_name']  ?? '';
            $address        = $_POST['address']        ?? '';
            $phone          = $_POST['phone']          ?? '';
            $total_price    = $_POST['total_price']    ?? 0;
            $payment_method = $_POST['payment_method'] ?? '';
            $items          = json_decode($_POST['items'] ?? '[]', true);
            // Tạo order mới
            $stmt = $mysqli->prepare(
                "INSERT INTO orders (customer_name, address, phone, total_price, payment_method)
                 VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->bind_param('sssds', $customer_name, $address, $phone, $total_price, $payment_method);
            if (!$stmt->execute()) {
                throw new Exception('Thêm order thất bại: ' . $stmt->error);
            }
            $orderId = $mysqli->insert_id;
            // Chi tiết order
            $detailStmt = $mysqli->prepare(
                "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)"
            );
            foreach ($items as $it) {
                $detailStmt->bind_param('iiid', $orderId, $it['id'], $it['quantity'], $it['price']);
                $detailStmt->execute();
            }
            echo json_encode(['success' => true, 'order_id' => $orderId]);
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

// Đóng kết nối
$mysqli->close();
?>
