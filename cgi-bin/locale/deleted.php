<?php
/**
 * Created by PhpStorm.
 * User: erzhigit@tagay.kz
 * Date: 08.08.2023
 * Time: 19:38
 */
session_start();
$_SESSION['tutor'];
include('../incs/connect.php');

    if(!isset($_SESSION['tutor'])){
        header('Location: ../login.php'); return;
    }

    //DoEdit
    if (isset($_GET['id'])){
        $sId = $_GET['id'];
        $sSqlUpdate = "DELETE FROM locale WHERE id ='$sId' ";
        $query = mysqli_query($connection, $sSqlUpdate) or die(mysqli_error($connection));
        echo "OK!";
        sleep(2);
        header('Location: index.php'); return;
    }