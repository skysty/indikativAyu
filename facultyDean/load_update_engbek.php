<?php
include('../incs/connect.php');
require('../logicFunctions/functions.php');

if (isset($_POST['upload'])) {
    try {
        $korsetkish = $_POST['korsetkish'];
        $date = $_POST['date'];
        $save_date = $_POST['save_date'];
        $eskertu = $_POST['eskertu'] ?? '';
        $FacultyID = $_POST['faculty'];
        $cafedraID = $_POST['cafedra'];
        $TutorID = $_POST['tutor_id'];
        $univ_avtor_san = $_POST['univ_avtor_san'] ?? '';
        $sani = $_POST['sany'] ?? '';
        $enbekID = $_POST['engbek'] ?? null; // Check if enbekID is set
        $newfilename = null;

        // File upload handling
        if (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['file']['name'];
            $file_size = $_FILES['file']['size'];
            $file_temp = $_FILES['file']['tmp_name'];
            $file_error = $_FILES['file']['error'];

            if ($file_error === UPLOAD_ERR_OK) {
                $temp = explode(".", $file);
                $newfilename = $TutorID . "_" . round(time()) . '.' . end($temp);
                move_uploaded_file($file_temp, __DIR__ . "/../files/" . $newfilename);
            } elseif ($file_error !== UPLOAD_ERR_NO_FILE) {
                // Handle other file upload errors
                switch ($file_error) {
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        echo "<span style='color: red;'>Файл тым үлкен</span>";
                        break;
                    default:
                        echo "<span style='color: red;'>Файлды жүктеу кезінде қате болды</span>";
                        break;
                }
                exit();
            }
        }

        if ($korsetkish == "") {
            echo "<span style='color: red;'>" . $oL::get('Еңбек жүкетеуге рұқсат жоқ') . "</span>";
        } else {
            $sql = "SELECT * FROM korsetkishter WHERE kod_korsetkish = '$korsetkish'";
            $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            $korset_massiv = mysqli_fetch_array($res);

            $a = $korset_massiv['shekteu'];
            echo $a . "<br />";

            $sql2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID' AND kod_korset = '$korsetkish'";
            $res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
            $korset_massiv2 = mysqli_fetch_array($res2);

            $b = $korset_massiv2['wCount'];
            echo $b . "<br />";

            if ($b < $a) {
                if ($sani == null || $sani == 0) {
                    $sani = 1;
                }

                if ($enbekID) {
                    // Update existing record
                    $update_query = "UPDATE engbekter SET 
                        kod_korset='$korsetkish', 
                        kod_kizm='$TutorID', 
                        kod_okujil='11', 
                        kod_univer='1', 
                        kod_fakul='$FacultyID', 
                        kod_kafedra='$cafedraID', 
                        sani='$sani', 
                        kuni='$date', 
                        univ_avtor_san='$univ_avtor_san', 
                        ball='0', 
                        eskertu='$eskertu', 
                        kod_stat='2', 
                        artik='0', 
                        ball8='0', 
                        saktalgan_kuni='$save_date',
                        changed='1'";
                        
                    if ($newfilename) {
                        $update_query .= ", file_ati='../files/$newfilename'";
                        $update_query .= ", changed='2'";
                    }

                    $update_query .= " WHERE engbekID ='$enbekID'";
                    mysqli_query($connection, $update_query) or die(mysqli_error($connection));
                } else {
                    // Insert new record
                    $insert_query = "INSERT INTO engbekter(
                        kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni, file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni
                    ) VALUES(
                        '$korsetkish', '$TutorID', '11', '1', '$FacultyID', '$cafedraID', '$sani', '$date', " . ($newfilename ? "'../files/$newfilename'" : "NULL") . ", '-', '$univ_avtor_san', '0', '$eskertu', '2', '0', '0', '$save_date'
                    )";
                    mysqli_query($connection, $insert_query) or die(mysqli_error($connection));
                }

                header('Location: show_load_e.php');
            } else {
                header('Location: error.php');
            }
        }
    } catch (Exception $e) {
        // Log the error
        error_log($e->getMessage());

        // Display an error page to the user
        header("HTTP/1.1 500 Internal Server Error");
        include("../error/error_page.php");
        exit();
    }
} else {
    echo "BIR QATE BAR";
}
?>
