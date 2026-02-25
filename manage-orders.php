
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đơn hàng - Hot Wheels Store</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        header {
            background: #f28f16;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        
        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        h2 {
            color: #f28f16;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        
        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        
        th {
            background: #f28f16;
            color: white;
        }
        
        .btn {
            background: #f28f16;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        
        .btn-danger {
            background: red;
        }
        
        select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <header>Quản lý Đơn hàng</header>

    <div class="container">
        <h2>Danh Sách Đơn Hàng</h2>
        <table>
            <thead>
                <tr>
                    <th>Mã Đơn Hàng</th>
                    <th>Khách Hàng</th>
                    <th>Địa Chỉ</th>
                    <th>Số Điện Thoại</th>
                    <th>Tổng Tiền</th>
                    <th>Phương Thức Thanh Toán</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody id="order-list">
                <!-- Danh sách đơn hàng sẽ được cập nhật tại đây -->
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2025 Hot Wheels Store. All Rights Reserved.</p>
    </footer>

    <script>
        let orderHistory = JSON.parse(localStorage.getItem('orderHistory')) || [];

        function renderOrders() {
            const orderList = document.getElementById('order-list');
            orderList.innerHTML = '';
            orderHistory.forEach((order, index) => {
                orderList.innerHTML += `
                    <tr>
                        <td>${order.orderId}</td>
                        <td>${order.name}</td>
                        <td>${order.address}</td>
                        <td>${order.phone}</td>
                        <td>${order.totalPrice.toLocaleString()} VND</td>
                        <td>${order.paymentMethod}</td>
                        <td>
                            <select onchange="updateOrderStatus(${index}, this.value)">
                                <option value="Chờ xử lý" ${order.status === 'Chờ xử lý' ? 'selected' : ''}>Chờ xử lý</option>
                                <option value="Đang giao" ${order.status === 'Đang giao' ? 'selected' : ''}>Đang giao</option>
                                <option value="Hoàn thành" ${order.status === 'Hoàn thành' ? 'selected' : ''}>Hoàn thành</option>
                                <option value="Hủy" ${order.status === 'Hủy' ? 'selected' : ''}>Hủy</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteOrder(${index})">Xóa</button>
                        </td>
                    </tr>
                `;
            });
            localStorage.setItem('orderHistory', JSON.stringify(orderHistory));
        }

        function updateOrderStatus(index, status) {
            orderHistory[index].status = status;
            localStorage.setItem('orderHistory', JSON.stringify(orderHistory));
            renderOrders();
        }

        function deleteOrder(index) {
            if (confirm("Bạn có chắc muốn xóa đơn hàng này?")) {
                orderHistory.splice(index, 1);
                localStorage.setItem('orderHistory', JSON.stringify(orderHistory));
                renderOrders();
            }
        }

        document.addEventListener('DOMContentLoaded', renderOrders);
    </script>
</body>

</html>