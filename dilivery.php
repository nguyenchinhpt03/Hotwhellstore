<?php
session_start();
?><!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm - Hot Wheels Store</title>
    <link rel="stylesheet" href="delivery.css">
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
                <li><a href="delivery.php" class="active">Chính sách giao hàng</a></li>
                <li><a href="cart.php">🛒 Giỏ hàng (<span id="cart-count">0</span>)</a></li>


            </ul>
        </nav>
    </header>
    <main>
        <!-- Section Đổi trả áp dụng -->
        <section class="policy-section">
            <h2>ĐIỀU KIỆN ÁP DỤNG</h2>
            <div class="policy-item">
                <img src="https://via.placeholder.com/100" alt="Delivery Truck">
                <h3>Đổi Tương Áp Dụng</h3>
                <p>Chính sách giao hàng của Mykingdom áp dụng cho tất cả các đơn hàng được khách hàng mua sản phẩm tại website: mykingdom.com.vn</p>
            </div>
            <div class="policy-item">
                <img src="https://via.placeholder.com/100" alt="Global Packages">
                <h3>Phạm Vi Áp Dụng</h3>
                <p>Chính sách giao hàng của Mykingdom áp dụng cho tất cả các tỉnh thành trên toàn quốc.</p>
            </div>
            <div class="shipping-cost">
                <div class="cost-item">
                    <img src="https://via.placeholder.com/80" alt="Free Shipping">
                    <h4>Đơn hàng từ 500k trở lên</h4>
                    <p class="highlight">MIỄN PHÍ VẬN CHUYỂN</p>
                    <small>*Không áp dụng hình thức giao hỏa tốc 4 giờ</small>
                </div>
                <div class="cost-item">
                    <img src="https://via.placeholder.com/80" alt="Shipping Fee">
                    <h4>Đơn hàng dưới 500k</h4>
                    <p class="highlight">+ PHÍ VẬN CHUYỂN</p>
                    <small>*Mức phí sẽ được hiển thị đầy đủ tại đơn hàng chi tiết của khách trong quy trình hoàn tất</small>
                </div>
            </div>
        </section>

        <!-- Section Thời gian nhận hàng -->
        <section class="delivery-time-section">
            <h2>THỜI GIAN NHẬN HÀNG</h2>
            <div class="time-item">
                <img src="" alt="Express">
                <h4>Hỏa Tốc</h4>
                <p>4 Giờ</p>
                <small>*Tỉnh thành có Grab</small>
            </div>
            <div class="time-item">
                <img src="https://via.placeholder.com/50" alt="Inner City">
                <h4>Nội Thành</h4>
                <p>1-3 Ngày</p>
            </div>
            <div class="time-item">
                <img src="https://via.placeholder.com/50" alt="Outer City">
                <h4>Ngoại Thành</h4>
                <p>3-5 Ngày</p>
            </div>
            <div class="time-item">
                <img src="https://via.placeholder.com/50" alt="Remote Area">
                <h4>Liên Tỉnh</h4>
                <p>5-7 Ngày</p>
            </div>
        </section>

        <!-- Section Phương thức thanh toán -->
        <section class="payment-section">
            <h2>PHƯƠNG THỨC THANH TOÁN</h2>
            <div class="payment-item">
                <img src="https://via.placeholder.com/100" alt="Payment Methods">
                <p>Khách hàng có thể chọn 1 trong 3 hình thức</p>
                <div class="payment-methods">
                    <img src="https://via.placeholder.com/50" alt="Visa">
                    <img src="https://via.placeholder.com/50" alt="Mastercard">
                    <img src="https://via.placeholder.com/50" alt="JCB">
                    <img src="https://via.placeholder.com/50" alt="Napas">
                    <p>Một kết nối. Mọi thanh toán.</p>
                </div>
                <div class="cod">
                    <img src="https://via.placeholder.com/50" alt="COD">
                    <p>CASH ON DELIVERY</p>
                </div>
            </div>
        </section>
    </main>

    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML = "window.__CF$cv$params={r:'9309de0748e5ad9e',t:'MTc0NDcwMzU4Ni4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>


</body>

</html>