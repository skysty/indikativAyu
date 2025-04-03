<?php
	include('../incs/connect.php');
	
	session_start();
					
	if(isset($_GET['ID'])){
		$query = mysql_query("DELETE FROM engbekter WHERE engbekID = '$_GET[ID]'") or die(mysql_error());		
		header('Location: engbek_jukteu.php');
	} else {
		echo "Error";
	}
?>