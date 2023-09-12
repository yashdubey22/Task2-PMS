<?php
include("config.php");

if (isset($_GET["project_id"])) {
    $project_id = $_GET["project_id"];

    // Retrieve project details
    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();

    // Retrieve tasks for the project
    $sql = "SELECT * FROM tasks WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $tasks = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!-- HTML page to display project details and tasks -->
<!DOCTYPE html>
<html>
<head>
    <title>Project Details</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1><?php echo $project["title"]; ?></h1>
    <p><?php echo $project["description"]; ?></p>
    
   
</body>
</html>
