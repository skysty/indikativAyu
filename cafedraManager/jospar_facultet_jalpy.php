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
	<title>Еңбекті жүктеу</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<style>
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
	</style>
</head>
<body>
	<div class = "upper_header">
		<img src = "../img/login_logo.png" style = "width: 200px; float:left;">
		<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;">АХМЕТ ЯСАУИ УНИВЕРСИТЕТІ</p>
		<p style = "font-size: 24px; text-align: center; color: red;font-weight: bold;">ІШКІ КӘСІБИ РЕЙТИНГІ</p>
		<div style = "font-size: 18px; text-align: center; color: #0094de;font-weight: bold;">		
<?php
$result= mysqli_query($connection,"SELECT text_jildar FROM jildar WHERE id_jildar= '1'");
while($row = mysqli_fetch_array($result)){
echo $row['text_jildar'];
 }
?>
</div></br>	</div>	
	<div class = "header">
	<div id = "menu_nav">
		<nav id="primary_nav_wrap">
			<ul>
			  <li><a href="index.php">Негізгі</a>
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
				  <li><a href="#">Шағым түсіру</a></li>
				  <li><a href="#">Шағымдарды көру</a></li>
				</ul>
			  </li>
			  <li><a href="../logout.php">Шығу</a></li>
			</ul>
		</nav>
	</div>
	</div>
	<div class = "content">
		<div class = "content_wrapper" style = "margin-top: 5px;">
			<div class = "inner_conten" style = "width: 1000px; margin: 0 auto;">
				<h2 style = "text-align: center;">Факультет жоспары</h2>
				<div class = "engbek">
					<?php
			
						$_SESSION['tutor'];
						$sql = mysqli_query($connection,"SELECT * FROM tutors WHERE Login = '$_SESSION[tutor]'") or die(mysqli_error($connection));
						$result = mysqli_fetch_array($sql);
						
						$sql2 = mysqli_query($connection,"SELECT engbekter.engbekID, SUM(engbekter.ball) AS sum_val, (SUM(engbekter.ball))/faculties.shtat_sany AS avg_faculty, engbekter.file_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.eskertu, engbekter.ball, faculties.facultyNameKZ, faculties.FacultyID, faculties.facultyDean, tutors.lastname, tutors.TutorID, tutors.firstname, tutors.patronymic
						FROM faculties
						INNER JOIN engbekter ON engbekter.kod_fakul = faculties.FacultyID
						INNER JOIN tutors ON tutors.TutorID = faculties.facultyDean
						WHERE tutors.Login = '$_SESSION[tutor]'") or die(mysqli_error($connection));
						
						$faculty = mysqli_fetch_array($sql2);
						
						echo $_SESSION['tutor'];
					?>
						<table style = "font-size: 19px; width: 600px; margin: 0 auto;">
							<tr>
								<td><span><strong>Факультет атауы:</strong></td><td><?php echo $faculty['facultyNameKZ']; ?></span></td>
							</tr>
							<tr>
								<td><span><strong>Деканы:</strong></td><td><?php echo $faculty['lastname'] . " " . $faculty['firstname'] . " " . $faculty['patronymic']; ?></span></td>
							</tr>						
							<tr>
								<td><hr/></td><td><hr /></td>
							</tr>
							<tr>
								<td><strong>Ғылым:</strong></td><td><?php echo sprintf("%.2f",$faculty2['sum_gylym']); ?></td>
							</tr>
							<tr>
								<td><strong>Оқу-әдістемелік:</strong></td><td><?php echo sprintf("%.2f",$faculty3['sum_oku']); ?></td>
							</tr>
							<tr>
								<td><strong>Тәрбие:</strong></td><td><?php echo sprintf("%.2f",$faculty4['sum_tarbie']); ?></td>
							</tr>
							<tr>
								<td><hr/></td><td><hr /></td>
							</tr>
							<tr>
								<td><strong>Орта балл:</strong></td><td><?php echo sprintf("%.2f",$faculty['avg_faculty']); ?></td>
							</tr>
							<tr>
								<td><strong>Жалпы балл:</strong></td><td><?php echo sprintf("%.2f",$faculty['sum_val']); ?></td>
							</tr>
							<tr>
								<td><hr/></td><td><hr /></td>
							</tr>
						</table>
				</div>
				<div class = "works">
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
						
					/*					
						$sql2 = mysql_query("SELECT engbekter.engbekID, SUM(engbekter.ball) AS sum_val, (SUM(engbekter.ball))/faculties.shtat_sany AS avg_faculty, engbekter.file_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.eskertu, engbekter.ball, faculties.facultyNameKZ, faculties.FacultyID, faculties.facultyDean, tutors.lastname, tutors.TutorID, tutors.firstname, tutors.patronymic
						FROM faculties
						INNER JOIN engbekter ON engbekter.kod_fakul = faculties.FacultyID
						INNER JOIN tutors ON tutors.TutorID = faculties.facultyDean
						WHERE engbekter.kod_kizm = '$_SESSION[tutor]'") or die(mysql_error());
						
						$faculty = mysql_fetch_array($sql2);
						
						$sql3 = mysql_query("SELECT engbekter.engbekID, SUM(engbekter.ball) AS sum_gylym, engbekter.file_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.eskertu, engbekter.ball, faculties.facultyNameKZ, cafedras.cafedraNameKZ, korsetkishter.korsetkish_ati, faculties.FacultyID, korsetkishter.typeID
						FROM engbekter
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
						INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
						WHERE kod_fakul = '$_GET[ID]' AND korsetkishter.typeID = 1") or die(mysql_error());
						
						$faculty2 = mysql_fetch_array($sql3);
						
						$sql4 = mysql_query("SELECT engbekter.engbekID, SUM(engbekter.ball) AS sum_oku, engbekter.file_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.eskertu, engbekter.ball, faculties.facultyNameKZ, cafedras.cafedraNameKZ, korsetkishter.korsetkish_ati, faculties.FacultyID, korsetkishter.typeID
						FROM engbekter
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
						INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
						WHERE kod_fakul = '$_GET[ID]' AND korsetkishter.typeID = 2") or die(mysql_error());
						
						$faculty3 = mysql_fetch_array($sql4);
						
						$sql5 = mysql_query("SELECT engbekter.engbekID, SUM(engbekter.ball) AS sum_tarbie, engbekter.file_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.eskertu, engbekter.ball, faculties.facultyNameKZ, cafedras.cafedraNameKZ, korsetkishter.korsetkish_ati, faculties.FacultyID, korsetkishter.typeID
						FROM engbekter
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
						INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
						WHERE kod_fakul = '$_GET[ID]' AND korsetkishter.typeID = 3") or die(mysql_error());
						
						$faculty4 = mysql_fetch_array($sql5);
						
						$tutor_id = $_SESSION['tutor'];
						
						$sql = "SELECT engbekter.ball, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, korsetkishter.korsetkish_ati, 	engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ 
						FROM engbekter 
						INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
						INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
						INNER JOIN status ON status.statusID = engbekter.kod_stat 
						WHERE Login = '$tutor_id' ORDER BY engbekter.engbekID DESC";
						
						$result = mysql_query($sql) or die(mysql_error());
					*/
						echo "<table><tr><th>№</th><th>Кафедра атауы</th><th>Аты жөні</th><th>Көрсеткіш</th><th>Саны</th><th>Қосымша автор саны</th><th>Файл аты</th><th>Балл</th><th>Қайтару себебі</th><th>Статус</th><th>Еңбекті жою</th></tr>";
						
						$i = 1;
						
						while($row = mysqli_fetch_array($sql)){
							echo "<tr><td>".$i."</td><td>".$row["cafedraNameKZ"]."</td><td>".$row["lastname"]." ".$row["firstname"]."</td><td>".$row["korsetkish_ati"]."</td><td>".$row["sani"]."</td><td>".$row["univ_avtor_san"]."</td><td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td><td>".$row["ball"]."</td><td>".$row["eskertu"]."</td><td>".$row["status_name"]."</td><td><a href = \"delete_engbek.php?ID=" . $row['engbekID'] . "\"><img style = 'width: 30px; padding: 10px;' src = '../img/resycle_bin.png'></a></td></tr>";
							$i++;
						}
						
						echo "</table>";    	
					?>
				</div>
			</div>
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>