<?php
	include('../incs/connect.php');
	
	$output = '';
	
	$sql = 'SELECT * FROM tutors WHERE cafedraID = "'.$_POST["cafedraID"].'"';
	
	$result = mysql_query($sql) or die(mysql_error());
	?><option selected="selected">---</option><?php
    while($row = mysql_fetch_array($result)){
        $output .= "<option value=" . $row['TutorID'] . ">" . $row['lastname'] ." ". $row['firstname'] ." ". $row['patronymic'] ."</option>";
    } 
	echo $output; 	
?>