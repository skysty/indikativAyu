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
       
	<script type = "text/javascript" src = "../dataTables/jquery-3.5.1.js"></script>

	<link rel = "stylesheet" type = "text/css" href = "../dataTables/jquery.dataTables.min.css">
       
        <script type="text/javascript">
        /* <![CDATA[ */
        /* Locale for JS */
        <?php require_once '../locale/jslocale.php'; ?>
        /* ]]> */
    	</script>
	<script type = "text/javascript" src = "../dataTables/jquery.dataTables.min.js"></script> 

    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  

    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  

	<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

	<script type = "text/javascript" src = "../js/functions.js"></script>

	<script type = "text/javascript" src = "../chartjs/js/chart.min.js"></script>

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

				$Login=$_SESSION['tutor'];

				$query = mysqli_query($connection,"SELECT * FROM tutors WHERE Login = '$Login'") or die(mysqli_error());

				$tut = mysqli_fetch_array($query);
				$sLastName = $tut['lastname'];
				$sFirstName = $tut['firstname'];
				$sPatronymic = $tut['patronymic'];
				$roleID=$tut['roleID'];
				if ($_SESSION['lang'] != 'kaz'){
                    $sLastName = isset($tut['lastnameRu']) && mb_strlen($tut['lastnameRu']) ? $tut['lastnameRu'] : $tut['lastname'];
                    $sFirstName = isset($tut['firstnameRu']) && mb_strlen($tut['firstnameRu']) ? $tut['firstnameRu'] : $tut['firstname'];
                    $sPatronymic = isset($tut['patronymicRu']) && mb_strlen($tut['patronymicRu']) ? $tut['patronymicRu'] : $tut['patronymic'];
                }
                $roleName = '';
				if($_SESSION['roleID'] == 1){
					$roleName = $oL::get('Оқытушы');
				} else if($_SESSION['roleID'] == 2){
					$roleName = $oL::get('Администратор');
				} else if($_SESSION['roleID'] == 3){
					$roleName = $oL::get('Модератор');
				} else if($_SESSION['roleID'] == 4){
					$roleName = $oL::get('Кафедра меңгерушісі');
				} else if($_SESSION['roleID'] == 5){
					$roleName = $oL::get('Декан');
				} else if($_SESSION['roleID'] == 6){
					$roleName = $oL::get('Бас модератор');
				}

				echo "<h2 style = 'color:#0094aa'>".$roleName.": " . $sLastName ." ". $sFirstName ." ". $sPatronymic . "</h2>";
				?>

			<hr />		
			<h1 style = "text-align: center; color: red"><?= $oL::get('Ағымдағы рейтинг')?> 2023-2024</h1><hr />
			<h2 align = 'center' style = "color: #0094de"><?= $oL::get('Факультеттер рейтингі')?></h2>
			<div id = "chart_container">

				<canvas id = "mycanvas"></canvas>

			</div>	

			<div class = 'tutors_table'>
				<h3 align = 'center' style = "color: #0094de"><?= $oL::get('Оқытушы-профессорлар және ғылыми қызметкерлер рейтингі') ?></h3>
				<?php

					$sql1 = mysqli_query($connection, "SELECT T1.*, (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4+T1.typ5) AS sum_val

					FROM (SELECT

						  tutors.TutorID,
						  tutors.RATE, 
						  tutors.job_titleID,
						  tutors.lastname, 
						  tutors.lastnameRu, 
						  engbekter.kod_kizm,
						  tutors.firstname,
						  tutors.firstnameRu,

					  SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball * 0.90 ELSE 0 END) * 0.50 AS typ1,

					  SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball * 0.90 ELSE 0 END) * 0.35 AS typ2,

					  SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball * 0.90 ELSE 0 END) * 0.15 AS typ3,

					  SUM(CASE WHEN korsetkishter.typeID = 4 THEN engbekter.ball ELSE 0 END) * 0.10 AS typ5, 

					  SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END)  AS typ4

					FROM engbekter

					Left JOIN tutors ON tutors.TutorID = engbekter.kod_kizm

					LEFT JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset

					WHERE tutors.deleted=0 AND tutors.RATE IN(1,2,3)

					GROUP BY tutors.lastname, tutors.firstname) AS T1 ORDER by sum_val DESC") or die(mysqli_error($connection));

					

					$sql_tuts = mysqli_query($connection, "SELECT 
					 tutors.RATE,
					 tutors.job_titleID, 
					 tutors.lastname, 
					 tutors.lastnameRu, 
					 tutors.TutorID, 
					 engbekter.kod_kizm, 
					 tutors.firstname, 
					 tutors.firstnameRu, 
					 SUM(engbekter.ball) AS sum_val FROM engbekter 
					RIGHT JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
					WHERE tutors.deleted=0 AND tutors.RATE IN(1,2,3) AND engbekter.kod_kizm IS NULL
					GROUP BY tutors.lastname, tutors.firstname ORDER BY sum_val DESC") or die(mysqli_error($connection));

					?>

					<!--<button onclick="HtmlTOExcel('xlsx')"><?= $oL::get('Экспорт EXCEL')?></button>-->

					<table  id="univ_data" class="table table-striped table-bordered" border="1">

						<thead>

							<tr>

								<th>№</th>

								<th><?= $oL::get('Аты жөні')?></th>

								<th style="display: none;"><?= $oL::get('Ғылым бағыты')?></th>

								<th style="display: none;"><?= $oL::get('Академиялық бағыт')?></th>

								<th style="display: none;"><?= $oL::get('Әлеуметтік-мәдени бағыт')?></th>

								<th style="display: none;"><?= $oL::get('Қосылып алынған балл')?></th>
                                 
								<th><?= $oL::get('Жалпы балл')?></th>
								<th><?= $oL::get('Жұлдыздық')?></th>
								<th><?= $oL::get('Толық көру')?></th>
								

							</tr>

						<thead>

				<?php

					$i = 0;
					while($tutor = mysqli_fetch_array($sql1))
					{
                        $sLastName = $tutor['lastname'];
                        $sFirstName = $tutor['firstname'];
                        if ($_SESSION['lang'] != 'kaz'){
                            $sLastName = isset($tutor['lastnameRu']) && mb_strlen($tutor['lastnameRu']) ? $tutor['lastnameRu'] : $tutor['lastname'];
                            $sFirstName = isset($tutor['firstnameRu']) && mb_strlen($tutor['firstnameRu']) ? $tutor['firstnameRu'] : $tutor['firstname'];
                        }

						$i++;

						$sum_val = sprintf("%.2f", $tutor['sum_val']);

						echo "

						    <tbody>

							<tr>

								<td>".$i."</td>

								<td>".$sLastName." ".$sFirstName."</td>

								<td style='display: none;'>" .$tutor['typ1']."</td>

								<td style='display: none;'>" .$tutor['typ2']."</td>

								<td style='display: none;'>" .$tutor['typ3']."</td>

								<td style='display: none;'>" .$tutor['typ4']."</td>
								<td>" . $sum_val . "</td>
								<td>" .$tutor['typ5']."</td>
								<td><a href = \"tolyk.php?ID=" . $tutor['TutorID'] . "\">".$oL::get('Толық')." >></a></td>

							</tr>

							</tbody>";

					}

					

					while($tutor2 = mysqli_fetch_array($sql_tuts)){

                        $sLastName = $tutor2['lastname'];
                        $sFirstName = $tutor2['firstname'];
                        if ($_SESSION['lang'] != 'kaz'){
                            $sLastName = isset($tutor2['lastnameRu']) && mb_strlen($tutor2['lastnameRu']) ? $tutor2['lastnameRu'] : $tutor2['lastname'];
                            $sFirstName = isset($tutor2['firstnameRu']) && mb_strlen($tutor2['firstnameRu']) ? $tutor2['firstnameRu'] : $tutor2['firstname'];
                        }
						$i++;

						$sum_val = sprintf("%.2f", $tutor2['sum_val']);

						echo "<tr><td>".$i."</td><td>".$sLastName." ".$sFirstName."</td><td>" . $sum_val . "</td><td>" . 0.00 . "</td><td><a href = \"tolyk.php?ID=" . $tutor2['TutorID'] . "\">".$oL::get('Толық')." >></a></td></tr>";

					}

					   

						/*

						if($tutor['RATE'] == 0.5 || $tutor['RATE'] == 0.25 || $tutor['RATE'] == 0.75 || $tutor['job_titleID'] == 2 || $tutor['job_titleID'] == 3 || $tutor['job_titleID'] == 4 || $tutor['job_titleID'] == 5 || $tutor['job_titleID'] == 6 || $tutor['job_titleID'] == 7 || $tutor['job_titleID'] == 8){

							$sum_val = sprintf("%.2f", $tutor['sum_val']);

							echo "<tr><td>".'*'."</td><td>".$tutor['lastname']." ".$tutor['firstname']."</td><td>" . $sum_val . "</td><td><a href = \"tolyk.php?ID=" . $tutor['TutorID'] . "\">Толық >></a></td></tr>";							

						}	*/

			?>


					</table>

					

					</div>

					<div class = "univer_table">

						<?php

						//###########################################univer table display###############################################

							$sql3 = mysqli_query($connection, "SELECT 
							engbekter.kod_fakul, 
							SUM(engbekter.ball) AS sum_univer FROM engbekter 
							INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul") or die(mysqli_error($connection));		
							$univer = mysqli_fetch_array($sql3);
							$sql4 = mysqli_query($connection,"SELECT engbekter.kod_fakul, SUM(engbekter.ball*0.90)*0.50 AS sum_univer_gylym, korsetkishter.typeID FROM engbekter 
							INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset WHERE korsetkishter.typeID = 1") or die(mysqli_error($connection));
							$univer2 = mysqli_fetch_array($sql4);

							

							$sql5 = mysqli_query($connection, "SELECT 
							engbekter.kod_fakul, 
							SUM(engbekter.ball*0.90)*0.35 AS sum_univer_oku, 
							korsetkishter.typeID FROM engbekter 
							INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
							INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
							WHERE korsetkishter.typeID = 2") or die(mysqli_error($connection));

							$univer3 = mysqli_fetch_array($sql5);

							

							$sql6 = mysqli_query($connection, "SELECT 
							engbekter.kod_fakul, 
							SUM(engbekter.ball*0.90)*0.15 AS sum_univer_tarbie, 
							korsetkishter.typeID FROM engbekter 
							INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
							INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
							WHERE korsetkishter.typeID = 3") or die(mysqli_error($connection));

						
							$univer4 = mysqli_fetch_array($sql6);
                           
							//Star calculation 
							$sql8 = mysqli_query($connection, "SELECT 
							engbekter.kod_fakul, 
							SUM(engbekter.ball)*0.10 AS sum_univer_star, 
							korsetkishter.typeID FROM engbekter 
							INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
							INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
							WHERE korsetkishter.typeID = 4") or die(mysqli_error($connection));

						
							$univer6 = mysqli_fetch_array($sql8);
							//star calc end
							$sql7 = mysqli_query($connection, "SELECT 
							engbekter.kod_fakul, 
							SUM(engbekter.ball) AS sum_baska, 
							korsetkishter.typeID FROM engbekter 
							INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
							INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
							WHERE  korsetkishter.typeID = 5") or die(mysqli_error($connection));

							$univer5 = mysqli_fetch_array($sql7);

							$a = array($univer4['sum_univer_tarbie'],$univer2['sum_univer_gylym'],$univer3['sum_univer_oku'],$univer5['sum_baska'],$univer6['sum_univer_star']);

							$univ = array_sum($a);

						?>

						<h3 align = 'center' style = "color: #0094de"><?= $oL::get('Университет бойынша')?></h3>

						<table id ="univer_t" class="display" style="width:100%">

							<thead>

										<tr>
											<th><?= $oL::get('Штат саны') ?></th>
											<th><?= $oL::get('Ғылым') ?></th>
											<th><?= $oL::get('Академиялық') ?></th>
											<th><?= $oL::get('Әлеуметтік-мәдени') ?></th>
											<th><?= $oL::get('Жұлдыздық') ?></th>
											<th><?= $oL::get('Жалпы балл') ?></th>
											<th><?= $oL::get('Орта балл') ?></th>
										</tr>

							</thead>

							<tbody>

								<tr>

									<td>

										<div>

											<?php

												$result= mysqli_query($connection, "SELECT shtat_sani FROM jildar WHERE id_jildar= '1'");

												while($row = mysqli_fetch_array($result)){

														echo $row['shtat_sani'];

												}

											?>

										</div>

									</td>

									<td><?php echo sprintf("%.2f",$univer2['sum_univer_gylym']);?></td>

									<td><?php echo sprintf("%.2f",$univer3['sum_univer_oku']);?></td>

									<td><?php echo sprintf("%.2f",$univer4['sum_univer_tarbie']);?></td>
									<td><?php echo sprintf("%.2f",$univer4['sum_univer_star']);?></td>

									<td><?php echo sprintf("%.2f",$univ);?></td><td><?php $shtat_sani = 1045.75; $avg = ($univ)/$shtat_sani; echo sprintf("%.2f",$avg);?></td>

								</tr>

							</tbody>

						</table>

					</div>

					<div class = "faculty_table">

						<?php

							

							/*$f_sql = mysqli_query($connection,"SELECT faculties.facultyNameKZ, faculties.shtat_sany, SUM(engbekter.ball) AS sum_faculty, (SUM(engbekter.ball))/faculties.shtat_sany AS avg_faculty, faculties.FacultyID

							FROM engbekter

							RIGHT JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul

							where faculties.activ=1 

							GROUP BY faculties.facultyNameKZ

							ORDER BY avg_faculty DESC") or die(mysqli_error($connection));*/

							$f_sql = mysqli_query($connection,"SELECT T1.*, (T1.typ1 + T1.typ2 + T1.typ3+T1.typ4+T1.typ5) AS SumAllType, (T1.typ1 + T1.typ2 + T1.typ3+T1.typ4+T1.typ5)/T1.shtat_sany AS avg_faculty

							FROM (SELECT

							  faculties.FacultyID,

							  faculties.facultyNameKZ, 
							  faculties.facultyNameRU, 

							  faculties.shtat_sany,

							  SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball*0.90 ELSE 0 END) * 0.50 AS typ1,

							  SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball*0.90  ELSE 0 END) * 0.35 AS typ2,

							  SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball*0.90  ELSE 0 END) * 0.15 AS typ3,

							  SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END) AS typ4,
                              SUM(CASE WHEN korsetkishter.typeID = 4 THEN engbekter.ball  ELSE 0 END) * 0.10 AS typ5
							FROM engbekter

							RIGHT JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul

							left JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 

							WHERE faculties.activ = 1

							GROUP BY faculties.facultyNameKZ) AS T1 ORDER by avg_faculty DESC") or die(mysqli_error($connection));

						?>

						<h3 align = 'center' style = "color: #0094de"><?= $oL::get('Факультеттер')?></h3>

						<table >

							<tr>

								<th>№</th>
								<th><?= $oL::get('Факультет атауы')?></th>
								<th><?= $oL::get('Штат саны')?></th>
								<th><?= $oL::get('Жалпы балл')?></th>
								<th><?= $oL::get('Орта балл')?></th>
								<th><?= $oL::get('Толық көру')?></th>
							</tr>

							<?php

								$i = 1;

								while($faculty = mysqli_fetch_array($f_sql)){
								    $sFacultyName = $faculty['facultyNameKZ'];
                                    if ($_SESSION['lang'] != 'kaz'){
                                        $sFacultyName = isset($faculty['facultyNameRU']) && mb_strlen($faculty['facultyNameRU']) ? $faculty['facultyNameRU'] : $faculty['facultyNameKZ'];
                                    }

									echo "<tr><td>".$i."</td><td>".$sFacultyName."</td><td>".$faculty['shtat_sany']."</td><td>". sprintf("%.2f",$faculty['SumAllType'])."</td><td>". sprintf("%.2f",$faculty['avg_faculty'])."</td><td><a href = \"tolyk_faculty.php?ID=" . $faculty['FacultyID'] . "\">". $oL::get('Толық')." >></a></td></tr>";
									$i++;

								}

							?>

						</table>							

					</div>

						<div class = "cafedra_table">

						<?php

							$c_sql = mysqli_query($connection,"SELECT T1.*,  (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4+T1.typ5) AS sum_cafedra, (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4+T1.typ5)/T1.shtat_sany AS avg_cafedra

							FROM (SELECT

							  cafedras.cafedraID,

							  cafedras.cafedraNameKZ, 
							  cafedras.cafedraNameRU, 

							  cafedras.shtat_sany,

							  SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball*0.90  ELSE 0 END) * 0.50 AS typ1,

							  SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball*0.90  ELSE 0 END) * 0.35 AS typ2,

							  SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball*0.90  ELSE 0 END) * 0.15 AS typ3,
                              SUM(CASE WHEN korsetkishter.typeID = 4 THEN engbekter.ball  ELSE 0 END) * 0.10 AS typ5,
							  SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END)  AS typ4

							FROM engbekter

							RIGHT JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra

							LEFT JOIN faculties ON faculties.FacultyID = cafedras.FacultyID

							left JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 

							WHERE faculties.activ = 1

							GROUP BY cafedras.cafedraNameKZ) AS T1 ORDER by avg_cafedra DESC") or die(mysqli_error($connection));

						?>

						<h3 align = 'center' style = "color: #0094de"><?= $oL::get('Кафедралар')?></h3>

						<table>

							<thead>

								<tr>

									<th>№</th>
									<th><?= $oL::get('Кафедра атауы')?></th>
									<th><?= $oL::get('Штат саны')?></th>
									<th><?= $oL::get('Жалпы балл')?></th>
									<th><?= $oL::get('Орта балл')?></th>
									<th><?= $oL::get('Толық көру')?></th>
								</tr>

							</thead>

							<?php

								$i = 1;

								while($cafedra = mysqli_fetch_array($c_sql)){
                                    $sTitle = $cafedra['cafedraNameKZ'];
                                    if ($_SESSION['lang'] != 'kaz'){
                                        $sTitle = isset($cafedra['cafedraNameRU']) && mb_strlen($cafedra['cafedraNameRU']) ? $cafedra['cafedraNameRU'] : $cafedra['cafedraNameKZ'];
                                    }
									echo "

									<tr>

									<td>".$i."</td>
									<td>".$sTitle."</td>
									<td>".$cafedra['shtat_sany']."</td>

									<td>". sprintf("%.2f",$cafedra['sum_cafedra'])."</td>

									<td>". sprintf("%.2f",$cafedra['avg_cafedra'])."</td>
									<td><a href = \"tolyk_cafedra.php?ID=" . $cafedra['cafedraID'] . "\">". $oL::get('Толық')." >></a></td
									></tr>";

									$i++;

								}

							?>

						</table>

					</div>

					

					<div class = "cafedra_table">

						<?php

							$c_sql = mysqli_query($connection,"SELECT T1.*,  (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4) AS sum_cafedra, (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4)/T1.shtat_sany AS avg_cafedra

							FROM (SELECT

							  cafedras.cafedraID,

							  cafedras.cafedraNameKZ, 
							  cafedras.cafedraNameRU, 
							  cafedras.shtat_sany,

							  SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball*0.90  ELSE 0 END) * 0.50 AS typ1,

							  SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball*0.90  ELSE 0 END) * 0.35 AS typ2,

							  SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball*0.90  ELSE 0 END) * 0.15 AS typ3,

							  SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball*0.90  ELSE 0 END)  AS typ4

							FROM engbekter

							RIGHT JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra

							LEFT JOIN faculties ON faculties.FacultyID = cafedras.FacultyID

							left JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 

							WHERE faculties.activ = 0

							GROUP BY cafedras.cafedraNameKZ) AS T1 ORDER by avg_cafedra DESC") or die(mysqli_error($connection));

						?>
						<h3 align = 'center' style = "color: #0094de"><?= $oL::get('Ғылыми зерттеу институттары')?></h3>


