<?php
	include('../incs/connect.php');
	
	session_start();
					
	if(isset($_GET['ID'])){
		$query = mysqli_query($connection,"DELETE FROM engbekter WHERE engbekID = '$_GET[ID]'") or die(mysqli_error($connection));		
		header('Location: engbek_jukteu.php');
	} else {
		echo "Error";
	}
?>