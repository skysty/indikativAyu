<?php

    require_once('../incs/connect.php');
    session_start();
    $_SESSION['lang'];

	$sql = 'SELECT * FROM tutors WHERE deleted=0 AND cafedraID = "'.$_POST["cafedraID"].'"';  

	$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
    $data=array();
    while($row = mysqli_fetch_array($result)){
        $sLastName = $row['lastname'];
        $sFirstName = $row['firstname'];
        $sPatronymic = $row['patronymic'];
        if ($_SESSION['lang'] != 'kaz'){
            $sLastName = isset($row['lastnameTR']) && mb_strlen($row['lastnameTR']) ? $row['lastnameTR'] : $row['lastname'];
            $sFirstName = isset($row['firstnameTR']) && mb_strlen($row['firstnameTR']) ? $row['firstnameTR'] : $row['firstname'];
            $sPatronymic = isset($row['patronymicTR']) && mb_strlen($row['patronymicTR']) ? $row['patronymicTR'] : $row['patronymic'];
        }
        $row=array(
            'tutorId'=>$row['TutorID'],
            'fullname'=>$sLastName ." ". $sFirstName ." ". $sPatronymic
        );
        $data[]=$row;
    } 

	echo json_encode($data);	

?>