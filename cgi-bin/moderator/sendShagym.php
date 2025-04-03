<?php
	include('../incs/connect.php');
	
	$TutorID = $_POST['tutor'];
	$engbekID = $_POST['engbek'];
	$shagym = $_POST['shagym'];
	$shagym_date = $_POST['shagym_date'];
	
	if(isset($_POST['send'])){
		if(isset($_POST['faculty'])){
			if(isset($_POST['cafedra'])){
				if(isset($_POST['tutor'])){
					if(isset($_POST['engbek'])){
						$sql = mysqli_query($connection,"INSERT INTO shagymdar(kod_enbek, shagym, kod_kizm, shagym_kuni) VALUES('$engbekID','$shagym','$TutorID','$shagym_date')") or die(mysqli_error($connection));
						header('Location: show_shagym_d.php');
					} else {
						echo "Еңбек таңдаңыз";
					}
				} else {
					echo "Оқытушы немесе ғылыми қызметкер таңдаңыз";
				}
			} else {
				echo "Кафедра немесе ҒЗИ таңдаңыз";
			}
		} else {
			echo "Факультет немесе ҒЗО таңдаңыз";
		}		
	} else {
		echo "Бір қате бар";
	}
?>