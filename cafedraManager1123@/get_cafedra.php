<?php
	include('../incs/connect.php');
	
	$output = '';
	
	$sql = 'SELECT * FROM cafedras WHERE FacultyID = "'.$_POST["FacultyID"].'"';
	
	$result = mysql_query($sql) or die(mysql_error());
	?><option selected="selected">---</option><?php
    while($row = mysql_fetch_array($result)){
        $output .= "<option value=" . $row['cafedraID'] . ">" . $row['cafedraNameKZ'] . "</option>";
    } 
	echo $output; 	
?>