<?php
// Establish database connection
require_once ('../incs/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tutorId = $_POST['task_id'];
    $taskName = $_POST['task_name'];
    $taskDescription = $_POST['task_description'];

    // Update task in the database
    $sql = "UPDATE tasks SET task_name='$taskName', task_description='$taskDescription' WHERE id=$taskId";
    if (mysqli_query($conn, $sql)) {
        echo "Task updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
