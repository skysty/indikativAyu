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
				</ul>
			  </li>
			  
			  <li><a href="#">Орындау</a>
				<ul>
				  <li><a href="engbek_jukteu.php">ОПҚ/ҒҚ</a></li>
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


			
            <div class = 'tutors_table'><h3 align = 'center' style = "color: #0094de">Факультеттер</h3>
			<?php				
$sql1 = mysql_query("SELECT korsetkishter.korsetkish_ati, faculties.facultyNameKZ, SUM( engbekter.ball ) AS sum_val
FROM engbekter
INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
LEFT JOIN faculties ON faculties.facultyID = engbekter.kod_fakul
WHERE engbekter.kod_kizm <1
AND engbekter.kod_kafedra <1
AND engbekter.kod_fakul >0
GROUP BY korsetkishter.korsetkish_ati, faculties.facultyNameKZ") or die(mysql_error());
			?><table>
					<tr>
						<th>№</th><th>Көрсеткіш</th><th>Факультет</th><th>Берілген балл</th>
					</tr>
			<?php
				$i = 1;
					while($fakballar = mysql_fetch_array($sql1)){
						echo "
						<tr>
							<td>".$i++."</td><td>".$fakballar['korsetkish_ati']."</td><td> ".$fakballar['facultyNameKZ']."</td><td>" . $fakballar['sum_val'] . "</td>
						</tr>";								
					}
			?>
					</table>
			</div>		



			
			         <div class = 'tutors_table'><h3 align = 'center' style = "color: #0094de">Кафедралар</h3>
			<?php			
				
$sql12 = mysql_query("SELECT korsetkishter.korsetkish_ati, cafedras.cafedraNameKZ, SUM( engbekter.ball ) AS sum_val
FROM engbekter
INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
LEFT JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
WHERE engbekter.kod_kizm <1
AND engbekter.kod_kafedra >0
AND engbekter.kod_fakul >0
GROUP BY korsetkishter.korsetkish_ati, cafedras.cafedraNameKZ") or die(mysql_error());
			?><table>
					<tr>
						<th>№</th><th>Көрсеткіш</th><th>Кафедра</th><th>Берілген балл</th>
					</tr>
			<?php
				$i = 1;
					while($cafballar = mysql_fetch_array($sql12)){
						echo "
						<tr>
							<td>".$i++."</td><td>".$cafballar['korsetkish_ati']."</td><td> ".$cafballar['cafedraNameKZ']."</td><td>" . $cafballar['sum_val'] . "</td>
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