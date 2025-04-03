<?php
	include('../incs/connect.php');
	
	$output = '';
	
	$sql = 'SELECT * FROM engbekter WHERE kod_kizm = "'.$_POST["TutorID"].'"';
	
	$result = mysql_query($sql) or die(mysql_error());
	
    while($row = mysql_fetch_array($result)){
        $output .= "<option value=" . $row['engbekID'] . ">" . $row['file_ati'] . "</option>";
    } 
	echo $output; 	
?>