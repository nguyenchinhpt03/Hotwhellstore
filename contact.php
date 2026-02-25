<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ - Hot Wheels Store</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
        }
        
        .contact-section {
            text-align: center;
            padding: 20px;
        }
        
        .contact-section h1 {
            color: #f28f16;
        }
        
        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }
        
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .contact-info {
            text-align: center;
            margin-top: 30px;
        }
        
        .map-container {
            text-align: center;
            margin-top: 20px;
        }
        
        .map-container iframe {
            width: 100%;
            height: 350px;
            border-radius: 10px;
            border: none;
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
                <li><a href="cart.php">🛒 Giỏ hàng (<span id="cart-count">0</span>)</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <section class="contact-section">
            <h1>Liên hệ với chúng tôi</h1>
            <p>Hãy để lại thông tin, chúng tôi sẽ liên hệ lại trong thời gian sớm nhất.</p>
            <form class="contact-form" onsubmit="submitContact(event)">
                <input type="text" placeholder="Họ và Tên" required>
                <input type="email" placeholder="Email" required>
                <input type="text" placeholder="Số điện thoại" required>
                <textarea rows="5" placeholder="Nội dung tin nhắn" required></textarea>
                <button class="btn" type="submit">Gửi ngay</button>
            </form>
        </section>

        <section class="contact-info">
            <h2>Thông tin cửa hàng</h2>
            <p>📍 Địa chỉ: Phố Nguyên Xá, Minh Khai, Bắc Từ Liêm, Hà Nội</p>
            <p>📞 Hotline: 0916 297 780</p>
            <p>📧 Email: hotwheels@store.com</p>
            <p>🕒 Giờ làm việc: 9:00 - 21:00 (Thứ 2 - Chủ Nhật)</p>
        </section>

        <section class="map-container">
            <h2>Vị trí cửa hàng</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4034529833714!2d106.6921007747185!3d10.778769659190832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752fc3df7a5b0f%3A0x9c9f71b8c64a572!2zMTIzIMSQxrDhu51uZyBIb3QgV2hlZWxzLCBRdeG6rW4gMSwgVFAuIEhDTSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1711612022885!5m2!1svi!2s"
                allowfullscreen="" loading="lazy">
            </iframe>
        </section>
    </div>

    <footer>
        <p>&copy; 2025 Hot Wheels Store. All Rights Reserved.</p>
    </footer>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function updateCartCount() {
            document.getElementById('cart-count').innerText = cart.reduce((sum, item) => sum + item.quantity, 0);
        }

        function submitContact(event) {
            event.preventDefault();
            alert('Tin nhắn đã được gửi!');
            event.target.reset();
        }

        document.addEventListener('DOMContentLoaded', updateCartCount);
    </script>
</body>

</html>