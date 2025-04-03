<?php
	require_once('../incs/connect.php');
    session_start();
	$_SESSION['lang'];
	$sql = 'SELECT * FROM cafedras WHERE FacultyID = "'.$_POST["FacultyID"].'"';
	
	$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
    $data = array();
    while($row = mysqli_fetch_array($result)){
        $sCafedra = $row['cafedraNameKZ'];
        if ($_SESSION['lang'] != 'kaz'){
            $sCafedra = isset($row['cafedraNameTR']) && mb_strlen($row['cafedraNameTR']) ? $row['cafedraNameTR'] : $row['cafedraNameKZ'];
        }
        $row=array(
            'cafedraId'=>$row['cafedraID'],
            'cafedraName'=>$sCafedra
        );
        $data[]=$row;
    } 
	echo json_encode($data);
?>