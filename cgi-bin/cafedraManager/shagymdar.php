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
	<title>Шағымдар</title>
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
    <?php include '../extensions/header.php' ?>
    </div>
	<div class = "header">
	<div id = "menu_nav">
        <?php include '../extensions/nav.php' ?>
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
              <li><a href="../locale/index.php">Сөздік</a></li>
			  <li><a href="../logout.php">Шығу</a></li>
			</ul>
		</nav>
	</div>
	</div>
	<div class = "content">
		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 5px;">
		
			<?php
			
				$_SESSION['tutor'];
				//$query = mysql_query("SELECT * FROM teachers WHERE login = '$_SESSION[teacher]'") or die(mysql_error());
				//$teacher = mysql_fetch_array($query);
				
			?>
			<div class = "shagymTable">
				<h2 align = "center"><?= $oL::get('Келіп түскен шағымдар')?></h2>
				<table>
					<tr>
						<th>№</th><th><?= $oL::get('Еңбек иесі')?></th><th><?= $oL::get('Еңбек')?></th><th><?= $oL::get('Шағым')?></th><th><?= $oL::get('Шағым күні')?></th><th><?= $oL::get('Шағымның жауабы')?></th><th><?= $oL::get('Жауап күні')?></th>
					</tr>
					<?php
						
						$query = mysqli_query($connection,"SELECT shagymdar.shagymID, shagymdar.shagym, shagymdar.shagym_kuni, shagymdar.jauap, shagymdar.jauap_kuni, engbekter.file_ati, tutors.firstname, tutors.lastname, tutors.firstnameRu, tutors.lastnameRu
						FROM shagymdar
						INNER JOIN engbekter ON engbekter.engbekID = shagymdar.kod_enbek
						INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm GROUP BY shagymdar.shagymID") or die(mysqli_error($connection));
						$i = 1;
						while($shagym = mysqli_fetch_array($query)){
                            $sLastName = $shagym['lastname'];
                            $sFirstName = $shagym['firstname'];
                            if ($_SESSION['lang'] != 'kaz'){
                                $sLastName = isset($shagym['lastnameRu']) && mb_strlen($shagym['lastnameRu']) ? $shagym['lastnameRu'] : $shagym['lastname'];
                                $sFirstName = isset($shagym['firstnameRu']) && mb_strlen($shagym['firstnameRu']) ? $shagym['firstnameRu'] : $shagym['firstname'];
                            }
							echo "<tr><td>" . $i ."</td><td>".$sLastName." ".$sFirstName."</td><td><a target='_blank' href = " .$shagym['file_ati'] .">".$shagym["file_ati"]."</a></td><td>". $shagym['shagym'] .
							"</td><td>". $shagym['shagym_kuni'] .
							"</td><td>". $shagym['jauap'] ."</td><td>". $shagym['jauap_kuni'] ."</td></tr>";
							$i++;
						}
					?>
				</table>
			</div>
		</div>
	</div>	
</body>
</html>