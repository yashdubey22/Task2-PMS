<?php
session_start();

include("config.php"); // Database connection configuration

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform user authentication
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        
        // Check if the logged-in user is the admin
        if ($username === "admin") {
            $_SESSION["admin"] = true;
        }
        
        header("Location: projects.php"); // Redirect to homepage
        exit();
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/login.css"> <!-- Include your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <?php if (isset($login_error)): ?>
            <p class="error"><?php echo $login_error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</body>
</html>
