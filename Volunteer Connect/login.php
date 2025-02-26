<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        try {
            // Secure query using prepared statements
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists and verify password
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];

                // Redirect to dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<script>alert('Invalid email or password!');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Database error: " . $e->getMessage() . "');</script>";
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
    <title>تسجيل الدخول - تواصل المتطوعين</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="login-container">
        <h2>مرحباً بعودتك!</h2>
        <p>سجل الدخول لمتابعة رحلتك مع تواصل المتطوعين.</p>

        <form action="login.php" method="POST">
            <!-- Fix: form should post to login.php -->
            <input type="email" name="email" placeholder="عنوان البريد الإلكتروني" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <button type="submit" class="login-btn">تسجيل الدخول</button>
        </form>

        <p>ليس لديك حساب؟ <a href="signup.php">إنشاء حساب</a></p>
        <p><a href="#">هل نسيت كلمة المرور؟</a></p>
    </div>
</body>

</html>