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
	<div class = "header">
	<div id = "menu_nav">
		<nav id="primary_nav_wrap">
		</nav>
	</div>
	</div>
	<div class = "content">
		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 5px;">	
			<h2 style = "text-align: center; padding-top: 10px;"><span style = "color: red;">[</span>Шағымыңыз сәтті жіберілді!!!<span style = "color: red;">]</span></h2>
			<?php
			
				$_SESSION['tutor'];
				header("refresh:2; url=index.php");
				
			?>
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>