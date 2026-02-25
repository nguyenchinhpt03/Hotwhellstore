<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm - Hot Wheels Store</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .product-detail {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            gap: 20px;
        }
        
        .product-detail img {
            width: 50%;
            border-radius: 10px;
        }
        
        .product-info {
            flex: 1;
        }
        
        .product-info h1 {
            color: #f28f16;
            margin-top: 0;
        }
        
        .product-info p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo"><img src="https://th.bing.com/th/id/OIP.0CxUTbfrZAqoYzp3sGVrMgHaEK?rs=1&pid=ImgDetMain"></div>
        <nav>
            <ul>
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
    <section class="product-detail">
        <img id="product-image" src="" alt="" loading="lazy">
        <div class="product-info">
            <h1 id="product-name"></h1>
            <p id="product-price"></p>
            <p id="product-description"></p>
            <button class="btn" onclick="addToCart()">Thêm vào giỏ hàng</button>
        </div>
    </section>
    <footer>
        <p>&copy; 2025 Hot Wheels Store. All Rights Reserved.</p>
    </footer>
    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('id');
        const products = Array.from({length: 40}, (_, i) => ({
            id: i + 1,
            name: `Hot Wheels Car ${i + 1}`,
            price: 150000 + (i % 5) * 10000,
            img: `https://cdn.shopify.com/s/files/1/0731/6514/4343/files/sieu-xe-kro-promo-car-${(i % 10) + 1}.jpg?v=1741257486&width=500`,
            description: `Đây là mô hình xe Hot Wheels Car ${i + 1} với thiết kế tinh xảo, phù hợp cho các nhà sưu tầm và người yêu thích xe mô hình. Xe được làm từ chất liệu cao cấp, bền bỉ và chi tiết sắc nét.`
        }));
        const product = products.find(p => p.id == productId);
        if (product) {
            document.getElementById('product-image').src = product.img;
            document.getElementById('product-image').alt = product.name;
            document.getElementById('product-name').innerText = product.name;
            document.getElementById('product-price').innerText = `${product.price.toLocaleString()} VND`;
            document.getElementById('product-description').innerText = product.description;
        } else {
            document.querySelector('.product-detail').innerHTML = '<p>Sản phẩm không tồn tại!</p>';
        }
        function addToCart() {
            if (!product) return;
            let item = cart.find(item => item.id === product.id);
            if (item) {
                item.quantity += 1;
            } else {
                cart.push({id: product.id, name: product.name, price: product.price, quantity: 1});
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            alert(`Đã thêm ${product.name} vào giỏ hàng!`);
        }
        function updateCartCount() {
            document.getElementById('cart-count').innerText = cart.reduce((sum, item) => sum + item.quantity, 0);
        }
        document.addEventListener('DOMContentLoaded', updateCartCount);
    </script>
    <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'933da807799fbf87',t:'MTc0NTI0NjYzNC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script>
</body>
</html>