<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<head>
	<?php include '../extensions/head_enbek.php'; ?>
        <script type="text/javascript">
            /* <![CDATA[ */
            /* Locale for JS */
            <?php require_once '../locale/jslocale.php'; ?>

            /* ]]> */
        </script>
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
			<h2 style = "text-align: center; padding-top: 10px;"><span style = "color: red;">[</span><?= $oL::get('Балл сәтті қосылды!!!')?><span style = "color: red;">]</span></h2>
			<?php
			
				session_start();
				$_SESSION['tutor'];
			
				// Redirect after 2 seconds
				echo '<meta http-equiv="refresh" content="2;url=engbek_jukteu_cafedra.php">';
				//$query = mysql_query("SELECT * FROM teachers WHERE login = '$_SESSION[teacher]'") or die(mysql_error());
				//$teacher = mysql_fetch_array($query);
				
			?>
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>