<?php
	include('../incs/connect.php');
	
	if(isset($_POST['upload'])){
		
		$korsetkish = $_POST['korsetkish'];
		$date = $_POST['date'];
		$save_date = $_POST['save_date'];
		$eskertu = $_POST['eskertu'];
		$FacultyID = $_POST['faculty'];
		$cafedraID = $_POST['cafedra'];
		$TutorID = $_POST['tutor_id'];
		$sani = $_POST['sany'];
	
		$file = $_FILES['file']['name'];
		$file_size = $_FILES['file']['size'];
		$file_temp = $_FILES['file']['tmp_name'];
		
		if($file_size == FALSE){
			echo "<span style = 'color: red;'>Қате: файлды таңдап, жүктеңіз</span>";
		} else {
			
			$sql = "SELECT * FROM korsetkishter WHERE kod_korsetkish = '$korsetkish'";
			$res = mysql_query($sql) or die(mysql_error());
			$korset_massiv = mysql_fetch_array($res);
			
			$a = $korset_massiv['shekteu'];
			echo $a."<br />";
			
			$sql2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID' AND kod_korset = '$korsetkish'";
			$res2 = mysql_query($sql2) or die(mysql_error());
			$korset_massiv2 = mysql_fetch_array($res2);
			
			$b = $korset_massiv2['wCount'];
			echo $b."<br />";
			
			if($b < $a){
				$temp = explode(".", $file);
				$newfilename = $TutorID."_".round(time(true)) . '.' . end($temp);
				move_uploaded_file($file_temp, __DIR__ ."/../files/".$newfilename);
				
				$query = mysql_query("INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni) VALUES('$korsetkish','$TutorID','11','1','$FacultyID','$cafedraID','$sani','$date','../files/$newfilename','-','0','$eskertu','2','0','0','$save_date')") or die(mysql_error());
				header('Location: show_load_e.php');
			} else {
				header('Location: error.php');
			}
		}
	} else {
		echo "Бір қате бар";
	}
?>