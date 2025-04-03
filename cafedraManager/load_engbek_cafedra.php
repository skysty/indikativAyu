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
			echo "<span style = 'color: red;'>QATE: faıldy tañdap, jükteñız</span>";
		} else {
			
			$sql = "SELECT * FROM korsetkishter WHERE kod_korsetkish = '$korsetkish'";
			$res = mysqli_query($connection,$sql) or die(mysqli_error($connection));
			$korset_massiv = mysqli_fetch_array($res);
			
			$a = $korset_massiv['shekteu'];
			echo $a."<br />";
			
			$sql2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID' AND kod_korset = '$korsetkish'";
			$res2 = mysqli_query($connection,$sql2) or die(mysqli_error($connection));
			$korset_massiv2 = mysqli_fetch_array($res2);
			
			$b = $korset_massiv2['wCount'];
			echo $b."<br />";
			
			if($b < $a){
				$temp = explode(".", $file);
				$newfilename = $TutorID."_".round(time()) . '.' . end($temp);
				move_uploaded_file($file_temp, __DIR__ ."/../files/".$newfilename);
				
				$query = mysqli_query($connection,"INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni) VALUES('$korsetkish','$TutorID','11','1','$FacultyID','$cafedraID','$sani','$date','../files/$newfilename','-','0','$eskertu','2','0','0','$save_date')") or die(mysqli_error($connection));
				header('Location: show_load_caf.php');
			} else {
				header('Location: error.php');
			}
		}
	} else {
		echo "BIR QATE BAR";
	}
?>