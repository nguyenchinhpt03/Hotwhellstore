<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm - Hot Wheels Store</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .filter-bar {
            text-align: center;
            padding: 20px;
            background: white;
        }
        
        .product-list {
            text-align: center;
            padding: 20px;
        }
        
        .product-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .product-item {
            background: #febf38;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 250px;
            text-align: center;
        }
        
        .product-item img {
            width: 100%;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }
        
        .product-item img:hover {
            transform: scale(1.1);
        }
        
        .pagination {
            text-align: center;
            margin-top: 20px;
        }
        
        .pagination button {
            background: #f28f16;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 5px;
            cursor: pointer;
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

    <section class="filter-bar">
        <input type="text" id="search" placeholder="Tìm kiếm sản phẩm..." onkeyup="filterProducts()">
    </section>

    <section class="product-list">
        <h2>Tất cả sản phẩm</h2>
        <div class="product-grid" id="product-container"></div>
        <div class="pagination" id="pagination"></div>
    </section>

    <footer>
        <p>&copy; 2025 Hot Wheels Store. All Rights Reserved.</p>
    </footer>

    <script>
        const products = Array.from({
            length: 40
        }, (_, i) => ({
            id: i + 1,
            name: `Hot Wheels Car ${i + 1}`,
            price: 150000 + (i % 5) * 10000,
            img: `https://cdn.shopify.com/s/files/1/0731/6514/4343/files/sieu-xe-kro-promo-car-${(i % 10) + 1}.jpg?v=1741257486&width=500`
        }));

        let currentPage = 1;
        const productsPerPage = 20;
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function displayProducts() {
            const searchQuery = document.getElementById("search").value.toLowerCase();
            const filteredProducts = products.filter(product => product.name.toLowerCase().includes(searchQuery));
            const start = (currentPage - 1) * productsPerPage;
            const end = start + productsPerPage;
            const paginatedProducts = filteredProducts.slice(start, end);

            const container = document.getElementById("product-container");
            container.innerHTML = paginatedProducts.map(product => `
                <div class="product-item">
                    <a href="product-detail.html?id=${product.id}">
                        <img src="${product.img}" alt="${product.name}" loading="lazy">
                    </a>
                    <h3>${product.name}</h3>
                    <p>${product.price.toLocaleString()} VND</p>
                    <button class="btn" onclick="addToCart(${product.id}, '${product.name}', ${product.price})">Thêm vào giỏ hàng</button>
                </div>
            `).join("");

            displayPagination(filteredProducts.length);
        }

        function displayPagination(totalProducts) {
            const totalPages = Math.ceil(totalProducts / productsPerPage);
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = "";
            for (let i = 1; i <= totalPages; i++) {
                pagination.innerHTML += `<button onclick="changePage(${i})">${i}</button>`;
            }
        }

        function changePage(page) {
            currentPage = page;
            displayProducts();
        }

        function filterProducts() {
            currentPage = 1;
            displayProducts();
        }

        function addToCart(id, name, price) {
            let product = cart.find(item => item.id === id);
            if (product) {
                product.quantity += 1;
            } else {
                cart.push({
                    id,
                    name,
                    price,
                    quantity: 1
                });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            alert(`Đã thêm ${name} vào giỏ hàng!`);
        }

        function updateCartCount() {
            document.getElementById('cart-count').innerText = cart.reduce((sum, item) => sum + item.quantity, 0);
        }

        document.addEventListener('DOMContentLoaded', () => {
            displayProducts();
            updateCartCount();
        });
    </script>
</body>

</html>