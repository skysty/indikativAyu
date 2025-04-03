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
	?>
	<title>Шағымдар</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
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
		</nav>
	</div>
	</div>
	<div class = "content">
		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 5px;">	
			<h2 style = "text-align: center; padding-top: 10px;"><span style = "color: red;">[</span>Сіздің еңбегіңіз сәтті жүктелді!!!<span style = "color: red;">]</span></h2>
			<?php
			
				$_SESSION['tutor'];
				header("refresh:2; url=index.php");
				//$query = mysql_query("SELECT * FROM teachers WHERE login = '$_SESSION[teacher]'") or die(mysql_error());
				//$teacher = mysql_fetch_array($query);
				
			?>
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>