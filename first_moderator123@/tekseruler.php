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
	<title>Тексерулер</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<style>
		
		.two_btns{
			margin:0 auto;
			margin-top: 100px;
			width: 600px;
			border: 1px black solid;
			padding: 30px;
			padding-right: 50px;
		}
		.two_btns ul{
			list-style: none;
		}
		
		.btn {
		  font-family: Arial;
		  color: #ffffff;
		  background: #003366;
		  padding: 10px 100px 10px 100px;
		  text-decoration: none;
		  margin: 20px;
		  text-align: center;
		}

		.btn:hover{
		  background: #3cb0fd;
		  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
		  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
		  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
		  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
		  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
		  text-decoration: none;
		}
		
		.btn a{
		  font-family: Arial;
		  color: #ffffff;
		  font-size: 22px;
		  text-decoration: none;
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
			
				$_SESSION['tutor'];
				$query = mysql_query("SELECT * FROM tutors WHERE Login = '$_SESSION[tutor]'") or die(mysql_error());
				$tutor = mysql_fetch_array($query);
			?>
			
			<div class = "two_btns">
				<p style = "text-align: center; font-size: 22px;">Еңбектер мен шағымдарды тексеру</p>
				<ul>
					<li class = "btn"><a href = "engbek_tekseru.php">Сіз тексеретін еңбектер</a></li>
					<li class = "btn"><a href = "shagym_tekseru.php">Сіз тексеретін шағымдар</a></li>
				</ul>
			</div>			
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>