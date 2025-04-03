<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
	<?php
		include('../incs/connect.php');
		
		session_start();
		$_SESSION['tutor'];
		$_SESSION['lang'];
		if(!isset($_SESSION['tutor'])){
			header('Location: ../login.php');
		}
	?>
	<title><?= $oL::get('Басты бет')?></title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<script type = "text/javascript" src = "../chartjs/js/chart.min.js"></script>
	<script type = "text/javascript" src = "../chartjs/js/jquery.min.js"></script>
	<script type = "text/javascript" src = "../chartjs/js/app.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<style>
		.content_wrapper{
			width: 1050px;
			margin: 0 auto;
		}
		.tutors_table{
			margin: 10px;
			width: 500px;
			float:left;
		}
		.univer_table{
			margin: 10px;
			width: 500px;
			float:left;
		}
		.faculty_table{
			margin: 10px;
			width: 500px;
			float:left;
		}
		.cafedra_table{
			margin: 10px;
			width: 500px;
			float:left;
		}
		table {
			border-collapse: collapse;
			border:1px black solid;
			width: 100%;
			font-size: 12px;
		}
		a{
			color: blue;
			text-decoration:none;
		}
		a:hover{
			color: red;
			text-decoration:underline;
		}

		th, td {
			text-align: left;
			padding: 6px;
			border:1px black solid;
		}

		tr:nth-child(even){background-color: #f2f2f2}

		th {
			background-color: #003366;
			color: white;
		}
		#chart_container{
			width: 900px;
			padding: 50px;
			height: 400px;
			margin: 0 auto;
			border: 2px #049eff solid;
		}
		#chart_container2{
    			float: right;
			width: 420px;
			padding: 50px;
			height: 400px;
			margin: 0 auto;
			border: 2px #049eff solid;
		}
	</style>
</head>
<body>
	<div class = "upper_header">
        <?php include '../extensions/header.php'?>
	</div><br />
	<div class = "header">	
	<div id = "menu_nav">
		<?php include '../extensions/nav.php'; ?>
	</div>
	</div>
	<div class = "content">
		<div class = "content_wrapper" style = "margin-top: 5px;">					
			<?php
				$_SESSION['tutor'];
				$query = mysqli_query($connection,"SELECT * FROM tutors WHERE mail = '$_SESSION[tutor]'") or die(mysqli_error($connection));
				$tut = mysqli_fetch_array($query);
				$sLastName = $tut['lastname'];
				$sFirstName = $tut['firstname'];
				$sPatronymic = $tut['patronymic'];
				if ($_SESSION['lang'] != 'kaz'){
                    $sLastName = isset($tut['lastnameTR']) && mb_strlen($tut['lastnameTR']) ? $tut['lastnameTR'] : $tut['lastname'];
                    $sFirstName = isset($tut['firstnameTR']) && mb_strlen($tut['firstnameTR']) ? $tut['firstnameTR'] : $tut['firstname'];
                    $sPatronymic = isset($tut['patronymicTR']) && mb_strlen($tut['patronymicTR']) ? $tut['patronymicTR'] : $tut['patronymic'];
                }

				echo "<h2 style = 'color:#0094aa'>".$oL::get('Оқытушы').": " . $sLastName ." ". $sFirstName ." ". $sPatronymic . "</h2>";
				?>
			<hr />	


			
            <div class = 'tutors_table'><h3 align = 'center' style = "color: #0094de"><?= $oL::get('Факультеттер')?></h3>
			<?php				
				$sql1 = mysqli_query($connection,"SELECT 
				korsetkishter.korsetkish_ati,
				korsetkishter.korsetkish_ati2,
				faculties.facultyNameKZ, 
				faculties.facultyNameTR, 
				SUM( engbekter.ball ) AS sum_val
				FROM engbekter
				INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
				LEFT JOIN faculties ON faculties.facultyID = engbekter.kod_fakul
				WHERE engbekter.kod_kizm <1
				AND engbekter.kod_kafedra <1
				AND engbekter.kod_fakul >0
				GROUP BY korsetkishter.korsetkish_ati, faculties.facultyNameKZ") or die(mysqli_error($connection));
			?>
			<table>
					<tr>
						<th>№</th>
						<th><?= $oL::get('Көрсеткіш')?></th>
						<th><?= $oL::get('Факультет')?></th>
						<th><?= $oL::get('Берілген балл')?></th>
					</tr>
			<?php
				$i = 1;
					while($fakballar = mysqli_fetch_array($sql1)){
                        $sFacult = $fakballar['facultyNameKZ'];
						$skor=$fakballar['korsetkish_ati'];
                        if ($_SESSION['lang'] != 'kaz'){
                            $sFacult = isset($fakballar['facultyNameTR']) && mb_strlen($fakballar['facultyNameTR']) ? $fakballar['facultyNameTR'] : $fakballar['facultyNameKZ'];
							$sFacult = isset($fakballar['korsetkish_ati2']) && mb_strlen($fakballar['korsetkish_ati2']) ? $fakballar['korsetkish_ati2'] : $fakballar['korsetkish_ati'];
                        }
						echo "
						<tr>
							<td>".$i++."</td><td>". $skor ."</td><td> ".$sFacult."</td><td>" . $fakballar['sum_val'] . "</td>
						</tr>";								
					}
			?>
					</table>
			</div>		
			<div class = 'tutors_table'>
				<h3 align = 'center' style = "color: #0094de"><?= $oL::get('Кафедралар')?></h3>
			<?php			
				
				$sql12 = mysqli_query($connection,"SELECT korsetkishter.korsetkish_ati,
				korsetkishter.korsetkish_ati2, 
				cafedras.cafedraNameKZ, 
				cafedras.cafedraNameTR,
				cafedras.cafedraNameTR,
				SUM( engbekter.ball ) AS sum_val
				FROM engbekter
				INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
				LEFT JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
				WHERE engbekter.kod_kizm <1
				AND engbekter.kod_kafedra >0
				AND engbekter.kod_fakul >0
				GROUP BY korsetkishter.korsetkish_ati, cafedras.cafedraNameKZ") or die(mysqli_error($connection));
			?>
				<table>
					<tr>
						<th>№</th>
						<th><?= $oL::get('Көрсеткіш')?></th>
						<th><?= $oL::get('Кафедра')?></th>
						<th><?= $oL::get('Берілген балл')?></th>
					</tr>
					<?php
						$i = 1;
							while($cafballar = mysqli_fetch_array($sql12)){
								$sCafedra = $cafballar['cafedraNameKZ'];
								$skor = $cafballar['cafedraNameKZ'];
								if ($_SESSION['lang'] != 'kaz'){
									$sCafedra = isset($cafballar['cafedraNameTR']) && mb_strlen($cafballar['cafedraNameTR']) ? $cafballar['cafedraNameTR'] : $cafballar['cafedraNameKZ'];
									$skor = isset($cafballar['korsetkish_ati2']) && mb_strlen($cafballar['korsetkish_ati2']) ? $cafballar['korsetkish_ati2'] : $cafballar['cafedraNameKZ'];
								}
								echo "
								<tr>
									<td>".$i++."</td><td>".$skor."</td><td> ".$sCafedra."</td><td>" . $cafballar['sum_val'] . "</td>
								</tr>";								
							}
					?>
				</table>
			</div>				
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>