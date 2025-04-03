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
	<title><?=$oL::get('Еңбектерді растау')?></title>
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
        <?php include '../extensions/header.php'?>
    </div>	
<div class = "header">
		<div id = "menu_nav">
			<?php include '../extensions/nav.php'?>
		</div>
</div>
	</div>
	<div class = "content">
		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 10px;">
		
			<?php
			
				$_SESSION['tutor'];
				$sql = mysqli_query($connection,"SELECT * FROM tutors WHERE Login = '$_SESSION[tutor]'") or die(mysql_error());
				$result = mysqli_fetch_array($sql);
				
				$sql2 = mysqli_query($connection,"SELECT shagymdar.shagymID, shagymdar.shagym, shagymdar.shagym_kuni, tutors.lastname, tutors.firstname, tutors.patronymic, engbekter.file_ati
				FROM engbekter
				INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
				INNER JOIN shagymdar ON shagymdar.kod_enbek = engbekter.engbekID
				WHERE shagymdar.shagymID = '$_GET[ID]'") or die(mysqli_error($connection));
				
				$shagym = mysqli_fetch_array($sql2);
				
			?>
			
			<h3 align = "center"><?=$oL::get('Шағымға жауап жазу')?></h3>
			
			<div class = "engbek">
				<form action = "do_update_shagym.php" method = "post">
					<table>
						<tr>
							<td><span><strong><?=$oL::get('Еңбек иесі')?>:</strong></td><td><?php echo $shagym['lastname'] . " " . $shagym['firstname'] . " " . $shagym['patronymic']; ?></span></td>
						</tr>
						<tr>
							<td><span><strong><?=$oL::get('Еңбегі')?>:</strong></td><td><a target = "_blank" href = "<?php echo $shagym['file_ati']; ?>"><?php echo $shagym['file_ati']; ?></a></span></td>
						</tr>
						<tr>
							<td><span><strong><?=$oL::get('Шағымы')?>:</strong></td><td><?php echo $shagym['shagym']; ?></span> </td>
						</tr>
						<tr>
							<td><span><strong><?=$oL::get('Шағым түскен күні')?>:</strong></td><td><?php echo $shagym['shagym_kuni']; ?></span></td>
						</tr>
						<tr>
							<td><p style = "vertical-align: middle;"><strong><?=$oL::get('Жауабы')?>:</strong> </p></td><td><textarea cols = 50 rows = 10 name = "jauap" id = "jauap"></textarea></td>
						</tr>
						<input type = "hidden" name = "shagym_id" value = "<?php echo $shagym['shagymID']; ?>" />
						<input type = "hidden" name = "tutor_id" value = "<?php echo $result['TutorID']; ?>" />
						<input type = "hidden" name = "save_date" value = "<?php date_default_timezone_set("Asia/Dhaka"); echo date("d.m.Y H:i:s");?>"/>
						<tr>
							<td></td><td><input style = "width: 100px; height: 50px;" type = "submit" name = "checked" value = "<?=$oL::get('Жіберу')?>"><span> <span><a href = "shagym_tekseru.php" style = "text-decoration: none; color: black;" class = "to_back"><?=$oL::get('Артқа қайту')?></a></td>
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