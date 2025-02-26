<?php
// Include database connection
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Collect and sanitize form input
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Prepare SQL query using a prepared statement
        $sql = "INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)";
        
        // Prepare and bind parameters
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Message sent successfully!'); window.location.href = 'index.html';</script>";
        } else {
            echo "<script>alert('Error sending message.'); window.location.href = 'index.html';</script>";
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    // Redirect if accessed directly
    header("Location: index.html");
    exit();
}
?>