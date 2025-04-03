<?php
	include('../incs/connect.php');
	
	$output = '';
	
	$sql = 'SELECT * FROM cafedras WHERE FacultyID = "'.$_POST["FacultyID"].'"';
	
	$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
	?><option selected="selected">---</option><?php
    while($row = mysqli_fetch_array($result)){
        $sCafedra = $row['cafedraNameKZ'];
        if ($_SESSION['lang'] != 'kaz'){
            $sCafedra = isset($row['cafedraNameRU']) && mb_strlen($row['cafedraNameRU']) ? $row['cafedraNameRU'] : $row['cafedraNameKZ'];
        }
        $output .= "<option value=" . $row['cafedraID'] . ">" . $sCafedra . "</option>";
    } 
	echo $output; 	
?>