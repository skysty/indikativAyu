<?php
/**
 * Created by PhpStorm.
 * User: erzhigit@tagay.kz
 * Date: 08.08.2023
 * Time: 18:44
 */

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
    <?php
    session_start();
    $_SESSION['tutor'];
    include('../incs/connect.php');

    if(!isset($_SESSION['tutor'])){
        header('Location: ../login.php');
    }

    //DoEdit
    if (isset($_POST['submit_edit'])){
        $sId = $_POST['id'];
        $sKaz = $_POST['kaz'];
        $sRus = $_POST['rus'];
        $sSqlUpdate = "UPDATE locale SET kaz = '$sKaz', rus = '$sRus' WHERE id ='$sId' ";
        $query = mysqli_query($connection, $sSqlUpdate) or die(mysqli_error($connection));
        echo "OK!";
        header('Location: index.php?target='.$sId); return;
    }

    $sHome = '/';
    if($_SESSION['roleID'] == 1){
        $sHome = '../tutor';
    } else if($_SESSION['roleID'] == 2){
        $sHome = '../admin';
    } else if($_SESSION['roleID'] == 3){
        $sHome = '../moderator';
    } else if($_SESSION['roleID'] == 4){
        $sHome = '../cafedraManager';
    } else if($_SESSION['roleID'] == 5){
        $sHome = '../facultyDean';
    } else if($_SESSION['roleID'] == 6){
        $sHome = '../first_moderator';
    }
    ?>
    <title>Сөздік</title>
    <link rel = "stylesheet" type = "text/css" href = "../css/style.css">
    <script type = "text/javascript" src = "../js/jquery.js"></script>
    <script type = "text/javascript" src = "../js/functions.js"></script>
    <link rel="icon" type="image/png" href="../img/favicon.png" />
    <style>
        .shagymTable{
            margin: 0 auto;
            width: 1000px;
        }
        table {
            border-collapse: collapse;
            border:1px black solid;
            width: 100%;
            font-size: 12px;
        }

        th, td {
            text-align: left;
            padding: 6px;
            border:1px black solid;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color: #003366;
            color: white;
        }
    </style>
</head>
<body>
<div class = "upper_header">
    <img src = "../img/login_logo.png" style = "width: 170px; float:left;">
    <p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;">АХМЕТ ЯСАУИ УНИВЕРСИТЕТІ</p>
    <p style = "font-size: 24px; text-align: center; color: red;font-weight: bold;">ІШКІ КӘСІБИ РЕЙТИНГІ</p>
    <div style = "font-size: 18px; text-align: center; color: #0094de;font-weight: bold;">
    </div></br>	</div>
<div class = "header">
    <div id = "menu_nav">
        <?php include '../extensions/nav.php'?>
    </div>
</div>
<div class = "content">
    <div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 5px;">

        <?php

        $_SESSION['tutor'];

        ?>
        <div class = "shagymTable">
            <h2 align = "center">Көрсеткіштер</h2>
            <table>
                <tr>
                    <th>№</th><th>Қазақша</th>
                </tr>
                <?php

                $sSql = "SELECT * FROM locale WHERE id = '".$_GET['id']. "'";
                $query = mysqli_query($connection, $sSql) or die(mysqli_error($connection));
                $korsetkish = mysqli_fetch_array($query)
                ?>
                <form action = "edit.php?id=<?=$_GET['id']?>" method = "post">
                    <input type="hidden" name="id" value="<?=$korsetkish['id']?>">
                    <table>
                        <tr>
                            <td>
                                <strong>ID:</strong>

                            </td>
                            <td>
                                <input type="text" name="id" value = "<?= $korsetkish['id']?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong><?= $oL::get('Қазақша')?></strong>
                            </td>
                            <td>
                                <input type = "text" name = "kaz" value="<?= $korsetkish['kaz']?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong><?= $oL::get('Орысша')?></strong>
                            </td>
                            <td>
                                <input type = "text" name = "rus" value="<?= $korsetkish['rus']?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input type = "submit" name = "submit_edit" value = "<?= $oL::get('Сақтау')?>">
                            </td>
                        </tr>
                    </table>
                </form>
            </table>
        </div>
    </div>
</div>
</br>
</body>
</html>