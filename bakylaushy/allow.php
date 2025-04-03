<?php
include('../incs/connect.php');

if (isset($_POST['deletedata'])) {
    // получить идентификатор из строки запроса
    $id = $_POST['delete_id'];

    // query 
    $sql = "UPDATE tutors SET exist = 0 WHERE TutorID = '$id'";
    $query = mysqli_query($connection, $sql);
    // запрос успешно удален?
    if ($query) {
        header('Location: get_teacher.php?delete=success');
    } else
        die('Location: get_teacher.php?delete=error');
} else
    die("доступ запрещен...");
