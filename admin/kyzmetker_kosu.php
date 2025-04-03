<?php
// Establish database connection
require_once ('../incs/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskName = $_POST['task_name'];
    $taskDescription = $_POST['task_description'];

    // Insert into database
    $sql = "INSERT INTO tasks (task_name, task_description) VALUES ('$taskName', '$taskDescription')";
    if (mysqli_query($conn, $sql)) {
        echo "Task added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
