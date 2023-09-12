<?php
include("config.php");

// Retrieve the list of projects from the database
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);

$projects = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Project Management</title>
    <link rel="stylesheet" type="text/css" href="css/projects.css">
</head>
<body>
    <h1>Project List</h1>
    
    <ul>
        <?php foreach ($projects as $project): ?>
            <li>
                <a href="view_project.php?project_id=<?php echo $project["id"]; ?>">
                    <?php echo $project["title"]; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="create_project.php">Create New Project</a>
</body>
</html>
