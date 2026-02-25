<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu - Hot Wheels Store</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #fffafa;
        }
        
        .about-section {
            text-align: center;
            padding: 20px;
            background: white;
        }
        
        .about-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .about-item {
            background: #f79c0b;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
        
        .about-item img {
            width: 100%;
            border-radius: 10px;
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

    <section class="about-section">
        <h2>Về Chúng Tôi</h2>
        <div class="about-grid">
            <div class="about-item">
                <img src="https://th.bing.com/th/id/R.8710ffb9efbafa03598a13da29a0c566?rik=vXMaRq1qUH5trw&riu=http%3a%2f%2fedensbouquet.com%2fwp-content%2fuploads%2f2012%2f08%2fjace-with-cars.jpg&ehk=SnrdfgBbYL9ae5xZ9T5D2eyfzaSNdBVhSDCw%2fCT8d9c%3d&risl=&pid=ImgRaw&r=0"
                    alt="Câu chuyện của chúng tôi">
                <h3>Câu chuyện của chúng tôi</h3>
                <p>Hot Wheels Store ra đời với niềm đam mê mãnh liệt dành cho xe mô hình. Chúng tôi cung cấp những sản phẩm chất lượng cao dành cho người sưu tầm và đam mê xe.</p>
            </div>
            <div class="about-item">
                <img src="https://i.ytimg.com/vi/djHbEzV9VX0/maxresdefault.jpg" alt="Chất lượng">
                <h3>Chất lượng hàng đầu</h3>
                <p>Chúng tôi cam kết mang đến những mẫu xe mô hình có chất lượng tốt nhất, đảm bảo sự hài lòng của khách hàng.</p>
            </div>
            <div class="about-item">
                <img src="https://th.bing.com/th/id/OIP.4-O9gQV9H7NHNGIrbQKmOwHaI1?pid=ImgDet&w=474&h=565&rs=1" alt="Dịch vụ">
                <h3>Dịch vụ tận tâm</h3>
                <p>Đội ngũ chăm sóc khách hàng của chúng tôi luôn sẵn sàng hỗ trợ và mang đến trải nghiệm mua sắm tốt nhất.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Hot Wheels Store. All Rights Reserved.</p>
    </footer>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function updateCartCount() {
            document.getElementById('cart-count').innerText = cart.reduce((sum, item) => sum + item.quantity, 0);
        }
        document.addEventListener('DOMContentLoaded', updateCartCount);
    </script>
</body>

</html>