<?php include('../incs/connect.php');	
	session_start();
?>	
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
	<table>
		<thead>
			<tr>
			<th>№</th>
			<th><?= $oL::get('Кафедра атауы')?></th>
			<th><?= $oL::get('Аты жөні')?></th>
			<th><?= $oL::get('Көрсеткіш')?></th>
			<th><?= $oL::get('Саны')?></th>
			<th><?= $oL::get('Автор саны')?></th>
			<th><?= $oL::get('Файл аты')?></th>
			<th><?= $oL::get('Балл')?></th>
			<th><?= $oL::get('Қайтару себебі')?></th>
			<th><?= $oL::get('Статус')?></th>
			<th><?= $oL::get('Толығырақ')?></th>
			</tr>
		</thead>
	<tbody>
<?php
	$_SESSION['tutor'];	
	
	$output = '';
	
/*	$sql = "SELECT * FROM state WHERE countryID = '".$_POST["countryID"]."' AND stateID = '".$_POST["stateID"]."'";
	
	$result = mysql_query($sql) or die(mysql_error());
	
	while($row = mysql_fetch_array($result)){		
		$output .= $row["stateID"]." ".$row["state_name"]."<br>";		
	}	*/
	
	$login = $_SESSION['tutor'];
	
	$where = ' WHERE 1=1 ';
 
    if (!empty($_POST["TutorID"]))
        $where .= ' AND kod_kizm = "' . $_POST["TutorID"].'"';
 
    if (!empty($_POST["statusID"]))
        $where .=  ' AND kod_stat = "' . $_POST["statusID"].'"';
 
    //$sql = "SELECT  engbekter ". $where;
	
	/* $sql = "SELECT engbekter.engbekID, korsetkishter.korsetkish_ati, engbekter.sani, korsetkishter.kos_avtor, engbekter.file_ati, engbekter.ball, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ
	FROM engbekter
	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
	INNER JOIN status ON status.statusID = engbekter.kod_stat".$where; */
	
	$sql = "SELECT 
	  engbekter.engbekID, 
	  tutors.firstname,
	  tutors.firstnameRu, 
	  tutors.lastname,
	  tutors.lastnameRu,  
	  tutors.patronymic,
	  tutors.patronymicRu,  
	  korsetkishter.korsetkish_ati,
	  korsetkishter.korsetkish_ati2, 
	  engbekter.sani, 
	  korsetkishter.kos_avtor, 
	  engbekter.univ_avtor_san, 
	  engbekter.file_ati, 
	  engbekter.ball, 
	  engbekter.kayt_sebeb, 
	  engbekter.eskertu, 
	  status.status_name,
	  status.status_nameRu,  
	  faculties.FacultyID, 
	  status.statusID, 
	  cafedras.cafedraNameKZ,
	  cafedras.cafedraNameRU,  
	  faculties.facultyNameKZ,
	  faculties.facultyNameRU  
	FROM engbekter 
	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
	INNER JOIN status ON status.statusID = engbekter.kod_stat ".$where."AND (korsetkishter.jauapty = '$login' OR korsetkishter.jauapty_eki = '$login' OR korsetkishter.jauapty_ush = '$login')";
	
	$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
	
	//echo "<table><tr><th>№</th><th>Кафедра атауы</th><th>Аты жөні</th><th>Көрсеткіш</th><th>Саны</th><th>Қосымша автор саны</th><th>Файл аты</th><th>Балл</th><th>Қайтару себебі</th><th>Статус</th><th>Толығырақ</th></tr>";
	
	$i = 1;
	
    while($row = mysqli_fetch_array($result)){

		$sLastName = $row['lastname'];
			$sFirstName = $row['firstname'];
			$sPatronymic = $row['patronymic'];
			  //$sFacult = $row['facultyNameKZ'];
			$sCafedra = $row['cafedraNameKZ'];
			$korsetkih=$row['korsetkish_ati'];
			$statuss=$row['status_name'];
			if ($_SESSION['lang'] != 'kaz'){
				$sLastName = isset($row['lastnameRu']) && mb_strlen($row['lastnameRu']) ? $row['lastnameRu'] : $row['lastname'];
				$sFirstName = isset($row['firstnameRu']) && mb_strlen($row['firstnameRu']) ? $row['firstnameRu'] : $row['firstname'];
				$sPatronymic = isset($row['patronymicRu']) && mb_strlen($row['patronymicRu']) ? $row['patronymicRu'] : $row['patronymic'];
				$sFacult = isset($row['facultyNameRU']) && mb_strlen($row['facultyNameRU']) ? $row['facultyNameRU'] : $row['facultyNameKZ'];
				$sCafedra = isset($row['cafedraNameRU']) && mb_strlen($row['cafedraNameRU']) ? $row['cafedraNameRU'] : $row['cafedraNameKZ'];
				$korsetkih= isset($row['korsetkish_ati2']) && mb_strlen($row['korsetkish_ati2']) ? $row['korsetkish_ati2'] : $row['korsetkish_ati'];
				$statuss=isset($row['status_nameRu']) && mb_strlen($row['status_nameRu']) ? $row['status_nameRu'] : $row['status_name'];
			}

			echo "<tr> ";
			echo "<td>".$i."</td>";
			echo "<td>".$sCafedra."</td>";
			echo "<td>".$sLastName." ".$sFirstName."</td>";
			echo "<td>".$korsetkih."</td>";
			echo "<td>".$row["sani"]."</td>";
			echo "<td>".$row["univ_avtor_san"]."</td>";
			echo "<td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td>";
			echo "<td>".$row["ball"]."</td><td>".$row["kayt_sebeb"]."</td><td>". $statuss ."</td>";
			echo "<a target='_blank' href = \"engbek.php?ID=" . $row['engbekID'] . "\">".$oL::get('Тексеру')."</a></td></td>";
			echo "</tr>";
			$i++;
		}
			   
	?>
	</tbody>
	</table>