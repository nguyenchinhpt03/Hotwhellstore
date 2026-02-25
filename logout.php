<?php
session_start();

// Xóa toàn bộ dữ liệu session
session_unset();
session_destroy();

// Chuyển hướng về trang chủ
header('Location: index.php'); // Đổi thành index.php
exit;
?>