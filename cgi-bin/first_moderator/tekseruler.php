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
	<script type="text/javascript">
            /* <![CDATA[ */
            /* Locale for JS */
            <?php require_once '../locale/jslocale.php'; ?>

            /* ]]> */
        </script>
	<title><?=$oL::get('Тексерулер')?></title>
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
        <?php include '../extensions/header.php'?>
    </div>	
<div class = "header">
		<div id = "menu_nav">
			<?php include '../extensions/nav.php'?>
		</div>
	</div>	
	<div class = "content">
		<div class = "content_wrapper" style = "margin-top: 5px;">		
			<?php
			
				$_SESSION['tutor'];
				$query = mysqli_query($connection,"SELECT * FROM tutors WHERE Login = '$_SESSION[tutor]'") or die(mysqli_error($connection));
				$tutor = mysqli_fetch_array($query);
			?>
			
			<div class = "two_btns">
				<p style = "text-align: center; font-size: 22px;"><?=$oL::get('Еңбектер мен шағымдарды тексеру')?></p>
				<ul>
					<li class = "btn"><a href = "engbek_tekseru.php"><?=$oL::get('Сіз тексеретін еңбектер')?></a></li>
					<li class = "btn"><a href = "shagym_tekseru.php"><?=$oL::get('Сіз тексеретін шағымдар')?></a></li>
				</ul>
			</div>			
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>