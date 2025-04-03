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

	<title><?=$oL::get('Шағымдар')?></title>

	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">

	<script type = "text/javascript" src = "../js/jquery.js"></script>

	<script type = "text/javascript" src = "../js/functions.js"></script>

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

	<div class = "content">

		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 5px;">	

			<h2 style = "text-align: center; padding-top: 10px;"><span style = "color: red;">[</span><?=$oL::get('Балл сәтті қосылды!!!')?><span style = "color: red;">]</span></h2>

			<?php

			

				$_SESSION['tutor'];
				echo '<meta http-equiv="refresh" content="2;url=engbek_jukteu_faculty.php">';
				//$query = mysql_query("SELECT * FROM teachers WHERE login = '$_SESSION[teacher]'") or die(mysql_error());

				//$teacher = mysql_fetch_array($query);

				

			?>

		</div>

	</div>

	<div class = "footer">

	</div>

</body>

</html>