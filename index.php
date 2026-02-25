<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hot Wheels Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        header {
            background: #f78902;
            color: white;
            padding: 1px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .logo img {
            width: 200px;
            height: 100px;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            gap: 1px;
            padding: 0;
            margin: 0;
        }
        
        nav ul li a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            padding: 15px 25px;
            background-color: #f56d0531;
            border-radius: 4px;
            transition: all 0.3s ease;
            display: inline-block;
            position: relative;
        }
        
        nav ul li a::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: white;
            position: absolute;
            left: 50%;
            bottom: -5px;
            transition: width 0.3s ease, left 0.3s ease;
        }
        
        nav ul li a:hover::after,
        nav ul li a:focus::after,
        nav ul li a.active::after {
            width: 100%;
            left: 0;
        }
        
        .hero {
            width: 100%;
            height: 600px;
            position: relative;
            text-align: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            background: url('https://preview.redd.it/this-expansion-is-hype-asf-v0-9sb5625nel7c1.png?width=3840&format=png&auto=webp&s=d7e6af79b6d0fac8684f4c03a2727d976e07f67e') no-repeat center center/cover;
            transition: background-image 1s ease-in-out;
        }
        
        .btn {
            padding: 10px 30px;
            background: #eb8f0e;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background: #c15013;
            transform: scale(1.05);
        }
        
        .product-list {
            text-align: center;
            padding: 50px 20px;
            background: white;
        }
        
        .product {
            display: inline-block;
            margin: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 220px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .product:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        
        .product img {
            width: 100%;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }
        
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }
        
        .search-bar {
            margin: 20px auto;
            width: 50%;
            text-align: center;
        }
        
        .search-bar input {
            padding: 10px;
            width: 70%;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        /* Combo Section */
        
        .combo-section {
            padding: 50px 20px;
            background: #f4f4f4;
            text-align: center;
        }
        
        .combo-section h2 {
            font-size: 2em;
            margin-bottom: 30px;
        }
        
        .combo-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(to right, #a3d8f4 40%, #ffd60a 40%, #ffd60a 60%, #00c4b4 60%);
            padding: 20px;
            border-radius: 10px;
            max-width: 1200px;
            margin: 0 auto 30px auto;
            position: relative;
            overflow: hidden;
        }
        
        .combo-text {
            flex: 1;
            text-align: left;
            padding: 20px;
        }
        
        .combo-text h3 {
            font-size: 2.5em;
            margin: 0;
            color: #333;
        }
        
        .combo-text p {
            font-size: 1.1em;
            color: #555;
            margin: 10px 0 20px;
        }
        
        .combo-text .btn {
            background: #333;
            color: white;
            padding: 10px 40px;
            border-radius: 25px;
        }
        
        .combo-images {
            flex: 2;
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: relative;
        }
        
        .combo-images img {
            max-width: 100%;
            height: auto;
        }
        
        .combo-main-img {
            width: 300px;
            z-index: 2;
        }
        
        .combo-side-img {
            width: 200px;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        
        .combo-bottom-img {
            width: 200px;
            position: absolute;
            bottom: 10px;
            right: 10px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo"><img src="https://th.bing.com/th/id/OIP.0CxUTbfrZAqoYzp3sGVrMgHaEK?rs=1&pid=ImgDetMain"></div>
        <nav>
            <ul>
                <li><a href="#home" class="active">Trang chủ</a></li>
                <li><a href="products.php">Sản phẩm</a></li>
                <li><a href="about.php">Giới thiệu</a></li>
                <li><a href="contact.php">Liên hệ</a></li>
                <li><a href="delivery.php">Chính sách giao hàng</a></li>
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

    <section class="hero">
        <h1>Siêu xe Hot Wheels – Đam mê không giới hạn!</h1>
        <p>Mua sắm những mẫu xe Hot Wheels mới nhất với giá hấp dẫn.</p>
        <a href="products.html" class="btn">Xem ngay</a>
    </section>

    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Tìm kiếm sản phẩm...">
    </div>

    <section class="product-list" id="products">
        <h2>Sản phẩm nổi bật</h2>
        <div class="products-container">
            <div class="product">
                <img src="https://i.pinimg.com/originals/78/2c/5e/782c5e8d55bf6435058047216873ac19.jpg" alt="Hot Wheels Camaro">
                <h3>Hot Wheels Camaro</h3>
                <p>Giá: <span class="price">250,000</span> VND</p>
                <button class="btn add-to-cart" data-id="1" data-name="Hot Wheels Camaro" data-price="250000">Mua ngay</button>
            </div>
            <div class="product">
                <img src="https://th.bing.com/th/id/R.5bbe360db7ee6da8b5e5ccd3dce01039?rik=0MRaR8zX4D7erg&riu=http%3a%2f%2fkmjdiecastii.com%2fcdn%2fshop%2fproducts%2f21c192purpleUSA.jpg%3fv%3d1654520555&ehk=c8UmACVaSCkUrKs%2bx7OZNTzgKrDrew3x5ENV5iAy27o%3d&risl=&pid=ImgRaw&r=0"
                    alt="Hot Wheels Mustang">
                <h3>Hot Wheels Mustang</h3>
                <p>Giá: <span class="price">280,000</span> VND</p>
                <button class="btn add-to-cart" data-id="2" data-name="Hot Wheels Mustang" data-price="280000">Mua ngay</button>
            </div>
            <div class="product">
                <img src="https://m.media-amazon.com/images/I/71G0KhcilRL._AC_SL1000_.jpg" alt="Hot Wheels Ferrari">
                <h3>Hot Wheels Ferrari</h3>
                <p>Giá: <span class="price">320,000</span> VND</p>
                <button class="btn add-to-cart" data-id="3" data-name="Hot Wheels Ferrari" data-price="320000">Mua ngay</button>
            </div>
            <div class="product">
                <img src="https://i.pinimg.com/originals/78/2c/5e/782c5e8d55bf6435058047216873ac19.jpg" alt="Hot Wheels Camaro">
                <h3>Hot Wheels Camaro</h3>
                <p>Giá: <span class="price">250,000</span> VND</p>
                <button class="btn add-to-cart" data-id="1" data-name="Hot Wheels Camaro" data-price="250000">Mua ngay</button>
            </div>
            <div class="product">
                <img src="https://th.bing.com/th/id/R.5bbe360db7ee6da8b5e5ccd3dce01039?rik=0MRaR8zX4D7erg&riu=http%3a%2f%2fkmjdiecastii.com%2fcdn%2fshop%2fproducts%2f21c192purpleUSA.jpg%3fv%3d1654520555&ehk=c8UmACVaSCkUrKs%2bx7OZNTzgKrDrew3x5ENV5iAy27o%3d&risl=&pid=ImgRaw&r=0"
                    alt="Hot Wheels Mustang">
                <h3>Hot Wheels Mustang</h3>
                <p>Giá: <span class="price">280,000</span> VND</p>
                <button class="btn add-to-cart" data-id="2" data-name="Hot Wheels Mustang" data-price="280000">Mua ngay</button>
            </div>
        </div>
    </section>

    <!-- Combo Sản Phẩm Đặc Biệt -->
    <section class="combo-section">
        <h2>Combo Sản Phẩm Đặc Biệt</h2>
        <!-- Combo 1: Combo Siêu Tốc Hot Wheels -->
        <div class="combo-banner">
            <div class="combo-text">
                <h3>Combo Siêu Tốc Hot Wheels</h3>
                <p>Khám phá bộ sưu tập Hot Wheels đỉnh cao với các mẫu xe Monster Truck, xe đua và nhiều hơn nữa!</p>
                <button class="btn add-to-cart" data-id="4" data-name="Combo Siêu Tốc Hot Wheels" data-price="750000">Mua Ngay</button>
            </div>
            <div class="combo-images">
                <img class="combo-main-img" src="https://m.media-amazon.com/images/I/71G0KhcilRL._AC_SL1000_.jpg" alt="Monster Truck">
                <img class="combo-side-img" src="https://i.pinimg.com/originals/78/2c/5e/782c5e8d55bf6435058047216873ac19.jpg" alt="Side Cars">
                <img class="combo-bottom-img" src="https://th.bing.com/th/id/R.5bbe360db7ee6da8b5e5ccd3dce01039?rik=0MRaR8zX4D7erg&riu=http%3a%2f%2fkmjdiecastii.com%2fcdn%2fshop%2fproducts%2f21c192purpleUSA.jpg%3fv%3d1654520555&ehk=c8UmACVaSCkUrKs%2bx7OZNTzgKrDrew3x5ENV5iAy27o%3d&risl=&pid=ImgRaw&r=0"
                    alt="Bottom Cars">
            </div>
        </div>

        <!-- Combo 2: Combo Phụ Kiện Đỉnh Cao -->
        <h2>Combo phụ kiện đỉnh cao</h2>
        <div class="products-container">
            <div class="product">
                <img src="https://i.pinimg.com/originals/78/2c/5e/782c5e8d55bf6435058047216873ac19.jpg" alt="Hot Wheels Camaro">
                <h3>Hot Wheels Camaro</h3>
                <p>Giá: <span class="price">250,000</span> VND</p>
                <button class="btn add-to-cart" data-id="1" data-name="Hot Wheels Camaro" data-price="250000">Mua ngay</button>
            </div>
            <div class="product">
                <img src="https://th.bing.com/th/id/R.5bbe360db7ee6da8b5e5ccd3dce01039?rik=0MRaR8zX4D7erg&riu=http%3a%2f%2fkmjdiecastii.com%2fcdn%2fshop%2fproducts%2f21c192purpleUSA.jpg%3fv%3d1654520555&ehk=c8UmACVaSCkUrKs%2bx7OZNTzgKrDrew3x5ENV5iAy27o%3d&risl=&pid=ImgRaw&r=0"
                    alt="Hot Wheels Mustang">
                <h3>Hot Wheels Mustang</h3>
                <p>Giá: <span class="price">280,000</span> VND</p>
                <button class="btn add-to-cart" data-id="2" data-name="Hot Wheels Mustang" data-price="280000">Mua ngay</button>
            </div>
            <div class="product">
                <img src="https://m.media-amazon.com/images/I/71G0KhcilRL._AC_SL1000_.jpg" alt="Hot Wheels Ferrari">
                <h3>Hot Wheels Ferrari</h3>
                <p>Giá: <span class="price">320,000</span> VND</p>
                <button class="btn add-to-cart" data-id="3" data-name="Hot Wheels Ferrari" data-price="320000">Mua ngay</button>
            </div>
            <div class="product">
                <img src="https://i.pinimg.com/originals/78/2c/5e/782c5e8d55bf6435058047216873ac19.jpg" alt="Hot Wheels Camaro">
                <h3>Hot Wheels Camaro</h3>
                <p>Giá: <span class="price">250,000</span> VND</p>
                <button class="btn add-to-cart" data-id="1" data-name="Hot Wheels Camaro" data-price="250000">Mua ngay</button>
            </div>
            <div class="product">
                <img src="https://th.bing.com/th/id/R.5bbe360db7ee6da8b5e5ccd3dce01039?rik=0MRaR8zX4D7erg&riu=http%3a%2f%2fkmjdiecastii.com%2fcdn%2fshop%2fproducts%2f21c192purpleUSA.jpg%3fv%3d1654520555&ehk=c8UmACVaSCkUrKs%2bx7OZNTzgKrDrew3x5ENV5iAy27o%3d&risl=&pid=ImgRaw&r=0"
                    alt="Hot Wheels Mustang">
                <h3>Hot Wheels Mustang</h3>
                <p>Giá: <span class="price">280,000</span> VND</p>
                <button class="btn add-to-cart" data-id="2" data-name="Hot Wheels Mustang" data-price="280000">Mua ngay</button>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 Hot Wheels Store. All Rights Reserved.</p>
    </footer>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Cập nhật số lượng giỏ hàng
        function updateCartCount() {
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cart-count').innerText = count;
        }

        // Thêm sản phẩm vào giỏ hàng
        function addToCart(id, name, price) {
            const product = cart.find(item => item.id === id);
            if (product) {
                product.quantity += 1;
            } else {
                cart.push({
                    id,
                    name,
                    price: parseInt(price),
                    quantity: 1
                });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            alert(`Đã thêm ${name} vào giỏ hàng!`);
        }

        // Xử lý sự kiện thêm vào giỏ hàng
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                const name = button.dataset.name;
                const price = button.dataset.price;
                addToCart(id, name, price);
            });
        });

        // Tìm kiếm sản phẩm
        document.getElementById('search-input').addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.product').forEach(product => {
                const name = product.querySelector('h3').textContent.toLowerCase();
                product.style.display = name.includes(searchTerm) ? 'inline-block' : 'none';
            });
        });

        // Slideshow cho hero section
        const images = [
            'https://images.squarespace-cdn.com/content/v1/54dabf38e4b06c67da923d72/1608051787886-QH3A99XUF4WXGNEE5SP5/hw5.jpg?format=1500w',
            'https://images.squarespace-cdn.com/content/v1/51b3dc8ee4b051b96ceb10de/9b983ed2-b393-4e90-a6ce-c0818a41f16d/HotWheelsUnleashedLooneyTunes.jpg?format=1000w',
            'https://www.nbc.com/sites/nbcblog/files/2023/06/Hot-Wheels-102-Promo.jpg',
            'https://fs-prod-cdn.nintendo-europe.com/media/images/10_share_images/games_15/nintendo_switch_4/2x1_NSwitch_HotWheelsUnleashed2Turbocharged_image1600w.jpg'
        ];

        let index = 0;

        function changeHeroBackground() {
            document.querySelector('.hero').style.backgroundImage = `url(${images[index]})`;
            index = (index + 1) % images.length;
        }

        setInterval(changeHeroBackground, 4000);

        // Khởi tạo
        document.addEventListener('DOMContentLoaded', () => {
            updateCartCount();
        });

        // Smooth scroll cho navigation
        document.querySelectorAll('nav a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId.startsWith('#')) {
                    document.querySelector(targetId).scrollIntoView({
                        behavior: 'smooth'
                    });
                } else {
                    window.location.href = targetId;
                }
            });
        });
    </script>
</body>

</html>