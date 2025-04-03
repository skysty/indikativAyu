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
	<title>Еңбектерді растау</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<style>
		.engbek{
			width: 900px;
			padding: 20px;
			margin: 0 auto;
			margin-bottom: 100px;
			border: black solid 1px;
			border-top: 1px black dashed;
		}
		.engbek select{
			padding: 5px;
		}
		table {
			width: 100%;
			font-size: 14px;
		}

		th, td {
			text-align: left;
			padding: 6px;
		}
		to_back:hover{
			background: red;
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
				  <li><a href="engbek_jukteu.php">ОПҚ</a></li>
				</ul>
			  </li>
			  <li><a href="#">Басқа</a>
				<ul>
				  <li><a href="baska_okitushyny_koru.php">ОПҚ</a></li>
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
		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 10px;">
		
			<?php
			
				$_SESSION['tutor'];
				$sql = mysql_query("SELECT * FROM tutors WHERE Login = '$_SESSION[tutor]'") or die(mysql_error());
				$result = mysql_fetch_array($sql);
				
				$sql2 = mysql_query("SELECT shagymdar.shagymID, shagymdar.shagym, shagymdar.shagym_kuni, tutors.lastname, tutors.firstname, tutors.patronymic, engbekter.file_ati
				FROM engbekter
				INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
				INNER JOIN shagymdar ON shagymdar.kod_enbek = engbekter.engbekID
				WHERE shagymdar.shagymID = '$_GET[ID]'") or die(mysql_error());
				
				$shagym = mysql_fetch_array($sql2);
				
			?>
			
			<h3 align = "center">Шағымға жауап жазу</h3>
			
			<div class = "engbek">
				<form action = "do_update_shagym.php" method = "post">
					<table>
						<tr>
							<td><span><strong>Еңбек иесі:</strong></td><td><?php echo $shagym['lastname'] . " " . $shagym['firstname'] . " " . $shagym['patronymic']; ?></span></td>
						</tr>
						<tr>
							<td><span><strong>Еңбегі:</strong></td><td><a target = "_blank" href = "<?php echo $shagym['file_ati']; ?>"><?php echo $shagym['file_ati']; ?></a></span></td>
						</tr>
						<tr>
							<td><span><strong>Шағымы:</strong></td><td><?php echo $shagym['shagym']; ?></span> </td>
						</tr>
						<tr>
							<td><span><strong>Шағым түскен күні:</strong></td><td><?php echo $shagym['shagym_kuni']; ?></span></td>
						</tr>
						<tr>
							<td><p style = "vertical-align: middle;"><strong>Жауабы:</strong> </p></td><td><textarea cols = 50 rows = 10 name = "jauap" id = "jauap"></textarea></td>
						</tr>
						<input type = "hidden" name = "shagym_id" value = "<?php echo $shagym['shagymID']; ?>" />
						<input type = "hidden" name = "tutor_id" value = "<?php echo $result['TutorID']; ?>" />
						<input type = "hidden" name = "save_date" value = "<?php date_default_timezone_set("Asia/Dhaka"); echo date("d.m.Y H:i:s");?>"/>
						<tr>
							<td></td><td><input style = "width: 100px; height: 50px;" type = "submit" name = "checked" value = "Ok"><span> <span><a href = "shagym_tekseru.php" style = "text-decoration: none; color: black;" class = "to_back"><<Артқа қайту</a></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>