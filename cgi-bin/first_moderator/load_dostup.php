<?php
	include('../incs/connect.php');
	
	if(isset($_POST['dpopk'])){
		
		$korsetkish = $_POST['korsetkish'];
		$save_date = $_POST['save_date'];
		$FacultyID = $_POST['faculty'];
		$cafedraID = $_POST['cafedra'];
		$TutorID = $_POST['tutor'];
		$id_tutor = $_POST['tutor_id'];
		try {
				$query = mysqli_query($connection,"INSERT INTO dostupkorset(tutorID, FacultyID, cafedraID, korsetkishID,kuni,moderator_id) VALUES ('$TutorID','$FacultyID','$cafedraID','$korsetkish','$save_date',$id_tutor)") or die(mysqli_error($connection));
				if($query){
					header('Location: show_load_dostup.php');
				} else {
					header('Location: error.php');
			    }
			}catch (Exception $e){
				error_log($e->getMessage());

				// Display an error page to the user
				header("HTTP/1.1 500 Internal Server Error");
				include("../error/error_page.php");
				exit();
			}
	} else {
		echo "Бір қате бар";
	}
?>