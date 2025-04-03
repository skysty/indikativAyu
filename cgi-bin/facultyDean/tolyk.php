<html>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />



<head>



	<?php



		session_start();
		$_SESSION['tutor'];
		include('../incs/connect.php');
		if(!isset($_SESSION['tutor'])){
			header('Location: ../login.php');
		}

		//$query = mysql_query("SELECT * FROM users WHERE username = '$_SESSION[user]'") or die(mysql_error());

		//$main_me = mysql_fetch_array($query);

	?>

	<title><?= $oL::get('Оқытушы туралы')?></title>

	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />

	<style>

		.engbek{
			width: 900px;
			padding: 20px;
			margin: 0 auto;
			margin-bottom: 100px;
			border: black solid 1px;
		}

		.engbek select{
			padding: 5px;
		}
		.engbek	table {
			width: 100%;
			font-size: 14px;
			border: black solid 1px;
		}
		.engbek th td {
			text-align: left;
			padding: 6px;
			border: 0px white solid;
		}
		.to_back:hover{
			background: gray;
		}
		input[type=text],input[type=password],input[type=date]{
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=number]{
			width: 200px;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		.select_box{
			width: 1000px;
			padding: 20px;
			margin: 0 auto;
			margin-top: 30px;
			margin-bottom: 30px;
			border: 1px black solid;
			background: #ddd;
		}
		.btn {
			  background: #3498db;
			  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
			  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
			  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
			  background-image: -o-linear-gradient(top, #3498db, #2980b9);
			  background-image: linear-gradient(to bottom, #3498db, #2980b9);
			  font-family: Arial;
			  color: #ffffff;
			  font-size: 20px;
			  padding: 10px 20px 10px 20px;
			  text-decoration: none;
			}

			.btn:hover {
			  background: #3cb0fd;
			  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
			  text-decoration: none;
			}
			.btn:focus {
				background: #3cb0fd;
			}
			select{
				width: 100%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}
			input[type=submit] {
				width: 150px;
				background-color: #003366;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: 1px black solid;
				cursor: pointer;
			}
			input[type=submit]:hover {
				background-color: #000;
			}
			.login_form{
				margin: 0 auto;
				margin-top: 100px;
				width: 300px;
				padding: 20px;
				border: 1px black solid;				
			}
			.footer{
				margin-top: 100px;
			}
			.works{
				margin: 0 auto;
				width: 1045px;
			}
			.works table {
				border-collapse: collapse;
				border:1px black solid;
				width: 100%;
				font-size: 12px;
			}
			.works th, td {
				text-align: left;
				padding: 6px;
				border:1px black solid;
			}
			.works th {
				background-color: #003366;
				color: white;
			}
	</style>
</head>
<body>
	<div class = "upper_header">
    <?php include '../extensions/header.php'?>
    </div>
	<div class = "header">
	<div id = "menu_nav">
        <?php include '../extensions/nav.php' ?>
	</div>
	</div>
	<div class = "content">
		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 10px;">
			<?php
					$_SESSION['tutor'];
					$sql = mysqli_query($connection,"SELECT * FROM tutors WHERE Login = '$_SESSION[tutor]'") or die(mysqli_error($connection));
					$result = mysqli_fetch_array($sql);
					$sql2 = mysqli_query($connection,"SELECT 
					engbekter.engbekID, 
					SUM(engbekter.ball) AS sum_val,
					engbekter.file_ati,
					engbekter.sani, 
					engbekter.univ_avtor_san, 
					engbekter.eskertu, 
					engbekter.ball, 
					tutors.TutorID, 
					tutors.lastname, 
					tutors.firstname, 
					tutors.patronymic, 
					tutors.lastnameRu, 
					tutors.firstnameRu, 
					tutors.patronymicRu, 
					faculties.facultyNameKZ, 
					cafedras.cafedraNameKZ, 
					faculties.facultyNameRU, 
					cafedras.cafedraNameRU, 
					korsetkishter.korsetkish_ati, 
					status.status_name, 
					kaytaru_sebebi.sebepter
					FROM engbekter
					INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
					INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
					INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
					INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
					INNER JOIN status ON status.statusID = engbekter.kod_stat
					INNER JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb = engbekter.kod_kayt_sebeb
					WHERE TutorID = '$_GET[ID]' and engbekter.del=0 ") or die(mysqli_error($connection));
					$engbek = mysqli_fetch_array($sql2);
					/*Sum gylym*/
					$sql3 = mysqli_query($connection,"SELECT 
					engbekter.engbekID, 
					SUM(engbekter.ball*0.90)*0.50 AS sum_gylym,
					SUM(engbekter.ball*0.90) AS sum_gylym1, 
					engbekter.file_ati, 
					engbekter.sani, 
					engbekter.univ_avtor_san, 
					engbekter.eskertu, 
					engbekter.ball, 
					tutors.TutorID, 
					tutors.lastname, 
					tutors.firstname, 
					tutors.patronymic, 
					tutors.lastnameRu, 
					tutors.firstnameRu, 
					tutors.patronymicRu, 
					faculties.facultyNameKZ, 
					faculties.facultyNameRU, 
					cafedras.cafedraNameKZ, 
					cafedras.cafedraNameRU, 
					korsetkishter.korsetkish_ati, 
					status.status_name, 
					kaytaru_sebebi.sebepter, 
					korsetkishter.typeID
					FROM engbekter
					INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
					INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
					INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
					INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
					INNER JOIN status ON status.statusID = engbekter.kod_stat
					INNER JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb = engbekter.kod_kayt_sebeb
					WHERE TutorID = '$_GET[ID]' AND korsetkishter.typeID = 1 and engbekter.del=0") or die(mysqli_error($connection));
					$engbek2 = mysqli_fetch_array($sql3);
					/*Sum oku*/
					$sql4 = mysqli_query($connection,"SELECT 
					engbekter.engbekID, 
					SUM(engbekter.ball*0.90)*0.35 AS sum_oku, 
					SUM(engbekter.ball*0.90) AS sum_oku1,
					engbekter.file_ati, 
					engbekter.sani, 
					engbekter.univ_avtor_san, 
					engbekter.eskertu, 
					engbekter.ball, 
					tutors.TutorID, 
					tutors.lastname, 
					tutors.firstname, 
					tutors.patronymic, 
					tutors.lastnameRu, 
					tutors.firstnameRu, 
					tutors.patronymicRu, 
					faculties.facultyNameKZ, 
					faculties.facultyNameRU, 
					cafedras.cafedraNameKZ, 
					cafedras.cafedraNameRU, 
					korsetkishter.korsetkish_ati, 
					status.status_name, 
					kaytaru_sebebi.sebepter,
					korsetkishter.typeID
					FROM engbekter
					INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
					INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
					INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
					INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
					INNER JOIN status ON status.statusID = engbekter.kod_stat
					INNER JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb = engbekter.kod_kayt_sebeb
					WHERE TutorID = '$_GET[ID]' AND korsetkishter.typeID = 2 and engbekter.del=0") or die(mysqli_error($connection));
					$engbek3 = mysqli_fetch_array($sql4);
                    /**Sum tarbie **/
					$sql5 = mysqli_query($connection,"SELECT 
					engbekter.engbekID, 
					SUM(engbekter.ball*0.90)*0.15 AS sum_tarbie,
					SUM(engbekter.ball*0.90) AS sum_tarbie1, 
					engbekter.file_ati, 
					engbekter.sani, 
					engbekter.univ_avtor_san, 
					engbekter.eskertu, 
					engbekter.ball, 
					tutors.TutorID, 
					tutors.lastname, 
					tutors.firstname, 
					tutors.patronymic,
					tutors.lastnameRu, 
					tutors.firstnameRu, 
					tutors.patronymicRu, 
					faculties.facultyNameKZ, 
					faculties.facultyNameRU, 
					cafedras.cafedraNameKZ,
					cafedras.cafedraNameRU, 
					korsetkishter.korsetkish_ati, 
					status.status_name, 
					kaytaru_sebebi.sebepter, 
					korsetkishter.typeID
					FROM engbekter
					INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
					INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
					INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
					INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
					INNER JOIN status ON status.statusID = engbekter.kod_stat
					INNER JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb = engbekter.kod_kayt_sebeb
					WHERE TutorID = '$_GET[ID]' AND korsetkishter.typeID = 3 and engbekter.del=0") or die(mysqli_error($connection));
					$engbek4 = mysqli_fetch_array($sql5);
					/*type4*/
					$sql6 = mysqli_query($connection,"SELECT 
					engbekter.engbekID, 
					SUM(engbekter.ball)*0.10 AS sum_juldyzdyk,
					SUM(engbekter.ball) AS sum_juldyzdyk1, 
					engbekter.file_ati, 
					engbekter.sani, 
					engbekter.eskertu, 
					engbekter.ball, 
					tutors.TutorID, 
					tutors.lastname, 
					tutors.firstname, 
					tutors.patronymic, 
					tutors.lastnameRu, 
					tutors.firstnameRu, 
					tutors.patronymicRu, 
					faculties.facultyNameKZ, 
					faculties.facultyNameRU, 
					cafedras.cafedraNameKZ, 
					cafedras.cafedraNameRU, 
					korsetkishter.korsetkish_ati, 
					status.status_name, 
					kaytaru_sebebi.sebepter, 
					korsetkishter.typeID
					FROM engbekter
					INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
					INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
					INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
					INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
					INNER JOIN status ON status.statusID = engbekter.kod_stat
					INNER JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb = engbekter.kod_kayt_sebeb
					WHERE TutorID = '$_GET[ID]' AND korsetkishter.typeID = 4 and engbekter.del=0") or die(mysqli_error($connection));
					$engbek5 = mysqli_fetch_array($sql6);
					$a = array($engbek4['sum_tarbie'],$engbek2['sum_gylym'],$engbek3['sum_oku'],$engbek5['sum_juldyzdyk']);
					$univ = array_sum($a);

            $sLastName = $engbek['lastname'];
            $sFirstName = $engbek['firstname'];
            $sPatronymic = $engbek['patronymic'];
            $sFacult = $engbek['facultyNameKZ'];
            $sCafedra = $engbek['cafedraNameKZ'];
            if ($_SESSION['lang'] != 'kaz'){
                $sLastName = isset($engbek['lastnameRu']) && mb_strlen($engbek['lastnameRu']) ? $engbek['lastnameRu'] : $engbek['lastname'];
                $sFirstName = isset($engbek['firstnameRu']) && mb_strlen($engbek['firstnameRu']) ? $engbek['firstnameRu'] : $engbek['firstname'];
                $sPatronymic = isset($engbek['patronymicRu']) && mb_strlen($engbek['patronymicRu']) ? $engbek['patronymicRu'] : $engbek['patronymic'];
                $sFacult = isset($engbek['facultyNameRU']) && mb_strlen($engbek['facultyNameRU']) ? $engbek['facultyNameRU'] : $engbek['facultyNameKZ'];
                $sCafedra = isset($engbek['cafedraNameRU']) && mb_strlen($engbek['cafedraNameRU']) ? $engbek['cafedraNameRU'] : $engbek['cafedraNameKZ'];
            }
			?>
			<h2 align = "center"><?= $oL::get('Оқытушы')?>: <?php echo " " . $sLastName . " ". $sFirstName . " ". $sPatronymic;?> <?= $oL::get('рейтингі жайлы жалпы мәлімет')?></h2>
			<div class = "engbek">
				<form action = "confirmation.php" method = "post">
					<table style = "font-size: 19px;">
						<tr>
							<td>
								<span>
									<strong><?= $oL::get('Факультет/ҒЗО')?>:</strong>
								</td>
								<td>
									<?php echo $sFacult; ?>
								</span>
							</td>
						</tr>
							<td>
								<span>
									<strong><?= $oL::get('Кафедра/ҒЗИ')?>:</strong>
							</td>
							<td>
									<?php echo $sCafedra; ?>
								</span>
							</td>
						</tr>
						<tr>
							<td><span><strong><?= $oL::get('Аты-жөні')?>:</strong></td><td><?php echo $sLastName . " " . $sFirstName . " " . $sPatronymic; ?></span> </td>
						</tr>						
						<tr>
							<td><hr/></td><td><hr /></td>
						</tr>
						<tr>                         
						<td>
                            <strong><?= $oL::get('Ғылым бағыты')?>:50%</strong>
                            </td>
                            	<td>
                                    <?php 
                                        $format='%.2f/%.2f';
                                            echo sprintf($format,$engbek2['sum_gylym1'],$engbek2['sum_gylym']); 
                                    ?>
                            </td>
						</tr>
						<tr>
							<td>
                                <strong><?= $oL::get('Академиялық бағыты')?>:35%</strong>
                                    </td>
                                    <td>
								<?php 
									$format='%.2f/%.2f';
									echo sprintf($format,$engbek3['sum_oku1'],$engbek3['sum_oku']); 
								?>
                            </td>
						</tr>
						<tr>
							<td>
							  <strong><?= $oL::get('Әлеуметтік-мәдени бағыты')?>:15%</strong>
							</td>
							<td>
							<?php 
							 $format='%.2f/%.2f';
							echo sprintf($format,$engbek4['sum_tarbie1'],$engbek4['sum_tarbie']); 
							?>
							</td>
						</tr>
						<tr>
							<td>
							  <strong><?= $oL::get('Жұлдыздық кретерийі')?>:15%</strong>
							</td>
							<td>
							<?php 
							 $format='%.2f/%.2f';
							echo sprintf($format,$engbek4['sum_juldyzdyk1'],$engbek4['sum_juldyzdyk']); 
							?>
							</td>
						</tr>
						<tr>
							<td><hr/></td><td><hr /></td>
						</tr>
						<tr>
							<td>
								<strong><?= $oL::get('Жалпы балл')?>:</strong>
							</td>
							<td>
								<?php echo sprintf("%.2f",$univ); ?>
							</td>
						</tr>
						<tr>
							<td><hr/></td><td><hr /></td>
						</tr>
					</table>
				</form>
			</div>
			<div class = "works">
					<?php
						$sql = "SELECT engbekter.ball,
						 engbekter.engbekID, 
						 tutors.firstname, 
						 tutors.lastname, 
						 tutors.patronymic, 
						 tutors.firstnameRu, 
						 tutors.lastnameRu, 
						 tutors.patronymicRu, 
						 korsetkishter.korsetkish_ati, 	
						 engbekter.sani, 
						 engbekter.univ_avtor_san, 
						 engbekter.file_ati, 
						 engbekter.kayt_sebeb, 
						 engbekter.eskertu, 
						 status.status_name, 
						 faculties.FacultyID, 
						 status.statusID, 
						 cafedras.cafedraNameKZ, 
						 cafedras.cafedraNameRU, 
						 faculties.facultyNameKZ, 
						 faculties.facultyNameRU, 
						 cafedras.CafedraID, 
						 tutors.roleID, 
						 tutors.TutorID
						FROM engbekter 
						INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
						INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
						INNER JOIN status ON status.statusID = engbekter.kod_stat 
						WHERE tutors.TutorID = '$_GET[ID]' and engbekter.del=0 ORDER BY engbekter.engbekID DESC";
						$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
						echo "<table>
						<tr>
							<th>№</th>
							<th>".$oL::get('Кафедра/ҒЗИ')."</th>
							<th>".$oL::get('Аты жөні')."</th>
							<th>".$oL::get('Көрсеткіш')."</th>
							<th>".$oL::get('Саны')."</th>
							<th>".$oL::get('Автор саны')."</th>
							<th>".$oL::get('Файл аты')."</th>
							<th>".$oL::get('Балл')."</th>
							<th>".$oL::get('Қайтару себебі')."</th>
							<th>".$oL::get('Статус')."</th>
						</tr>";
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
							echo "<tr>
							<td>".$i."</td>
							<td>".$sCafedra."</td>
							<td>".$sLastName." ".$sFirstName."</td>
							<td>".$row["korsetkish_ati"]."</td>
							<td>".$row["sani"]."</td>
							<td>".$row["univ_avtor_san"]."</td>
							<td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td>
							<td>".$row["ball"]."</td>
							<td>".$row["kayt_sebeb"]."</td>
							<td>".$oL::get($row["status_name"])."</td>
							</tr>";
							$i++;
						}
						echo "</table>";    	
					?>
			</div>
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>