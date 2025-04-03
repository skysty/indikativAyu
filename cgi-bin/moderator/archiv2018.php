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
	<script type = "text/javascript" src = "../chartjs/js/chart.js"></script>
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
			width: 660px;
			padding: 50px;
			height: 300px;
			margin: 0 auto;
			border: 1px black dashed;
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
$result= mysql_query("SELECT text_jildar FROM jildar WHERE id_jildar= '1'");
while($row = mysql_fetch_array($result)){
echo $row['text_jildar'];
 }
?>
</div></br>	</div>
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
		<div class = "content_wrapper" style = "margin-top: 5px;margin-bottom: 10px;">
			<h3 align = "center">Рейтинг ОПҚ 2017-2018 маусым<br /> ИНДИКАТИВТІ ЖОСПАРЫ</h3>
			<object data="../files/2017-2018.pdf" type="application/pdf" width="100%" height="600px">
			</object>
		</div>
	</div>
</body>
</html>