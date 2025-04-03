<?php

	include('../incs/connect.php');

	

	$query = mysqli_query($connection,"SELECT * FROM tutors WHERE TutorID = '$_POST[tutorID]'") or die(mysqli_error($connection));

	$tutor = mysqli_fetch_array($query);

	

	if(isset($_POST['submit_change'])){

		$old_password = $_POST['old_password'];

		

		$old = md5($old_password);

		

		if($old == $tutor['Password']){

			$new_password = md5($_POST['new_password']);			

			$update = mysqli_query($connection,"UPDATE tutors SET `Password` = '$new_password' WHERE `TutorID` = '$_POST[tutorID]'") or die(mysqli_error($connection));

			header('Location: show_ch_pass.php');

		} else {

			echo "Қате № 2 пароль дұрыс емес сияқты";

		}		

	} else {

		echo "Қате № 1";

	}

?>