<table>
	        <tr>
		<th>№</th>
		<th><?= $oL::get('Орталық атауы')?></th>
				    <th><?= $oL::get('Штат саны')?></th>
				    <th><?= $oL::get('Жалпы балл')?></th>
				    <th><?= $oL::get('Орта балл')?></th>
				    <th><?= $oL::get('Толық көру')?></th>
	        </tr>
	        <?php if($_SESSION['lang'] == 'rus'){ echo '
	        <tr>
		<td>1</td>
		<td>НИИ производства строительных материалов</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>2</td>
		<td>НИИ пищевых продуктов</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>3</td>
		<td>НИЛ инженерного профиля «Наноинженерные методы исследований» им. А.С. Ахметова</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>4</td>
		<td>НИЦ Экологические проблемы устойчивого развития</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>5</td>
		<td>НИЦ «Дулатоведение и история региона»</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>6</td>
		<td>НИЦ «Бауыржантану»</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>7</td>
		<td>НИЦ Сенімділік</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>8</td>
		<td>НИЦ Регионоведение</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>9</td>
		<td>НЦ физико-химических исследований</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>10</td>
		<td>НЦ Талас-Шуский фольклор и народная литература</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>11</td>
		<td>НПЦ «Тұлпар»</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>12</td>
		<td>НПЦ Алгорифм</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>13</td>
		<td>НПЦ «Креатив»</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>
	        <tr>
		<td>14</td>
		<td>УНПЦ «Фитохимия»</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
		<td></td>
	        </tr>';}
	        else {
	            echo '<tr>
	<td>1</td>
	<td>ҚҰРЫЛЫС МАТЕРИАЛДАРЫ ҒЫЛЫМИ-ЗЕРТТЕУ ИНСТИТУТЫ</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>2</td>
	<td>АЗЫҚ-ТҮЛІК ӨНІМДЕРІН ӨНДІРУ ҒЫЛЫМИ-ЗЕРТТЕУ ИНСТИТУТЫ</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>3</td>
	<td>Ә.С. Ахметов атындағы наноинженерлік зерттеу әдістері инженерлік бейінді ғылыми-зерттеу зертханасы</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>4</td>
	<td>«ТҰРАҚТЫ ДАМУДЫҢ ЭКОЛОГИЯЛЫҚ МӘСЕЛЕЛЕРІ» ҒЫЛЫМИ-ЗЕРТТЕУ ОРТАЛЫҒЫ</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>5</td>
	<td>«ДУЛАТИТАНУ ЖӘНЕ ӨҢІР ТАРИХЫ» ҒЫЛЫМИ-ЗЕРТТЕУ ОРТАЛЫҒЫ</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>6</td>
	<td>«Бауыржантану» ҒЫЛЫМИ-ЗЕРТТЕУ ОРТАЛЫҒЫ</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>7</td>
	<td>ҒЫЛЫМИ-ЗЕРТТЕУ ОРТАЛЫҒЫ «СЕНІМДІЛІК»</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>8</td>
	<td>«ӨҢІРТАНУ» ҒЫЛЫМИ-ЗЕРТТЕУ ОРТАЛЫҒЫ</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>9</td>
	<td>ФИЗИКА-ХИМИЯЛЫҚ ЗЕРТТЕУЛЕР ОРТАЛЫҒЫ</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>10</td>
	<td>«ТАЛАС-ШУ ФОЛЬКЛОРЫ ЖӘНЕ ХАЛЫҚ ӘДЕБИЕТІ» ҒЫЛЫМИ ОРТАЛЫҒЫ</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>11</td>
	<td>ҒЫЛЫМИ-ӨНДІРІСТІК ОРТАЛЫҚ «ТҰЛПАР»</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>12</td>
	<td>«АЛГОРИФМ» ҒЫЛЫМИ-ӨНДІРІСТІК ОРТАЛЫҒЫ</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>13</td>
	<td>«КРЕАТИВ» ҒЫЛЫМИ-ӨНДІРІСТІК ОРТАЛЫҒЫ</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>
            <tr>
	<td>14</td>
	<td>«ФИТОХИМИЯ» ҒЫЛЫМИ ОҚУ-ӨНДІРІСТІК ОРТАЛЫҒЫ</td>
		<td>0</td>
		<td>0.00</td>
		<td>0.00</td>
            </tr>'; }?>


							
<!--
							<tr>

								<th>№</th>
								<th><?= $oL::get('Орталық атауы')?></th>
								<th><?= $oL::get('Штат саны')?></th>
								<th><?= $oL::get('Жалпы балл')?></th>
								<th><?= $oL::get('Орта балл')?></th>
								<th><?= $oL::get('Толық көру')?></th>
							</tr>

							<?php

								$i = 1;

								while($cafedra = mysqli_fetch_array($c_sql)){
                                    $sTitle = $cafedra['cafedraNameKZ'];
                                    if ($_SESSION['lang'] != 'kaz'){
                                        $sTitle = isset($cafedra['cafedraNameRU']) && mb_strlen($cafedra['cafedraNameRU']) ? $cafedra['cafedraNameRU'] : $cafedra['cafedraNameKZ'];
                                    }
									echo "<tr>

									<td>".$i."</td>
									<td>".$sTitle."</td>
									<td>".$cafedra['shtat_sany']."</td>

									<td>". sprintf("%.2f",$cafedra['sum_cafedra'])."</td>

									<td>". sprintf("%.2f",$cafedra['avg_cafedra'])."</td>
									<td><a href = \"tolyk_cafedra.php?ID=" . $cafedra['cafedraID'] . "\">". $oL::get('Толық').">></a></td></tr>";
									$i++;

								}

							?>
-->
						</table>

					</div>		

				</div>

	</div>

	<div class = "footer">

	</div>

	<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

	

<script>

	function HtmlTOExcel(type, fun, dl) {

    var elt = document.getElementById('univ_data');

    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });

    return dl ?

        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :

        XLSX.writeFile(wb, fun || ('tutor-recored.' + (type || 'xlsx')));

}

</script>

</body>

</html>