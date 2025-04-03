<?php
	include('../incs/connect.php');
	session_start();
	$output = '';
	
	$sql = 'SELECT * FROM cafedras WHERE FacultyID = "'.$_POST["FacultyID"].'"';
	
	$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
	?><option selected="selected">---</option><?php
    while($row = mysqli_fetch_array($result)){
        $sCafedra = $row['cafedraNameKZ'];
        if ($_SESSION['lang'] != 'kaz'){
            $sCafedra = isset($row['cafedraNameTR']) && mb_strlen($row['cafedraNameTR']) ? $row['cafedraNameTR'] : $row['cafedraNameKZ'];
        }
        $output .= "<option value=" . $row['cafedraID'] . ">" . $sCafedra . "</option>";
    } 
	echo $output; 	
?>