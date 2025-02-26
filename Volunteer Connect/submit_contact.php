<?php
// Include database connection
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data and sanitize it
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $volunteer_type = $_POST['volunteer-type'];
    $volunteer_days = $_POST['volunteer_days'];
    $message = $_POST['message'];

    try {
        // Prepare the SQL query to insert data into the database
        $stmt = $pdo->prepare("INSERT INTO applications (name, email, phone, volunteer_type, volunteer_days, message) VALUES (?, ?, ?, ?, ?, ?)");
        
        // Execute the query with the form data
        $stmt->execute([$name, $email, $phone, $volunteer_type, $volunteer_days, $message]);

        // Display success message
        $success_message = "Your application has been submitted successfully!";
    } catch (PDOException $e) {
        // Display error message if something goes wrong
        $error_message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Application</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="form-container">
        <h2>Volunteer Application</h2>

        <!-- Display success or error message -->
        <?php if (isset($success_message)): ?>
        <p class="success"><?= $success_message ?></p>
        <?php elseif (isset($error_message)): ?>
        <p class="error"><?= $error_message ?></p>
        <?php endif; ?>

        <!-- Form for volunteer application -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="volunteer-type">Select Opportunity</label>
                <select id="volunteer-type" name="volunteer-type" required>
                    <option value="" disabled selected>Select an option</option>
                    <option value="hajj">Hajj & Umrah Assistance</option>
                    <option value="environment">Environmental Conservation</option>
                    <option value="community">Community Development</option>
                    <option value="hospital">Hospital Support</option>
                    <option value="charity">Charity & Food Distribution</option>
                    <option value="healthcare">Healthcare Assistance</option>
                </select>
            </div>
            <div class="form-group">
                <label for="volunteer_days">Volunteer Days:</label>
                <input type="number" name="volunteer_days" min="1" max="30" required>
            </div>
            <div class="form-group">
                <label for="message">Why do you want to volunteer?</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Submit Application</button>
        </form>
    </div>
</body>

</html>