<?php
    include('../incs/connect.php');
    session_start();
    $tut=$_SESSION['tutor'];
    $query = mysqli_query($connection, "SELECT * FROM tutors WHERE mail = '$tut'") or die(mysql_error($connection));
    $tutor = mysqli_fetch_array($query);
    $_SESSION['dostup'] = $tutor['dostup'];
    if(!isset($_SESSION['tutor'])){
        header('Location: ../login.php');
    }
?>
<title><?= $oL::get('Еңбекті жүктеу')?></title>
<script type = "text/javascript" src = "../js/jquery.js"></script>
<script  type = "text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
<link rel = "stylesheet" type = "text/css" href = "../css/fileupload.css">
<script type = "text/javascript" src = "../js/functions.js"></script>
<link rel="icon" type="image/png" href="../img/favicon.png" />