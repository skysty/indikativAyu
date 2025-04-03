<?php
include('../incs/connect.php');
    function getTutorInfo2($avtor2, $connection) {
        $sql = "SELECT t.TutorID, f.FacultyID, t.cafedraID FROM cafedras c join tutors t on c.cafedraID = t.CafedraID
        join faculties f on f.FacultyID = c.FacultyID WHERE Login = '$avtor2'";
        $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $tutor_info2 = mysqli_fetch_array($res);
        return $tutor_info2;
    }
    function getTutorInfo3($avtor3, $connection) {
        $sql = "SELECT t.TutorID, f.FacultyID, t.cafedraID FROM cafedras c join tutors t on c.cafedraID = t.CafedraID
        join faculties f on f.FacultyID = c.FacultyID WHERE Login = '$avtor3'";
        $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $tutor_info3 = mysqli_fetch_array($res);
        return $tutor_info3;
    }
    function getTutorInfo4($avtor4, $connection) {
        $sql = "SELECT t.TutorID, f.FacultyID, t.cafedraID FROM cafedras c join tutors t on c.cafedraID = t.CafedraID
        join faculties f on f.FacultyID = c.FacultyID WHERE Login = '$avtor4'";
        $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $tutor_info4 = mysqli_fetch_array($res);
        return $tutor_info4;
    }
    function getTutorInfo5($avtor5, $connection) {
        $sql = "SELECT t.TutorID, f.FacultyID, t.cafedraID FROM cafedras c join tutors t on c.cafedraID = t.CafedraID
        join faculties f on f.FacultyID = c.FacultyID WHERE Login = '$avtor5'";
        $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $tutor_info5 = mysqli_fetch_array($res);
        return $tutor_info5;
    }
    function getTutorInfo6($avtor6, $connection) {
        $sql = "SELECT t.TutorID, f.FacultyID, t.cafedraID FROM cafedras c join tutors t on c.cafedraID = t.CafedraID
        join faculties f on f.FacultyID = c.FacultyID WHERE Login = '$avtor6'";
        $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $tutor_info6 = mysqli_fetch_array($res);
        return $tutor_info6;
    }
    function getTutorInfo7($avtor7, $connection) {
        $sql = "SELECT t.TutorID, f.FacultyID, t.cafedraID FROM cafedras c join tutors t on c.cafedraID = t.CafedraID
        join faculties f on f.FacultyID = c.FacultyID WHERE Login = '$avtor7'";
        $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $tutor_info7 = mysqli_fetch_array($res);
        return $tutor_info7;
    }
    function isFileSizeValid($file_size, $korsetkish, $TutorID, $connection) {
        if (!$file_size) {  
            echo "<span style='color: red;'>FAIL TYM ÜLKEN</span>";
            return false;
        }

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
            return true;
        } else {
            header('Location: error.php');
            return false;
        } 
    }
    function isFileSizeValid2($file_size, $korsetkish, $TutorID,$TutorID2, $connection){
        if (!$file_size) {  
            echo "<span style='color: red;'>FAIL TYM ÜLKEN</span>";
            return false;
        }

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

        $sql3 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID2' AND kod_korset = '$korsetkish'";
        $res3 = mysqli_query($connection, $sql3) or die(mysqli_error($connection));
        $korset_massiv3 = mysqli_fetch_array($res3);

        $b2 = $korset_massiv3['wCount'];
        echo $b2 . "<br />";
        if ($b < $a && $b2 < $a) {
            return true;
        } else {
            header('Location: error.php');
            return false;
        } 
    }

    function isFileSizeValid3($file_size, $korsetkish, $TutorID, $TutorID2, $TutorID3, $connection){
        if (!$file_size) {  
            echo "<span style='color: red;'>FAIL TYM ÜLKEN</span>";
            return false;
        }

        $sql = "SELECT * FROM korsetkishter WHERE kod_korsetkish = '$korsetkish'";
        $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $korset_massiv = mysqli_fetch_array($res);

        $a = $korset_massiv['shekteu'];
        echo $a . "<br />";
        //автор 1
        $sql2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID' AND kod_korset = '$korsetkish'";
        $res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
        $korset_massiv2 = mysqli_fetch_array($res2);

        $b = $korset_massiv2['wCount'];
        echo $b . "<br />";
        // автор 2
        $sql3 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID2' AND kod_korset = '$korsetkish'";
        $res3 = mysqli_query($connection, $sql3) or die(mysqli_error($connection));
        $korset_massiv3 = mysqli_fetch_array($res3);

        $b2 = $korset_massiv3['wCount'];
        echo $b2 . "<br />";
        // автор 3
        $sql4 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID3' AND kod_korset = '$korsetkish'";
        $res4 = mysqli_query($connection, $sql4) or die(mysqli_error($connection));
        $korset_massiv4 = mysqli_fetch_array($res4);

        $b3 = $korset_massiv3['wCount'];
        echo $b3 . "<br />";

        if ($b < $a && $b2 < $a && $b3<$a) {
            return true;
        } else {
            header('Location: error.php');
            return false;
        } 
    }
    function isFileSizeValid4($file_size, $korsetkish, $TutorID, $TutorID2, $TutorID3, $TutorID4, $connection){
        if (!$file_size) {  
            echo "<span style='color: red;'>FAIL TYM ÜLKEN</span>";
            return false;
        }

        $sql = "SELECT * FROM korsetkishter WHERE kod_korsetkish = '$korsetkish'";
        $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $korset_massiv = mysqli_fetch_array($res);

        $a = $korset_massiv['shekteu'];
        echo $a . "<br />";
        //автор 1
        $sql2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID' AND kod_korset = '$korsetkish'";
        $res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
        $korset_massiv2 = mysqli_fetch_array($res2);

        $b = $korset_massiv2['wCount'];
        echo $b . "<br />";
        // автор 2
        $sql_avtor2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID2' AND kod_korset = '$korsetkish'";
        $res_avtor2 = mysqli_query($connection, $sql_avtor2) or die(mysqli_error($connection));
        $korset_massiv_avtor2 = mysqli_fetch_array($res_avtor2);

        $b2 = $korset_massiv_avtor2['wCount'];
        echo $b2 . "<br />";
        // автор 3
        $sql_avtor3 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID3' AND kod_korset = '$korsetkish'";
        $res_avtor3 = mysqli_query($connection, $sql_avtor3) or die(mysqli_error($connection));
        $korset_massiv_avtor3 = mysqli_fetch_array($res_avtor3);

        $b3 = $korset_massiv_avtor3['wCount'];
        echo $b3 . "<br />";
        // автор 4

        $sql_avtor4 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID4' AND kod_korset = '$korsetkish'";
        $res_avtor4 = mysqli_query($connection, $sql_avtor4) or die(mysqli_error($connection));
        $korset_massiv_avtor4 = mysqli_fetch_array($res_avtor4);

        $b4 = $korset_massiv_avtor4['wCount'];
        echo $b4 . "<br />";
        if ($b < $a && $b2 < $a && $b3<$a && $b4<$a) {
            return true;
        } else {
            header('Location: error.php');
            return false;
        } 
    }

    function isFileSizeValid5($file_size, $korsetkish, $TutorID, $TutorID2, $TutorID3, $TutorID4,$TutorID5, $connection){
        if (!$file_size) {  
            echo "<span style='color: red;'>FAIL TYM ÜLKEN</span>";
            return false;
        }

        $sql = "SELECT * FROM korsetkishter WHERE kod_korsetkish = '$korsetkish'";
        $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $korset_massiv = mysqli_fetch_array($res);

        $a = $korset_massiv['shekteu'];
        echo $a . "<br />";
        //автор 1
        $sql2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID' AND kod_korset = '$korsetkish'";
        $res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
        $korset_massiv2 = mysqli_fetch_array($res2);

        $b = $korset_massiv2['wCount'];
        echo $b . "<br />";
        // автор 2
        $sql_avtor2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID2' AND kod_korset = '$korsetkish'";
        $res_avtor2 = mysqli_query($connection, $sql_avtor2) or die(mysqli_error($connection));
        $korset_massiv_avtor2 = mysqli_fetch_array($res_avtor2);

        $b2 = $korset_massiv_avtor2['wCount'];
        echo $b2 . "<br />";
        // автор 3
        $sql_avtor3 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID3' AND kod_korset = '$korsetkish'";
        $res_avtor3 = mysqli_query($connection, $sql_avtor3) or die(mysqli_error($connection));
        $korset_massiv_avtor3 = mysqli_fetch_array($res_avtor3);

        $b3 = $korset_massiv_avtor3['wCount'];
        echo $b3 . "<br />";
        // автор 4

        $sql_avtor4 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID4' AND kod_korset = '$korsetkish'";
        $res_avtor4 = mysqli_query($connection, $sql_avtor4) or die(mysqli_error($connection));
        $korset_massiv_avtor4 = mysqli_fetch_array($res_avtor4);

        $b4 = $korset_massiv_avtor4['wCount'];
        echo $b4 . "<br />";

        //автор 5
        $sql_avtor5 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID5' AND kod_korset = '$korsetkish'";
        $res_avtor5 = mysqli_query($connection, $sql_avtor5) or die(mysqli_error($connection));
        $korset_massiv_avtor5 = mysqli_fetch_array($res_avtor5);

        $b5 = $korset_massiv_avtor5['wCount'];
        echo $b5 . "<br />";
        if ($b < $a && $b2 < $a && $b3<$a && $b4<$a && $b5<$a) {
            return true;
        } else {
            header('Location: error.php');
            return false;
        } 
    }

    function isFileSizeValid6($file_size, $korsetkish, $TutorID, $TutorID2, $TutorID3, $TutorID4,$TutorID5,$TutorID6, $connection){
        if (!$file_size) {  
            echo "<span style='color: red;'>FAIL TYM ÜLKEN</span>";
            return false;
        }

        $sql = "SELECT * FROM korsetkishter WHERE kod_korsetkish = '$korsetkish'";
        $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $korset_massiv = mysqli_fetch_array($res);

        $a = $korset_massiv['shekteu'];
        echo $a . "<br />";
        //автор 1
        $sql2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID' AND kod_korset = '$korsetkish'";
        $res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
        $korset_massiv2 = mysqli_fetch_array($res2);

        $b = $korset_massiv2['wCount'];
        echo $b . "<br />";
        // автор 2
        $sql_avtor2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID2' AND kod_korset = '$korsetkish'";
        $res_avtor2 = mysqli_query($connection, $sql_avtor2) or die(mysqli_error($connection));
        $korset_massiv_avtor2 = mysqli_fetch_array($res_avtor2);

        $b2 = $korset_massiv_avtor2['wCount'];
        echo $b2 . "<br />";
        // автор 3
        $sql_avtor3 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID3' AND kod_korset = '$korsetkish'";
        $res_avtor3 = mysqli_query($connection, $sql_avtor3) or die(mysqli_error($connection));
        $korset_massiv_avtor3 = mysqli_fetch_array($res_avtor3);

        $b3 = $korset_massiv_avtor3['wCount'];
        echo $b3 . "<br />";
        // автор 4

        $sql_avtor4 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID4' AND kod_korset = '$korsetkish'";
        $res_avtor4 = mysqli_query($connection, $sql_avtor4) or die(mysqli_error($connection));
        $korset_massiv_avtor4 = mysqli_fetch_array($res_avtor4);

        $b4 = $korset_massiv_avtor4['wCount'];
        echo $b4 . "<br />";

        //автор 5
        $sql_avtor5 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID5' AND kod_korset = '$korsetkish'";
        $res_avtor5 = mysqli_query($connection, $sql_avtor5) or die(mysqli_error($connection));
        $korset_massiv_avtor5 = mysqli_fetch_array($res_avtor5);

        $b5 = $korset_massiv_avtor5['wCount'];
        echo $b5 . "<br />";

        //автор 6
        $sql_avtor6 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID6' AND kod_korset = '$korsetkish'";
        $res_avtor6 = mysqli_query($connection, $sql_avtor6) or die(mysqli_error($connection));
        $korset_massiv_avtor6 = mysqli_fetch_array($res_avtor6);

        $b6 = $korset_massiv_avtor6['wCount'];
        echo $b6 . "<br />";
        if ($b < $a && $b2 < $a && $b3<$a && $b4<$a && $b5<$a && $b6<$a) {
            return true;
        } else {
            header('Location: error.php');
            return false;
        } 
    }

    function isFileSizeValid7($file_size, $korsetkish, $TutorID, $TutorID2, $TutorID3, $TutorID4,$TutorID5,$TutorID6, $TutorID7, $connection){
        if (!$file_size) {  
            echo "<span style='color: red;'>FAIL TYM ÜLKEN</span>";
            return false;
        }

        $sql = "SELECT * FROM korsetkishter WHERE kod_korsetkish = '$korsetkish'";
        $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $korset_massiv = mysqli_fetch_array($res);

        $a = $korset_massiv['shekteu'];
        echo $a . "<br />";
        //автор 1
        $sql2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID' AND kod_korset = '$korsetkish'";
        $res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
        $korset_massiv2 = mysqli_fetch_array($res2);

        $b = $korset_massiv2['wCount'];
        echo $b . "<br />";
        // автор 2
        $sql_avtor2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID2' AND kod_korset = '$korsetkish'";
        $res_avtor2 = mysqli_query($connection, $sql_avtor2) or die(mysqli_error($connection));
        $korset_massiv_avtor2 = mysqli_fetch_array($res_avtor2);

        $b2 = $korset_massiv_avtor2['wCount'];
        echo $b2 . "<br />";
        // автор 3
        $sql_avtor3 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID3' AND kod_korset = '$korsetkish'";
        $res_avtor3 = mysqli_query($connection, $sql_avtor3) or die(mysqli_error($connection));
        $korset_massiv_avtor3 = mysqli_fetch_array($res_avtor3);

        $b3 = $korset_massiv_avtor3['wCount'];
        echo $b3 . "<br />";
        // автор 4

        $sql_avtor4 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID4' AND kod_korset = '$korsetkish'";
        $res_avtor4 = mysqli_query($connection, $sql_avtor4) or die(mysqli_error($connection));
        $korset_massiv_avtor4 = mysqli_fetch_array($res_avtor4);

        $b4 = $korset_massiv_avtor4['wCount'];
        echo $b4 . "<br />";

        //автор 5
        $sql_avtor5 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID5' AND kod_korset = '$korsetkish'";
        $res_avtor5 = mysqli_query($connection, $sql_avtor5) or die(mysqli_error($connection));
        $korset_massiv_avtor5 = mysqli_fetch_array($res_avtor5);

        $b5 = $korset_massiv_avtor5['wCount'];
        echo $b5 . "<br />";

        //автор 6
        $sql_avtor6 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID6' AND kod_korset = '$korsetkish'";
        $res_avtor6 = mysqli_query($connection, $sql_avtor6) or die(mysqli_error($connection));
        $korset_massiv_avtor6 = mysqli_fetch_array($res_avtor6);

        $b6 = $korset_massiv_avtor6['wCount'];
        echo $b6 . "<br />";

        //автор 7
        $sql_avtor7 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID7' AND kod_korset = '$korsetkish'";
        $res_avtor7 = mysqli_query($connection, $sql_avtor7) or die(mysqli_error($connection));
        $korset_massiv_avtor7 = mysqli_fetch_array($res_avtor7);

        $b7 = $korset_massiv_avtor7['wCount'];
        echo $b7 . "<br />";
        if ($b < $a && $b2 < $a && $b3<$a && $b4<$a && $b5<$a && $b6<$a && $b7<$a) {
            return true;
        } else {
            header('Location: error.php');
            return false;
        } 
    }
    function error(){
        return "error: ";
    }
    
?>