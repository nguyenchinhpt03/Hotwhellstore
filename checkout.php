<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - Hot Wheels Store</title>
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
        
        .checkout {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        iframe {
            width: 100%;
            height: 300px;
            border: none;
            margin-top: 10px;
        }
        
        .summary {
            margin-top: 20px;
            padding: 15px;
            background: #f8f8f8;
            border-radius: 5px;
        }
        
        .payment-methods {
            margin-top: 20px;
            text-align: left;
        }
        
        .payment-methods h3 {
            text-align: center;
            color: #f28f16;
        }
        
        .payment-option {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px 0;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .payment-option:hover {
            background: #f8f8f8;
        }
        
        .payment-option input[type="radio"] {
            width: auto;
            margin-right: 10px;
        }
        
        .payment-details {
            margin-top: 15px;
            padding: 10px;
            background: #fff8e1;
            border-radius: 5px;
            display: none;
        }
        
        .payment-details img {
            max-width: 200px;
            margin-top: 10px;
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
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="products.php">Sản phẩm</a></li>
                <li><a href="about.php">Giới thiệu</a></li>
                <li><a href="contact.php">Liên hệ</a></li>
                <li><a href="cart.php">🛒 Giỏ hàng (<span id="cart-count">0</span>)</a></li>
            </ul>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Tìm kiếm sản phẩm...">
                <button onclick="searchProducts()">Tìm</button>
            </div>
        </nav>
    </header>

    <div class="checkout">
        <h2>Thông tin thanh toán</h2>
        <input type="text" id="name" placeholder="Họ và tên">
        <input type="text" id="address" placeholder="Địa chỉ giao hàng">
        <input type="text" id="phone" placeholder="Số điện thoại">
        <h3>Chọn địa điểm giao hàng:</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.505886611795!2d106.6823963153349!3d10.776889292320384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3b998cd5e5%3A0x2cb064d30de36c21!2sBen%20Thanh%20Market!5e0!3m2!1sen!2s!4v1645604696312!5m2!1sen!2s"
            allowfullscreen></iframe>

        <div class="payment-methods">
            <h3>Phương thức thanh toán</h3>
            <div class="payment-option">
                <input type="radio" name="payment" value="bank" id="bank" checked>
                <label for="bank">Chuyển khoản ngân hàng</label>
            </div>
            <div class="payment-option">
                <input type="radio" name="payment" value="momo" id="momo">
                <label for="momo">Ví MoMo</label>
            </div>
            <div class="payment-option">
                <input type="radio" name="payment" value="zalopay" id="zalopay">
                <label for="zalopay">ZaloPay</label>
            </div>
            <div class="payment-option">
                <input type="radio" name="payment" value="card" id="card">
                <label for="card">Thẻ tín dụng/Thẻ ghi nợ (Visa, MasterCard)</label>
            </div>
            <div class="payment-option">
                <input type="radio" name="payment" value="paypal" id="paypal">
                <label for="paypal">PayPal</label>
            </div>
            <div class="payment-option">
                <input type="radio" name="payment" value="cod" id="cod">
                <label for="cod">Thanh toán khi nhận hàng (COD)</label>
            </div>
            <div class="payment-details" id="payment-details"></div>
        </div>

        <div class="summary" id="order-summary"></div>
        <button class="btn" onclick="submitOrder()">Hoàn tất thanh toán</button>
    </div>

    <footer>
        <p>© 2025 Hot Wheels Store. All Rights Reserved.</p>
    </footer>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let orderHistory = JSON.parse(localStorage.getItem('orderHistory')) || [];

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

        function generateOrderId() {
            const timestamp = new Date().toISOString().replace(/[-:.T]/g, '').slice(0, 14); // Ví dụ: 20250407123456
            const randomNum = Math.floor(Math.random() * 1000); // Số ngẫu nhiên 0-999
            return `ORDER-${timestamp}-${randomNum}`;
        }

        function generateQRCode(phone, amount, orderId) {
            const content = `Thanh toán đơn hàng ${orderId} - Số tiền: ${amount.toLocaleString()} VND`;
            return `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(`${phone}|${amount}|${content}`)}`;
        }

        function showPaymentDetails() {
            const paymentMethod = document.querySelector('input[name="payment"]:checked').value;
            const paymentDetails = document.getElementById('payment-details');
            paymentDetails.style.display = 'block';

            const totalPrice = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
            const orderId = generateOrderId();

            let details = '';
            switch (paymentMethod) {
                case 'bank':
                    details = `
                        <p>Vui lòng chuyển khoản đến:</p>
                        <p><strong>Ngân hàng:</strong> BIDV Bank</p>
                        <p><strong>Số tài khoản:</strong> 2601666163</p>
                        <p><strong>Chủ tài khoản:</strong> NGUYEN DINH CHINH</p>
                        <p><strong>Nội dung CK:</strong> ${orderId}</p>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/BIDV_logo.svg/1200px-BIDV_logo.svg.png" alt="BIDV Logo">
                    `;
                    break;
                case 'momo':
                    details = `
                        <p>Thanh toán qua MoMo:</p>
                        <p><strong>Số điện thoại:</strong> 0916 297 780</p>
                        <p><strong>Số tiền:</strong> ${totalPrice.toLocaleString()} VND</p>
                        <p><strong>Nội dung CK:</strong> ${orderId}</p>
                        <img src="${generateQRCode('0916297780', totalPrice, orderId)}" alt="MoMo QR">
                    `;
                    break;
                case 'zalopay':
                    details = `
                        <p>Thanh toán qua ZaloPay:</p>
                        <p><strong>Số điện thoại:</strong> 0356849054</p>
                        <p><strong>Số tiền:</strong> ${totalPrice.toLocaleString()} VND</p>
                        <p><strong>Nội dung CK:</strong> ${orderId}</p>
                        <img src="${generateQRCode('0356849054', totalPrice, orderId)}" alt="ZaloPay QR">
                    `;
                    break;
                case 'card':
                    details = `
                        <p>Thanh toán bằng thẻ Visa/MasterCard:</p>
                        <p>Vui lòng nhập thông tin thẻ khi được chuyển hướng (giả lập).</p>
                    `;
                    break;
                case 'paypal':
                    details = `
                        <p>Thanh toán qua PayPal:</p>
                        <p>Email: <a href="mailto:payment@hotwheelsstore.com">payment@hotwheelsstore.com</a></p>
                    `;
                    break;
                case 'cod':
                    details = `
                        <p>Bạn sẽ thanh toán bằng tiền mặt khi nhận hàng.</p>
                    `;
                    break;
            }
            paymentDetails.innerHTML = details;
        }

        function submitOrder() {
            const name = document.getElementById('name').value;
            const address = document.getElementById('address').value;
            const phone = document.getElementById('phone').value;
            const paymentMethod = document.querySelector('input[name="payment"]:checked').value;
            const totalPrice = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
            const orderId = generateOrderId();

            if (name && address && phone && cart.length > 0) {
                const paymentNames = {
                    'bank': 'Chuyển khoản ngân hàng',
                    'momo': 'Ví MoMo',
                    'zalopay': 'ZaloPay',
                    'card': 'Thẻ tín dụng/Thẻ ghi nợ',
                    'paypal': 'PayPal',
                    'cod': 'Thanh toán khi nhận hàng'
                };

                const orderDetails = {
                    orderId,
                    name,
                    address,
                    phone,
                    totalPrice,
                    paymentMethod: paymentNames[paymentMethod],
                    items: [...cart],
                    timestamp: new Date().toISOString()
                };

                orderHistory.push(orderDetails);
                localStorage.setItem('orderHistory', JSON.stringify(orderHistory));

                document.getElementById('order-summary').innerHTML = `
                    <h3>Chi tiết đơn hàng</h3>
                    <p><strong>Mã đơn hàng:</strong> ${orderId}</p>
                    <p><strong>Họ và tên:</strong> ${name}</p>
                    <p><strong>Địa chỉ:</strong> ${address}</p>
                    <p><strong>Số điện thoại:</strong> ${phone}</p>
                    <p><strong>Tổng tiền:</strong> ${totalPrice.toLocaleString()} VND</p>
                    <p><strong>Phương thức thanh toán:</strong> ${paymentNames[paymentMethod]}</p>
                    ${paymentMethod === 'bank' || paymentMethod === 'momo' || paymentMethod === 'zalopay' ? `<p><strong>Nội dung CK:</strong> ${orderId}</p>` : ''}
                `;
                localStorage.removeItem('cart');
                cart = [];
                updateCartCount();
                alert(`Đơn hàng ${orderId} đã được đặt thành công! Vui lòng kiểm tra email hoặc thực hiện thanh toán theo hướng dẫn.`);
            } else {
                alert("Vui lòng nhập đầy đủ thông tin và đảm bảo giỏ hàng không trống!");
            }
        }

        document.querySelectorAll('input[name="payment"]').forEach(input => {
            input.addEventListener('change', showPaymentDetails);
        });

        document.addEventListener('DOMContentLoaded', () => {
            updateCartCount();
            showPaymentDetails();
        });
    </script>
</body>

</html>