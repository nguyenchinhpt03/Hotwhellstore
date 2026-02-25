-- File: schema.sql
-- Detailed Database Schema for HotwheelsStore
-- Import vào phpMyAdmin: chọn database → tab Import → upload file này

-- ======================================
-- 0. (Tuỳ chọn) DROP tất cả các bảng nếu cần
-- ======================================
DROP TABLE IF EXISTS order_details;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

-- ======================================
-- 1. Bảng: users
-- ======================================
CREATE TABLE users (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    username       VARCHAR(50)     NOT NULL UNIQUE,
    password_hash  VARCHAR(255)    NOT NULL,
    email          VARCHAR(100)    NOT NULL UNIQUE,
    full_name      VARCHAR(100)    DEFAULT NULL,
    phone          VARCHAR(20)     DEFAULT NULL,
    address        VARCHAR(255)    DEFAULT NULL,
    role           ENUM('user','admin') NOT NULL DEFAULT 'user',
    created_at     TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_users_role (role),
    INDEX idx_users_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================================
-- 2. Bảng: products
-- ======================================
CREATE TABLE products (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    name           VARCHAR(100)    NOT NULL,
    price          DECIMAL(10,2)   NOT NULL,
    image_url      VARCHAR(255)    DEFAULT NULL,
    description    TEXT            DEFAULT NULL,
    created_at     TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_products_price (price),
    FULLTEXT INDEX idx_products_name_desc (name, description)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================================
-- 3. Bảng: orders
-- ======================================
CREATE TABLE orders (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT             DEFAULT NULL,
    customer_name  VARCHAR(100)    NOT NULL,
    address        VARCHAR(255)    NOT NULL,
    phone          VARCHAR(20)     NOT NULL,
    total_price    DECIMAL(10,2)   NOT NULL,
    payment_method VARCHAR(50)     NOT NULL,
    status         ENUM('pending','processing','completed','cancelled')
                    NOT NULL DEFAULT 'pending',
    created_at     TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_orders_user    (user_id),
    INDEX idx_orders_status  (status),
    INDEX idx_orders_created (created_at),
    CONSTRAINT fk_orders_user FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================================
-- 4. Bảng: order_details
-- ======================================
CREATE TABLE order_details (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    order_id       INT             NOT NULL,
    product_id     INT             DEFAULT NULL,
    quantity       INT             NOT NULL,
    price          DECIMAL(10,2)   NOT NULL,
    INDEX idx_details_order   (order_id),
    INDEX idx_details_product (product_id),
    CONSTRAINT fk_details_order FOREIGN KEY (order_id)
        REFERENCES orders(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_details_product FOREIGN KEY (product_id)
        REFERENCES products(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ======================================
-- 5. Dữ liệu mẫu: users
--    (Thay password_hash bằng hash thật từ password_hash())
-- ======================================
INSERT INTO users (username, password_hash, email, full_name, phone, address, role)
VALUES
  ('admin', '$2y$10$exampleAdminHash',   'admin@hotwheelsstore.com', 'Admin User',    '0916297780', 'Hà Nội', 'admin'),
  ('user1', '$2y$10$exampleUserHash',    'user1@example.com',        'Nguyen Van A',  '0987654321', 'TP.HCM', 'user')
ON DUPLICATE KEY UPDATE
  password_hash=VALUES(password_hash),
  email=VALUES(email),
  full_name=VALUES(full_name),
  phone=VALUES(phone),
  address=VALUES(address),
  role=VALUES(role);

-- Nếu bạn muốn dùng MD5 (chỉ test nhanh, không an toàn), mở comment bên dưới:
-- INSERT IGNORE INTO users (username, password_hash, email, full_name, phone, address, role)
-- VALUES ('admin', MD5('admin123'), 'admin@hotwheelsstore.com', 'Admin User', '0916297780', 'Hà Nội', 'admin');

-- ======================================
-- 6. Dữ liệu mẫu: products
-- ======================================
INSERT INTO products (name, price, image_url, description)
VALUES
  ('Hot Wheels Camaro',   250000.00, 'uploads/images/camaro.jpg',   'Mô hình xe Hot Wheels Camaro tinh xảo.'),
  ('Hot Wheels Mustang',  280000.00, 'uploads/images/mustang.jpg',  'Mô hình xe Hot Wheels Mustang sắc nét.'),
  ('Hot Wheels Ferrari',  320000.00, 'uploads/images/ferrari.jpg',  'Mô hình xe Hot Wheels Ferrari cao cấp.')
ON DUPLICATE KEY UPDATE
  price=VALUES(price),
  image_url=VALUES(image_url),
  description=VALUES(description);

-- ======================================
-- 7. Dữ liệu mẫu: orders & order_details
-- ======================================
INSERT INTO orders (user_id, customer_name, address, phone, total_price, payment_method, status)
VALUES
  (1, 'Nguyen Van A', '123 Le Loi, HN', '0987654321', 530000.00, 'Cash', 'pending');

SET @last_order = LAST_INSERT_ID();

INSERT INTO order_details (order_id, product_id, quantity, price)
VALUES
  (@last_order, 1, 2, 250000.00),
  (@last_order, 2, 1, 280000.00);
