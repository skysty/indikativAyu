<?php
/**
 * Created by PhpStorm.
 * User: erzhigit@tagay.kz
 * Date: 08.08.2023
 * Time: 18:44
 */
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
	<?php
		session_start();
		$_SESSION['tutor'];
		include('../incs/connect.php');

		if(!isset($_SESSION['tutor'])){
			header('Location: ../login.php'); return;
		}
    $sHome = '/';
    if($_SESSION['roleID'] == 1){
        $sHome = '../tutor';
    } else if($_SESSION['roleID'] == 2){
        $sHome = '../admin';
    } else if($_SESSION['roleID'] == 3){
        $sHome = '../moderator';
    } else if($_SESSION['roleID'] == 4){
        $sHome = '../cafedraManager';
    } else if($_SESSION['roleID'] == 5){
        $sHome = '../facultyDean';
    } else if($_SESSION['roleID'] == 6){
        $sHome = '../first_moderator';
    }
	?>
	<title>Сөздік</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<style>
		.shagymTable{
			margin: 0 auto;
			width: 1000px;
		}
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

		tr:nth-child(even){background-color: #f2f2f2}

		th {
			background-color: #003366;
			color: white;
		}
	</style>
</head>
<body>
	<div class = "upper_header">
        <?php include '../extensions/header.php'?>
    </div>
	<div class = "header">
    <div id = "menu_nav">
        <?php include '../extensions/nav.php'; ?>
    </div>
	</div>
	<div class = "content">
		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 5px;">

			<?php

				$_SESSION['tutor'];

			?>
			<div class = "shagymTable">
				<h2 align = "center"><?= $oL::get('Көрсеткіштер')?></h2>
				<table>
					<tr>
						<th>№</th><th>Қазақша</th><th>Орыс тілі</th><th>Операция</th>
					</tr>
					<?php

						$query = mysqli_query($connection,"SELECT * FROM locale") or die(mysqli_error($connection));
						while($korsetkish = mysqli_fetch_array($query)){
							echo "<tr id='". $korsetkish['id'] ."'><td>" . $korsetkish['id'] ."</td><td>".$korsetkish['kaz']."</td><td>".$korsetkish['rus']."</td><td style='width: 13%'><div><span><a href=\"edit.php?id=".$korsetkish['id']."\">".$oL::get('Өңдеу')."</a></span><span style='float: right'><a href=\"deleted.php?id=".$korsetkish['id']."\">".$oL::get('Өшіру')."</a></span></div></td></tr>";
						}
					?>
				</table>
			</div>
		</div>
	</div>
	</br>
<script>
    <? if(isset($_GET['target'])) { ?>
        $(window).load(function(){
            $('html,body').animate({ scrollTop: $('#<?php echo $_GET['target'];  ?>').offset().top - 100 }, 'slow');
        });
    <? } ?>
</script>
</body>
</html>