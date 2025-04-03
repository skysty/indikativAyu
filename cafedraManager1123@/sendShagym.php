<?php
	include('../incs/connect.php');
	
	$TutorID = $_POST['tutor'];
	$engbekID = $_POST['engbek'];
	$shagym = $_POST['shagym'];
	$shagym_date = $_POST['shagym_date'];
	
	if(isset($_POST['send'])){
		$sql = mysql_query("INSERT INTO shagymdar(kod_enbek, shagym, kod_kizm, shagym_kuni) VALUES('$engbekID','$shagym','$TutorID','$shagym_date')") or die(mysql_error());
		header('Location: show_shagym_d.php');
	} else {
		echo "Бір қате бар";
	}
?>