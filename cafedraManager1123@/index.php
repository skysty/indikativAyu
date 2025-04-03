<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
	<?php
		include('../incs/connect.php');
		
		session_start();
		$_SESSION['tutor'];		
		
		if(!isset($_SESSION['tutor'])){
			header('Location: ../login.php');
		}
	?>
	<title>Басты бет</title>
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
		<img src = "../img/login_logo.png" style = "width: 175px; float:left;">
		<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;">АХМЕТ ЯСАУИ УНИВЕРСИТЕТІ</p>
		<p style = "font-size: 24px; text-align: center; color: #db261b; font-weight: bold;">ІШКІ КӘСІБИ РЕЙТИНГІ</p>
	</div><br />
	<div class = "header">	
	<div id = "menu_nav">
		<nav id="primary_nav_wrap">
			<ul>
			 <li><a href="#">Негізгі</a>
				<ul>
				  <li><a href="index.php">Негізгі бет</a></li>
                      <li><a href="manu.php">Қосылған балл</a></li>				  
				  <li><a href="korsetkishter.php">Көрсеткіштер</a></li>
				  <li><a href="#">Құжаттар</a>
				        <ul>                        
			
                        <li><a target = "_blank" href = "../files/Ereje_2018_2019.PDF">Ереже 2018-2019</a></li>
			<li><a target = "_blank" href = "../files/Ereje_2019_2020.pdf">Ереже 2019-2020</a></li>    
			<li><a target = "_blank" href = "../files/hattama_N1_11.06.2019.pdf">Хаттама №1 12.06.2019</a></li> 
                        <li><a target = "_blank" href = "../files/Rastaushi_gilimi.pdf">Растаушылар Ғылыми бағыт</a></li>                                                                 
			<li><a target = "_blank" href = "../files/Rastaushi_akademya.pdf">Растаушылар Академиялық бағыт</a></li>                                                                 
			<li><a target = "_blank" href = "../files/Rastaushi_tarbie.pdf">Растаушылар Басқа бағыттар</a></li>               
                        </ul>
				  </li>
				   <li><a href="#">Архив</a>
				        <ul>
				       <li><a href="http://ip1.ayu.edu.kz">2017-2018 оқу жылы</a></li>
				       <li><a href="http://ip2.ayu.edu.kz">2018-2019 оқу жылы</a></li>
				   </ul>
			           </li>
                    <li><a href="change_password.php">Құпия сөзді ауыстыру</a></li>
				</ul>
			  </li>
			  
			  <li><a href="#">Орындау</a>
				<ul>
				  <li><a href="engbek_jukteu.php">ОПҚ/ҒҚ</a></li>
				  <li><a href="engbek_jukteu_cafedra.php">Каф./ҒЗИ орт. ендіру</a></li>
				</ul>
			  </li>
			  <li><a href="#">Басқа</a>
				<ul>
				  <li><a href="baska_okitushyny_koru.php">ОПҚ/ҒҚ</a></li>
				</ul>
			  </li>			  
			  <li><a href="#">Сенім жәшігі</a>
				<ul>
				  <li><a href="shagym_tusiru.php">Шағым түсіру</a></li>
				  <li><a href="shagymdar.php">Шағымдарды көру</a></li>
				</ul>
			  </li>
			  <li><a href="../logout.php">Шығу</a></li>
			</ul>
		</nav>
	</div>
	</div>
	<div class = "content">
		<div class = "content_wrapper" style = "margin-top: 5px;">					
			<?php
			/*	
				if(isset($_SESSION['tutor'])){
				
				} else {
				
					header('Location: ../login.php');
				}
			*/
				$_SESSION['tutor'];
				$query = mysql_query("SELECT * FROM tutors WHERE Login = '$_SESSION[tutor]'") or die(mysql_error());
				$tut = mysql_fetch_array($query);
				
				echo "<h2 style = 'color:#0094aa'>Оқытушы: " . $tut['lastname'] ." ". $tut['firstname'] ." ". $tut['patronymic'] . "</h2>";
				?>
			<hr />		
			<h1 style = "text-align: center; color: red">Ағымдағы рейтинг 2019-2020</h1><hr />
			<h2 align = 'center' style = "color: #0094de">Факультеттер рейтингі</h2>
			<div id = "chart_container">
				<canvas id = "mycanvas"></canvas>
			</div>	
			
			<div class = 'tutors_table'><h3 align = 'center' style = "color: #0094de">Оқытушы-профессорлар және ғылыми қызметкерлер рейтингі</h3>
				<?php
					$sql1 = mysql_query("SELECT tutors.RATE, tutors.job_titleID, tutors.lastname, tutors.TutorID, engbekter.kod_kizm, tutors.firstname, SUM(engbekter.ball) AS sum_val FROM engbekter 
					RIGHT JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
					INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
					WHERE tutors.deleted=0 AND tutors.RATE IN(1.0,0.5,0.25,0.75) AND korsetkishter.bolimderID = 1
					GROUP BY tutors.lastname, tutors.firstname ORDER BY sum_val DESC") or die(mysql_error());
					
					$sql_tuts = mysql_query("SELECT tutors.RATE, tutors.job_titleID, tutors.lastname, tutors.TutorID, engbekter.kod_kizm, tutors.firstname, SUM(engbekter.ball) AS sum_val FROM engbekter 
					RIGHT JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
					WHERE tutors.deleted=0 AND tutors.RATE IN(1.0,0.5,0.25,0.75) AND engbekter.kod_kizm IS NULL
					GROUP BY tutors.lastname, tutors.firstname ORDER BY sum_val DESC") or die(mysql_error());
					?><table>
						<tr>
							<th>№</th><th>Аты жөні</th><th>Жалпы балл</th><th>Толық көру</th>
						</tr>
				<?php

					$i = 0;
					
					while($tutor = mysql_fetch_array($sql1)){
						$i++;
						$sum_val = sprintf("%.2f", $tutor['sum_val']);
						echo "<tr><td>".$i."</td><td>".$tutor['lastname']." ".$tutor['firstname']."</td><td>" . $sum_val . "</td><td><a href = \"tolyk.php?ID=" . $tutor['TutorID'] . "\">Толық >></a></td></tr>";
					}
					
					while($tutor2 = mysql_fetch_array($sql_tuts)){
						$i++;
						$sum_val = sprintf("%.2f", $tutor2['sum_val']);
						echo "<tr><td>".$i."</td><td>".$tutor2['lastname']." ".$tutor2['firstname']."</td><td>" . $sum_val . "</td><td><a href = \"tolyk.php?ID=" . $tutor2['TutorID'] . "\">Толық >></a></td></tr>";
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
							$sql3 = mysql_query("SELECT engbekter.kod_fakul, SUM(engbekter.ball) AS sum_univer FROM engbekter INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul") or die(mysql_error());
							
							$univer = mysql_fetch_array($sql3);
							
							$sql4 = mysql_query("SELECT engbekter.kod_fakul, SUM(engbekter.ball) AS sum_univer_gylym, korsetkishter.typeID FROM engbekter INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset WHERE korsetkishter.typeID = 1") or die(mysql_error());
							
							$univer2 = mysql_fetch_array($sql4);
							
							$sql5 = mysql_query("SELECT engbekter.kod_fakul, SUM(engbekter.ball) AS sum_univer_oku, korsetkishter.typeID FROM engbekter INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset WHERE korsetkishter.typeID = 2") or die(mysql_error());
							
							$univer3 = mysql_fetch_array($sql5);
							
							$sql6 = mysql_query("SELECT engbekter.kod_fakul, SUM(engbekter.ball) AS sum_univer_tarbie, korsetkishter.typeID FROM engbekter INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset WHERE korsetkishter.typeID = 3") or die(mysql_error());
							
							$univer4 = mysql_fetch_array($sql6);
						?>
						<h3 align = 'center' style = "color: #0094de">Университет бойынша</h3>
						<table>
							<tr>
								<th>Штат саны</th><th>Ғылым</th><th>Оқу</th><th>Тәрбие</th><th>Жалпы балл</th><th>Орта балл</th>
							</tr>
							<tr>
								<td><div><?php
$result= mysql_query("SELECT shtat_sani FROM jildar WHERE id_jildar= '1'");
while($row = mysql_fetch_array($result)){
echo $row['shtat_sani'];
 }
?></div></td>
<td><?php echo sprintf("%.2f",$univer2['sum_univer_gylym']);?></td><td><?php echo sprintf("%.2f",$univer3['sum_univer_oku']);?></td><td><?php echo sprintf("%.2f",$univer4['sum_univer_tarbie']);?></td><td><?php echo sprintf("%.2f",$univer['sum_univer']);?></td><td><?php $shtat_sani = 838; $avg = ($univer['sum_univer'])/$shtat_sani; echo sprintf("%.2f",$avg);?></td>
							</tr>
						</table>
					</div>
					<div class = "faculty_table">
						<?php
							$f_sql = mysql_query("SELECT faculties.facultyNameKZ, faculties.shtat_sany, SUM(engbekter.ball) AS sum_faculty, (SUM(engbekter.ball))/faculties.shtat_sany AS avg_faculty, faculties.FacultyID
							FROM engbekter
							RIGHT JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
							where faculties.activ=1
							GROUP BY faculties.facultyNameKZ
							ORDER BY avg_faculty DESC") or die(mysql_error());						
						?>
						<h3 align = 'center' style = "color: #0094de">Факультеттер</h3>
						<table>
							<tr>
								<th>№</th><th>Факультет атауы</th><th>Штат саны</th><th>Жалпы балл</th><th>Орта балл</th><th>Толық көру</th>
							</tr>
							<?php
								$i = 1;
								while($faculty = mysql_fetch_array($f_sql)){
									echo "<tr><td>".$i."</td><td>".$faculty['facultyNameKZ']."</td><td>".$faculty['shtat_sany']."</td><td>". sprintf("%.2f",$faculty['sum_faculty'])."</td><td>". sprintf("%.2f",$faculty['avg_faculty'])."</td><td><a href = \"tolyk_faculty.php?ID=" . $faculty['FacultyID'] . "\">Толық >></a></td></tr>";
									$i++;
								}
							?>
						</table>							
					</div>
						<div class = "cafedra_table">
						<?php
							$c_sql = mysql_query("SELECT cafedras.cafedraNameKZ, cafedras.cafedraID, cafedras.shtat_sany, SUM(engbekter.ball) AS sum_cafedra, (SUM(engbekter.ball))/cafedras.shtat_sany AS avg_cafedra FROM engbekter RIGHT JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
                            LEFT JOIN faculties ON faculties.FacultyID = cafedras.FacultyID where faculties.activ=1 GROUP BY cafedras.cafedraNameKZ ORDER BY avg_cafedra DESC") or die(mysql_error());
						?>
						<h3 align = 'center' style = "color: #0094de">Кафедралар</h3>
						<table>
							<tr>
								<th>№</th><th>Кафедра атауы</th><th>Штат саны</th><th>Жалпы балл</th><th>Орта балл</th><th>Толық көру</th>
							</tr>
							<?php
								$i = 1;
								while($cafedra = mysql_fetch_array($c_sql)){
									echo "<tr><td>".$i."</td><td>".$cafedra['cafedraNameKZ']."</td><td>".$cafedra['shtat_sany']."</td><td>". sprintf("%.2f",$cafedra['sum_cafedra'])."</td><td>". sprintf("%.2f",$cafedra['avg_cafedra'])."</td><td><a href = \"tolyk_cafedra.php?ID=" . $cafedra['cafedraID'] . "\">Толық >></a></td></tr>";
									$i++;
								}
							?>
						</table>
					</div>
					
					<div class = "cafedra_table">
						<?php
							$c_sql = mysql_query("SELECT cafedras.cafedraNameKZ, cafedras.cafedraID, cafedras.shtat_sany, SUM(engbekter.ball) AS sum_cafedra, (SUM(engbekter.ball))/cafedras.shtat_sany AS avg_cafedra FROM engbekter RIGHT JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
                            LEFT JOIN faculties ON faculties.FacultyID = cafedras.FacultyID where faculties.activ=0 GROUP BY cafedras.cafedraNameKZ ORDER BY avg_cafedra DESC") or die(mysql_error());
						?>
						<h3 align = 'center' style = "color: #0094de">Ғылыми зерттеу институттары</h3>
						<table>
							<tr>
								<th>№</th><th>Орталық атауы</th><th>Штат саны</th><th>Жалпы балл</th><th>Орта балл</th><th>Толық көру</th>
							</tr>
							<?php
								$i = 1;
								while($cafedra = mysql_fetch_array($c_sql)){
									echo "<tr><td>".$i."</td><td>".$cafedra['cafedraNameKZ']."</td><td>".$cafedra['shtat_sany']."</td><td>". sprintf("%.2f",$cafedra['sum_cafedra'])."</td><td>". sprintf("%.2f",$cafedra['avg_cafedra'])."</td><td><a href = \"tolyk_cafedra.php?ID=" . $cafedra['cafedraID'] . "\">Толық >></a></td></tr>";
									$i++;
								}
							?>
						</table>
					</div>		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>