	<style>
		table {
			border-collapse: collapse;
			border:1px black solid;
			width: 100%;
			font-size: 12px;
		}

		th, td {
			text-align: left;
			padding: 6px;
			border:1px black solid;
		}

		th {
			background-color: #003366;
			color: white;
		}
	</style>
<?php
	include('../incs/connect.php');
	
	$output = '';
	
/*	$sql = "SELECT * FROM state WHERE countryID = '".$_POST["countryID"]."' AND stateID = '".$_POST["stateID"]."'";
	
	$result = mysql_query($sql) or die(mysql_error());
	
	while($row = mysql_fetch_array($result)){		
		$output .= $row["stateID"]." ".$row["state_name"]."<br>";		
	}	*/
	
	//$where = ' WHERE 1=1 ';
 
    //if (!empty($_POST["TutorID"]))
        //$where .= ' AND kod_kizm = "' . $_POST["TutorID"].'"';
	
		$tutor_id = $_POST["TutorID"];
 
    //$sql = "SELECT  engbekter ". $where;
	
	/* $sql = "SELECT engbekter.engbekID, korsetkishter.korsetkish_ati, engbekter.sani, korsetkishter.kos_avtor, engbekter.file_ati, engbekter.ball, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ
	FROM engbekter
	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
	INNER JOIN status ON status.statusID = engbekter.kod_stat".$where; */
	
	$sql = "SELECT engbekter.ball, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ 
	FROM engbekter 
	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
	INNER JOIN status ON status.statusID = engbekter.kod_stat 
	WHERE kod_kizm = '$tutor_id' ORDER BY engbekter.engbekID DESC";
	
	$sql2 = "SELECT engbekter.ball, SUM(engbekter.ball) AS sum_val, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ
	FROM engbekter 
	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
	INNER JOIN status ON status.statusID = engbekter.kod_stat 
	WHERE kod_kizm = '$tutor_id'";
	
	$sql3 = "SELECT engbekter.ball, SUM(engbekter.ball) AS sum_gylym, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ, korsetkishter.typeID
	FROM engbekter 
	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
	INNER JOIN status ON status.statusID = engbekter.kod_stat 
	WHERE kod_kizm = '$tutor_id' AND korsetkishter.typeID = '1'";
	
	$sql4 = "SELECT engbekter.ball, SUM(engbekter.ball) AS sum_oku, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ, korsetkishter.typeID
	FROM engbekter 
	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
	INNER JOIN status ON status.statusID = engbekter.kod_stat 
	WHERE kod_kizm = '$tutor_id' AND korsetkishter.typeID = '2'";
	
	$sql5 = "SELECT engbekter.ball, SUM(engbekter.ball) AS sum_tarbie, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ, korsetkishter.typeID
	FROM engbekter 
	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
	INNER JOIN status ON status.statusID = engbekter.kod_stat 
	WHERE kod_kizm = '$tutor_id' AND korsetkishter.typeID = '3'";
	
	$result = mysql_query($sql) or die(mysql_error());
	
	$result2 = mysql_query($sql2) or die(mysql_error());
	
	$result3 = mysql_query($sql3) or die(mysql_error());
	
	$result4 = mysql_query($sql4) or die(mysql_error());
	
	$result5 = mysql_query($sql5) or die(mysql_error());
	
	$new_row = mysql_fetch_array($result2);
	
	$new_row3 = mysql_fetch_array($result3);
	
	$new_row4 = mysql_fetch_array($result4);
	
	$new_row5 = mysql_fetch_array($result5);
	
	echo "<div style = 'margin: 0 auto; width: 200px;'><p><strong>Ғылым:</strong> ". $new_row3['sum_gylym'] ."</p>";
	
	echo "<p><strong>Оқу-әдістемелік:</strong> ". $new_row4['sum_oku'] ."</p>";
	
	echo "<p><strong>Тәрбие:</strong> ". $new_row5['sum_tarbie'] ."</p>";
	
	echo "<p><strong>Жалпы балл:</strong> ". $new_row['sum_val'] ."</p></div><br />";
	
	echo "<table><tr><th>№</th><th>Кафедра/ҒЗИ</th><th>Аты жөні</th><th>Көрсеткіш</th><th>Саны</th><th>Автор саны</th><th>Файл аты</th><th>Балл</th><th>Ескерту</th><th>Статус</th></tr>";
	
	$i = 1;
	
    while($row = mysql_fetch_array($result)){
        $output .= "<tr><td>".$i."</td><td>".$row["cafedraNameKZ"]."</td><td>".$row["lastname"]." ".$row["firstname"]."</td><td>".$row["korsetkish_ati"]."</td><td>".$row["sani"]."</td><td>".$row["univ_avtor_san"]."</td><td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td><td>".$row["ball"]."</td><td>".$row["eskertu"]."</td><td>".$row["status_name"]."</td></tr>";
		$i++;
    }
	
	echo $output;
	
	echo "</table>";    	
?>