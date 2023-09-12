<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_project"])) {
    $title = $_POST["title"];
    $description = $_POST["description"];

    $sql = "INSERT INTO projects (title, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $description);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error creating project: " . $conn->error;
    }
}
?>
<!-- HTML form for creating a new project -->
<!DOCTYPE html>
<html>
<head>
    <title>Create Project</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Create a New Project</h1>
    <form method="POST" action="">
        <label for="title">Project Title:</label>
        <input type="text" name="title" required><br>
        <label for="description">Description:</label>
        <textarea name="description"></textarea><br>
        <input type="submit" name="create_project" value="Create Project">
    </form>
</body>
</html>
