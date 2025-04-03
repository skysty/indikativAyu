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

	

	$sql = "SELECT engbekter.ball, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, tutors.firstnameRu, tutors.lastnameRu, tutors.patronymicRu, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ , cafedras.cafedraNameRU, faculties.facultyNameRU 

	FROM engbekter 

	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 

	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 

	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset

	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 

	INNER JOIN status ON status.statusID = engbekter.kod_stat 

	WHERE kod_kizm = '$tutor_id' and del=0 ORDER BY engbekter.engbekID DESC";

	

	$sql2 = "SELECT engbekter.ball, SUM(engbekter.ball) AS sum_val, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, tutors.firstnameRu, tutors.lastnameRu, tutors.patronymicRu, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ, cafedras.cafedraNameRU, faculties.facultyNameRU

	FROM engbekter 

	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 

	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 

	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset

	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 

	INNER JOIN status ON status.statusID = engbekter.kod_stat 

	WHERE kod_kizm = '$tutor_id' and del=0" ;

	

	$sql3 = "SELECT engbekter.ball, SUM(engbekter.ball) AS sum_gylym, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, tutors.firstnameRu, tutors.lastnameRu, tutors.patronymicRu, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ, cafedras.cafedraNameRU, faculties.facultyNameRU, korsetkishter.typeID

	FROM engbekter 

	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 

	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 

	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset

	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 

	INNER JOIN status ON status.statusID = engbekter.kod_stat 

	WHERE kod_kizm = '$tutor_id' AND korsetkishter.typeID = '1' and del=0";

	

	$sql4 = "SELECT engbekter.ball, SUM(engbekter.ball) AS sum_oku, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, tutors.firstnameRu, tutors.lastnameRu, tutors.patronymicRu, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ, cafedras.cafedraNameRU, faculties.facultyNameRU, korsetkishter.typeID

	FROM engbekter 

	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 

	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 

	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset

	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 

	INNER JOIN status ON status.statusID = engbekter.kod_stat 

	WHERE kod_kizm = '$tutor_id' AND korsetkishter.typeID = '2' and del=0";

	

	$sql5 = "SELECT engbekter.ball, SUM(engbekter.ball) AS sum_tarbie, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, tutors.firstnameRu, tutors.lastnameRu, tutors.patronymicRu, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ, cafedras.cafedraNameRU, faculties.facultyNameRU, korsetkishter.typeID

	FROM engbekter 

	INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 

	INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 

	INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset

	INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 

	INNER JOIN status ON status.statusID = engbekter.kod_stat 

	WHERE kod_kizm = '$tutor_id' AND korsetkishter.typeID = '3' and del=0";

	

	$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));

	

	$result2 = mysqli_query($connection,$sql2) or die(mysqli_error($connection));

	

	$result3 = mysqli_query($connection,$sql3) or die(mysqli_error($connection));

	

	$result4 = mysqli_query($connection,$sql4) or die(mysqli_error($connection));

	

	$result5 = mysqli_query($connection,$sql5) or die(mysqli_error($connection));

	

	$new_row = mysqli_fetch_array($result2);

	

	$new_row3 = mysqli_fetch_array($result3);

	

	$new_row4 = mysqli_fetch_array($result4);

	

	$new_row5 = mysqli_fetch_array($result5);

	

	echo "<div style = 'margin: 0 auto; width: 200px;'><p><strong>".$oL::get('Ғылым')." 50%:</strong> ". $new_row3['sum_gylym'] ."</p>";

	

	echo "<p><strong>".$oL::get('Оқу-әдістемелік')." 35%:</strong> ". $new_row4['sum_oku'] ."</p>";

	

	echo "<p><strong>".$oL::get('Тәрбие')." 15%:</strong> ". $new_row5['sum_tarbie'] ."</p>";

	

	echo "<p><strong>".$oL::get('Жалпы балл').":</strong> ". $new_row['sum_val'] ."</p></div><br />";

	

	echo "<table><tr><th>№</th><th>".$oL::get('Кафедра/ҒЗИ')."</th><th>".$oL::get('Аты жөні')."</th><th>".$oL::get('Көрсеткіш')."</th><th>".$oL::get('Саны')."</th><th>".$oL::get('Автор саны')."</th><th>".$oL::get('Файл аты')."</th><th>".$oL::get('Балл')."</th><th>".$oL::get('Ескерту')."</th><th>".$oL::get('Статус')."</th></tr>";

	

	$i = 1;

	

    while($row = mysqli_fetch_array($result)){

        $sLastName = $row['lastname'];
        $sFirstName = $row['firstname'];
        $sPatronymic = $row['patronymic'];
        $sFacult = $row['facultyNameKZ'];
        $sCafedra = $row['cafedraNameKZ'];
        if ($_SESSION['lang'] != 'kaz'){
            $sLastName = isset($row['lastnameRu']) && mb_strlen($row['lastnameRu']) ? $row['lastnameRu'] : $row['lastname'];
            $sFirstName = isset($row['firstnameRu']) && mb_strlen($row['firstnameRu']) ? $row['firstnameRu'] : $row['firstname'];
            $sPatronymic = isset($row['patronymicRu']) && mb_strlen($row['patronymicRu']) ? $row['patronymicRu'] : $row['patronymic'];
            $sFacult = isset($row['facultyNameRU']) && mb_strlen($row['facultyNameRU']) ? $row['facultyNameRU'] : $row['facultyNameKZ'];
            $sCafedra = isset($row['cafedraNameRU']) && mb_strlen($row['cafedraNameRU']) ? $row['cafedraNameRU'] : $row['cafedraNameKZ'];
        }

        $output .= "<tr><td>".$i."</td><td>".$sCafedra."</td><td>".$sLastName." ".$sFirstName."</td><td>".$row["korsetkish_ati"]."</td><td>".$row["sani"]."</td><td>".$row["univ_avtor_san"]."</td><td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td><td>".$row["ball"]."</td><td>".$row["eskertu"]."</td><td>".$oL::get($row["status_name"])."</td></tr>";

		$i++;

    }

	

	echo $output;

	

	echo "</table>";    	

?>