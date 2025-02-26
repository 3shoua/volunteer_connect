<?php
require 'db.php'; // Make sure db.php uses PDO and not MySQLi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($name) && !empty($email) && !empty($password)) {
        // Hash password securely
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        try {
            // Use a prepared statement to prevent SQL injection
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashed_password
            ]);

            echo "<script>alert('Registration successful! Redirecting to login...'); window.location='login.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        }
    } else {
        echo "<script>alert('All fields are required!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب - تواصل المتطوعين</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="signup-container">
        <h2>انضم إلى تواصل المتطوعين</h2>
        <p>سجل الآن لتبدأ في إحداث فرق اليوم!</p>

        <form action="signup.php" method="POST">
            <input type="text" name="name" placeholder="الاسم الكامل" required>
            <input type="email" name="email" placeholder="عنوان البريد الإلكتروني" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <button type="submit" class="signup-btn">إنشاء حساب</button>
        </form>

        <p>لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول</a></p>
    </div>

</body>

</html>