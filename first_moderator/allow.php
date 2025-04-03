<?php
include('../incs/connect.php');

if (isset($_POST['savedata'])) {
    // получить идентификатор из строки запроса
    $id = $_POST['tolyk_korset'];
    $tutor_id=$_POST['tutor_id'];
    $enbId=$_POST['enbekId'];
    $sql1 = mysqli_query($connection,"SELECT * FROM `dostupkorset` WHERE  tutorID='$tutor_id' AND `korsetkishID`='$id'") or die(mysqli_error($connection));
    $tutors = mysqli_fetch_array($sql1);
    $tutID = $tutors['tutorID'];
    $korsetID=$tutors['korsetkishID'];
    if($tutor_id==$tutID And $id==$korsetID){
        header('Location: get_teacher.php?update=success');
    }elseif($tutor_id!=$tutID And $id!=$korsetID){
    $sql2 = mysqli_query($connection,"INSERT INTO `dostupkorset`(`tutorID`, `korsetkishID`) VALUES ('$tutor_id','$id')") or die(mysqli_error($connection));
    $sql = "UPDATE `engbekter` SET `dostup_id`=1 where `engbekID` = '$enbId'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        header('Location: get_teacher.php?delete=success');
    } else
        die('Location: get_teacher.php?delete=error');
    }else{
        die("доступ запрещен...");
    }
} else
    die("доступ запрещен...");
