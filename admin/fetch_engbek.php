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
		.tolyk{
			color: blue;
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
	
	$where = ' WHERE 1=1 ';
 
    if (!empty($_POST["FacultyID"]))
        $where .= ' AND kod_fakul = "' . $_POST["FacultyID"].'"';
	
    if (!empty($_POST["statusID"]))
        $where .=  ' AND kod_stat = "' . $_POST["statusID"].'"';
 
    //$sql = "SELECT  engbekter ". $where;
	
	/* $sql = "SELECT engbekter.engbekID, korsetkishter.korsetkish_ati, engbekter.sani, korsetkishter.kos_avtor, engbekter.file_ati, engbekter.ball, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ
	FROM engbekter
	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
	INNER JOIN status ON status.statusID = engbekter.kod_stat".$where; */
	
	$sql = "SELECT engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, korsetkishter.korsetkish_ati, engbekter.sani, korsetkishter.kos_avtor, engbekter.file_ati, engbekter.ball, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ 
	FROM engbekter
	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
	INNER JOIN status ON status.statusID = engbekter.kod_stat ".$where;
	
	$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
	
	echo "<table><tr><th>№</th><th>Кафедра атауы</th><th>Аты жөні</th><th>Көрсеткіш</th><th>Саны</th><th>Қосымша автор саны</th><th>Файл аты</th><th>Балл</th><th>Қайтару себебі</th><th>Статус</th><th>Толығырақ</th></tr>";
	
	$i = 1;
	
    while($row = mysqli_fetch_array($result)){
        $output .= "<tr><td>".$i."</td><td>".$row["cafedraNameKZ"]."</td><td>".$row["lastname"]." ".$row["firstname"]."</td><td>".$row["korsetkish_ati"]."</td><td>".$row["sani"]."</td><td>".$row["kos_avtor"]."</td><td>".$row["file_ati"]."</td><td>".$row["ball"]."</td><td>".$row["kayt_sebeb"]."</td><td>".$row["status_name"]."</td><td><a href = \"engbek.php?ID=" . $row['engbekID'] . "\">Толық</a></td></tr>";
		$i++;		
    } 
	
	echo $output;
	
	echo "</table>";    	
?>