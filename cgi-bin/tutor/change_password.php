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
	<title>Құпия сөзді өзгерту беті</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<style>
		input[type=text],input[type=password]{
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
			width: 400px;
			padding: 20px;
			padding-left: 60px;
			border: 1px black solid;
			background: #ddd;
		}
		
		.footer{
			margin-top: 100px;
		}
	</style>
</head>
<body>
	<div class = "upper_header">
    <? include '../extensions/header.php' ?>
    </div>
	<div class = "header">
	<div id = "menu_nav">
        <? include '../extensions/nav.php'; ?>
		<nav id="primary_nav_wrap" style="display: none">
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
				$query = mysqli_query($connection,"SELECT * FROM tutors WHERE Login = '$_SESSION[tutor]'") or die(mysqli_error($connection));
				$tutor = mysqli_fetch_array($query);
				
			?>
			<div class = "login_form">
				<p style = "font-size: 18px; text-align: center;"><?= $oL::get('Құпия сөзді өзгерту')?></p>
				<form action = "doChange_password.php" method = "post">
					<table>
						<tr>
							<td><?= $oL::get('Ескі құпия сөз')?></td><td><input type = "text" name = "old_password" value = "" placeholder = "<?= $oL::get('Ескі құпия сөз теріңіз')?>"></td>
						</tr>
						<tr>
							<td><?= $oL::get('Жаңа құпия сөз')?></td><td><input type = "text" name = "new_password" value = ""  placeholder = "<?= $oL::get('Жаңа құпия сөз теріңіз')?>"></td>
							<input type = "hidden" name = "tutorID" value = "<?php echo $tutor['TutorID']; ?>">
						</tr>
						<tr>
							<td></td><td><input type = "submit" name = "submit_change" value = "<?= $oL::get('Өзгерту')?>"></td>
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