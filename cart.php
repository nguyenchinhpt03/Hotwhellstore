<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng - Hot Wheels Store</title>
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
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo img {
            width: 150px;
        }
        
        nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            gap: 15px;
            margin: 0;
            padding: 0;
        }
        
        nav ul li {
            display: inline;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        
        .search-bar {
            display: flex;
            align-items: center;
        }
        
        .search-bar input {
            padding: 8px;
            border: none;
            border-radius: 5px 0 0 5px;
            font-size: 14px;
            outline: none;
        }
        
        .search-bar button {
            padding: 8px 12px;
            background: #e07b00;
            color: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }
        
        .search-bar button:hover {
            background: #d06a00;
        }
        
        .btn {
            background: #f28f16;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s, box-shadow 0.3s;
        }
        
        .btn:hover {
            background: #e07b00;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }
        
        .cart {
            text-align: center;
            padding: 30px;
            background: white;
            max-width: 800px;
            margin: 30px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        
        .cart h1 {
            color: #ff4500;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table,
        th,
        td {
            border: 1px solid #ddd;
        }
        
        th,
        td {
            padding: 15px;
            text-align: center;
        }
        
        th {
            background: #f28f16;
            color: white;
        }
        
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.5s forwards;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }
        
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 10px;
            }
            nav {
                flex-direction: column;
                gap: 10px;
            }
            nav ul {
                flex-direction: column;
                align-items: center;
            }
            .search-bar {
                width: 100%;
                justify-content: center;
            }
            .search-bar input {
                width: 70%;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="logo"><img src="https://th.bing.com/th/id/OIP.0CxUTbfrZAqoYzp3sGVrMgHaEK?rs=1&pid=ImgDetMain"></div>
        <nav>
            <ul>
                <div class="search-bar">
                    <input type="text" id="search-input" placeholder="Tìm kiếm sản phẩm...">
                    <button onclick="searchProducts()">Tìm</button>
                </div>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="products.php">Sản phẩm</a></li>
                <li><a href="about.php">Giới thiệu</a></li>
                <li><a href="contact.php">Liên hệ</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="profile.php">Thông tin khách hàng</a></li>
                    <li><a href="logout.php">Đăng xuất</a></li>
                <?php else: ?>
                    <li><a href="login.php">Đăng nhập</a></li>
                    <li><a href="register.php">Đăng ký</a></li>
                <?php endif; ?>
                <li><a href="cart.php">🛒 Giỏ hàng (<span id="cart-count">0</span>)</a></li>
            </ul>
        </nav>
    </header>

    <section class="cart">
        <h1>Giỏ hàng của bạn</h1>
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody id="cart-items"></tbody>
        </table>
        <p>Tổng cộng: <strong id="total-price">0</strong> VND</p>
        <button class="btn" onclick="clearCart()">Xóa giỏ hàng</button>
        <button class="btn" onclick="window.location.href='checkout.php'">Thanh toán</button>
    </section>

    <footer>
        <p>© 2025 Hot Wheels Store. All Rights Reserved.</p>
    </footer>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function updateCartDisplay() {
            let cartItemsContainer = document.getElementById('cart-items');
            let totalPrice = 0;
            cartItemsContainer.innerHTML = '';
            cart.forEach((item, index) => {
                totalPrice += item.quantity * item.price;
                let row = document.createElement('tr');
                row.classList.add('fade-in');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.price.toLocaleString()} VND</td>
                    <td>
                        <button onclick="changeQuantity(${index}, -1)">-</button>
                        ${item.quantity}
                        <button onclick="changeQuantity(${index}, 1)">+</button>
                    </td>
                    <td><button onclick="removeFromCart(${index})">X</button></td>
                `;
                cartItemsContainer.appendChild(row);
            });
            document.getElementById('total-price').innerText = totalPrice.toLocaleString();
            updateCartCount();
        }

        function changeQuantity(index, change) {
            if (cart[index].quantity + change > 0) {
                cart[index].quantity += change;
            } else {
                removeFromCart(index);
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartDisplay();
        }

        function removeFromCart(index) {
            if (confirm("Bạn có muốn xóa sản phẩm này khỏi giỏ hàng?")) {
                cart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartDisplay();
            }
        }

        function clearCart() {
            if (confirm("Bạn có chắc muốn xóa toàn bộ giỏ hàng?")) {
                localStorage.removeItem('cart');
                cart = [];
                updateCartDisplay();
            }
        }

        function updateCartCount() {
            document.getElementById('cart-count').innerText = cart.reduce((sum, item) => sum + item.quantity, 0);
        }

        function searchProducts() {
            const query = document.getElementById('search-input').value.trim();
            if (query) {
                window.location.href = `products.html?search=${encodeURIComponent(query)}`;
            } else {
                window.location.href = 'products.html';
            }
        }

        document.addEventListener('DOMContentLoaded', updateCartDisplay);
    </script>
</body>

</html>