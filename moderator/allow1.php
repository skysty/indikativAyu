<?php
include('../incs/connect.php');

if (isset($_POST['deletedata'])) {
    // получить идентификатор из строки запроса
    $id = $_POST['tolyk_korset'];
    $tutor_id=$_POST['tutor_id'];
   // query1 
   $query1 = mysqli_query($connection, "SELECT COUNT(dostup) as ruksat FROM tutors where dostup !=0") or die(mysql_error());
   $tutor = mysqli_fetch_assoc($query1);
   $dost = $tutor['ruksat'];
   //Id user
   $tut = $tutor_id;
   $query2 = mysqli_query($connection, "SELECT * FROM tutors WHERE `TutorID` = '$tutor_id'") or die(mysql_error());
   $dostupIs = mysqli_fetch_array($query2);
   $dostID = $dostupIs['dostup'];
    // query 
    $sql = "UPDATE korsetkishter SET dos_id = 1  WHERE kod_korsetkish = '$id'";
    $query = mysqli_query($connection, $sql);
 
    // запрос успешно удален?
    if ($query) {
        header('Location: get_teacher.php?delete=success');
    } else
        die('Location: get_teacher.php?delete=error');
} else
    die("доступ запрещен...");
