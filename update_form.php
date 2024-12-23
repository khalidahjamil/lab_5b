<?php

session_start();


include 'Database.php';
include 'User.php';

// Check if the form is accessed via GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matric'])) {
    // Retrieve the matric value from the GET request
    $matric = $_GET['matric'];

    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    // Create a User object and fetch user details
    $user = new User($db);
    $userDetails = $user->getUser($matric);

    // Close the connection
    $db->close();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h1>Update User</h1>

    <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true') : ?>
        <p style="color: green;">User updated successfully!</p>
    <?php endif; ?>

    <form action="update.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" value="<?php echo htmlspecialchars($userDetails['matric']); ?>" required><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userDetails['name']); ?>" required><br>

        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="">Please select</option>
            <option value="lecturer" <?php if ($userDetails['role'] == 'lecturer') echo "selected"; ?>>Lecturer</option>
            <option value="student" <?php if ($userDetails['role'] == 'student') echo "selected"; ?>>Student</option>
        </select><br>

        <input type="submit" value="Update">
        <a href="read.php">Cancel</a>
    </form>
</body>
</html>
