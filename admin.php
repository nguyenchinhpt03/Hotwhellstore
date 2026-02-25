<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #f28f16;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        th, td {
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
    <header>Quản lý Sản phẩm</header>
    
    <div class="container">
        <h2>Thêm Sản Phẩm</h2>
        <div class="form-group">
            <label for="product-name">Tên sản phẩm</label>
            <input type="text" id="product-name">
        </div>
        <div class="form-group">
            <label for="product-price">Giá</label>
            <input type="number" id="product-price">
        </div>
        <button class="btn" onclick="addProduct()">Thêm sản phẩm</button>
        
        <h2>Danh Sách Sản Phẩm</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="product-list">
                <!-- Danh sách sản phẩm sẽ được cập nhật tại đây -->
            </tbody>
        </table>
    </div>
    
    <footer>
        <p>&copy; 2025 Hot Wheels Store. All Rights Reserved.</p>
    </footer>

    <script>
        let products = JSON.parse(localStorage.getItem('products')) || [];

        function renderProducts() {
            const productList = document.getElementById('product-list');
            productList.innerHTML = '';
            products.forEach((product, index) => {
                productList.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td><input type="text" value="${product.name}" onchange="updateProduct(${index}, this.value, 'name')"></td>
                        <td><input type="number" value="${product.price}" onchange="updateProduct(${index}, this.value, 'price')"></td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteProduct(${index})">Xóa</button>
                        </td>
                    </tr>
                `;
            });
            localStorage.setItem('products', JSON.stringify(products));
        }

        function addProduct() {
            const name = document.getElementById('product-name').value;
            const price = document.getElementById('product-price').value;
            if (name && price) {
                products.push({ name, price });
                renderProducts();
            }
        }

        function updateProduct(index, value, field) {
            products[index][field] = value;
            localStorage.setItem('products', JSON.stringify(products));
        }

        function deleteProduct(index) {
            products.splice(index, 1);
            renderProducts();
        }

        document.addEventListener('DOMContentLoaded', renderProducts);
    </script>
</body>
</html>