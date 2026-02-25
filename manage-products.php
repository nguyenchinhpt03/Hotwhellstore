<?php
session_start();
require_once 'api.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu người dùng là admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Xử lý thêm sản phẩm
if (isset($_POST['add_product'])) {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $description = $_POST['product_description'];

    // Xử lý ảnh upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $image_data = file_get_contents($_FILES['product_image']['tmp_name']);
    } else {
        $image_data = null; // Nếu không có ảnh
    }

    $stmt = $db->prepare("INSERT INTO products (name, price, image, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $price, $image_data, $description]);
}

// Xử lý cập nhật sản phẩm
if (isset($_POST['update_product'])) {
    $id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $description = $_POST['product_description'];

    // Xử lý ảnh nếu có upload mới
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $image_data = file_get_contents($_FILES['product_image']['tmp_name']);
        $stmt = $db->prepare("UPDATE products SET name = ?, price = ?, image = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $price, $image_data, $description, $id]);
    } else {
        // Nếu không upload ảnh mới, giữ ảnh cũ
        $stmt = $db->prepare("UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $price, $description, $id]);
    }
}

// Xử lý xóa sản phẩm
if (isset($_POST['delete_product'])) {
    $id = $_POST['product_id'];
    $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
}

// Lấy danh sách sản phẩm
$stmt = $db->query("SELECT * FROM products ORDER BY id ASC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>Quản lý Sản phẩm</header>
    
    <div class="container">
        <h2>Thêm Sản Phẩm</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Tên sản phẩm</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="product_price">Giá</label>
                <input type="number" id="product_price" name="product_price" required>
            </div>
            <div class="form-group">
                <label for="product_image">Ảnh sản phẩm</label>
                <input type="file" id="product_image" name="product_image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="product_description">Mô tả</label>
                <textarea id="product_description" name="product_description" required></textarea>
            </div>
            <button type="submit" name="add_product" class="btn">Thêm sản phẩm</button>
        </form>
        
        <h2>Danh Sách Sản Phẩm</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td>
                        <?php if ($product['image']): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($product['image']); ?>" alt="<?php echo $product['name']; ?>" class="product-image" style="max-width: 100px;">
                        <?php else: ?>
                            Không có ảnh
                        <?php endif; ?>
                    </td>
                    <td>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="text" name="product_name" value="<?php echo $product['name']; ?>" required>
                    </td>
                    <td>
                        <input type="number" name="product_price" value="<?php echo $product['price']; ?>" required>
                    </td>
                    <td>
                        <textarea name="product_description" required><?php echo $product['description']; ?></textarea>
                    </td>
                    <td>
                        <input type="file" name="product_image" accept="image/*">
                        <button type="submit" name="update_product" class="btn">Cập nhật</button>
                        <button type="submit" name="delete_product" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <footer>
        <p>© 2025 Hot Wheels Store. All Rights Reserved.</p>
    </footer>
</body>
</html>