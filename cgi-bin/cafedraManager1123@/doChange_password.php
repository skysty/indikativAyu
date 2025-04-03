<?php
	include('../incs/connect.php');
	
	$query = mysql_query("SELECT * FROM tutors WHERE TutorID = '$_POST[tutorID]'") or die(mysql_error());
	$tutor = mysql_fetch_array($query);
	
	if(isset($_POST['submit_change'])){
		$old_password = $_POST['old_password'];
		
		$old = md5($old_password);
		
		if($old == $tutor['Password']){
			$new_password = md5($_POST['new_password']);			
			$update = mysql_query("UPDATE tutors SET `Password` = '$new_password' WHERE `TutorID` = '$_POST[tutorID]'") or die(mysql_error());
			header('Location: show_ch_pass.php');
		} else {
			echo "Қате № 2 пароль дұрыс емес сияқты";
		}		
	} else {
		echo "Қате № 1";
	}
?>