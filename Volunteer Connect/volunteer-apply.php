<?php
// Include database connection
include 'db.php'; // This file creates a PDO connection as $pdo

// Initialize message variables
$success_message = $error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Collect and sanitize form input
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $volunteer_type = htmlspecialchars($_POST['volunteer-type']);
        $volunteer_days = (int) $_POST['volunteer_days'];
        $message = htmlspecialchars($_POST['message']);

        // SQL query to insert data using a prepared statement
        $sql = "INSERT INTO applications (name, email, phone, volunteer_type, volunteer_days, message) 
                VALUES (:name, :email, :phone, :volunteer_type, :volunteer_days, :message)";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':volunteer_type', $volunteer_type);
        $stmt->bindParam(':volunteer_days', $volunteer_days, PDO::PARAM_INT);
        $stmt->bindParam(':message', $message);

        // Execute the query
        if ($stmt->execute()) {
            $success_message = "Your application has been submitted successfully!";
        } else {
            $error_message = "Error submitting application.";
        }
    } catch (PDOException $e) {
        $error_message = "Database error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب تطوع</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="form-container">
        <h2>طلب تطوع</h2>

        <!-- Display success or error message -->
        <?php if (!empty($success_message)): ?>
        <p class="success" id="success-message"><?= $success_message ?></p>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
        <p class="error" id="error-message"><?= $error_message ?></p>
        <?php endif; ?>

        <!-- Form for volunteer application -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">الاسم</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="volunteer-type">اختر فرصة تطوع</label>
                <select id="volunteer-type" name="volunteer-type" required>
                    <option value="" disabled selected>اختر خياراً</option>
                    <option value="hajj">المساعدة في الحج والعمرة</option>
                    <option value="environment">الحفاظ على البيئة</option>
                    <option value="community">تنمية المجتمع</option>
                    <option value="hospital">دعم المستشفيات</option>
                    <option value="charity">توزيع الصدقات والطعام</option>
                    <option value="healthcare">المساعدة في الرعاية الصحية</option>
                </select>
            </div>
            <div class="form-group">
                <label for="volunteer_days">أيام التطوع:</label>
                <input type="number" name="volunteer_days" min="1" max="30" required>
            </div>
            <div class="form-group">
                <label for="message">لماذا تريد التطوع؟</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit" class="submit-btn">إرسال الطلب</button>
        </form>
    </div>
</body>


<script>
// Function to remove success message after 5 seconds
setTimeout(function() {
    var successMessage = document.getElementById("success-message");
    if (successMessage) {
        successMessage.style.transition = "opacity 1s";
        successMessage.style.opacity = "0";
        setTimeout(function() {
            successMessage.remove();
        }, 1000);
    }
}, 1000);
</script>

</html>