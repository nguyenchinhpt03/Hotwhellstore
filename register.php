<?php
session_start();
require_once 'api.php';

// Nếu form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $pass1 = $_POST['password'];
  $pass2 = $_POST['password_confirm'];

  // Kiểm tra mật khẩu
  if ($pass1 !== $pass2) {
    $error = 'Mật khẩu không khớp.';
  } else {
    // Kiểm tra tồn tại
    $stmt = $db->prepare("SELECT id FROM users WHERE username=? OR email=?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) {
      $error = 'Tên đăng nhập hoặc email đã tồn tại.';
    } else {
      // Hash và lưu
      $hash = password_hash($pass1, PASSWORD_DEFAULT);
      $stmt = $db->prepare("INSERT INTO users (username, password_hash, email) VALUES (?, ?, ?)");
      $stmt->execute([$username, $hash, $email]);

      // Đăng nhập tự động
      $_SESSION['user_id'] = $db->lastInsertId();
      $_SESSION['username'] = $username;
      header('Location: index.html');
      exit;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng ký</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form action="" method="POST" class="form">
    <h2>Đăng ký tài khoản</h2>
    <?php if (!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <input type="text" name="username" placeholder="Tên đăng nhập" value="<?= htmlspecialchars(
      $_POST['username'] ?? ''
    ) ?>" required>
    <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars(
      $_POST['email'] ?? ''
    ) ?>" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <input type="password" name="password_confirm" placeholder="Nhập lại mật khẩu" required>
    <button type="submit">Đăng ký</button>
  </form>
</body>
</html>