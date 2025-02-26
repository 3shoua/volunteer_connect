<?php
require 'db.php';
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - تواصل المتطوعين</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>لوحة التحكم</h2>
        <ul>
            <li><a href="index.html"><i class="fas fa-home"></i> الرئيسية</a></li>
            <li><a href="logout.php" class="get-started-btn">تسجيل الخروج</a></li><!-- Fixed logout link -->
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h2>مرحباً <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
            <div class="user">
                <i class="fas fa-user-circle"></i>
            </div>
        </header>

        <section class="cards">
            <div class="card">
                <h3>إجمالي المستخدمين</h3>
                <p>5</p>
            </div>
            <div class="card">
                <h3>عدد المتطوعين</h3>
                <p>5</p>
            </div>
            <div class="card">
                <h3>حالات التطوع</h3>
                <p>5</p>
            </div>
        </section>

        <section class="content">
            <h3>آخر النشاطات</h3>
            <table>
                <tr>
                    <th>المستخدم</th>
                    <th>حالات التطوع</th>
                    <th>التاريخ</th>
                </tr>
                <tr>
                    <td>محمد عيل</td>
                    <td>المساعدة في الحج والعمرة</td>
                    <td>2025-02-20</td>
                </tr>
                <tr>
                    <td>أحمد إبراهيم</td>
                    <td>الحفاظ على البيئة</td>
                    <td>2025-02-21</td>
                </tr>
                <tr>
                    <td>خالد محمود</td>
                    <td>تنمية المجتمع</td>
                    <td>2025-02-22</td>
                </tr>
                <tr>
                    <td>نبيل ياسر</td>
                    <td>دعم المستشفيات</td>
                    <td>2025-02-23</td>
                </tr>
                <tr>
                    <td>محيي أمجد</td>
                    <td>توزيع الصدقات والطعام</td>
                    <td>2025-02-24</td>
                </tr>
            </table>
        </section>
    </div>
</body>

</html>