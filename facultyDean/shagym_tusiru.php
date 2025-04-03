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
	<title>Шағым түсіру</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<style>
		.select_box{
			width: 600px;
			padding: 20px;
			margin: 0 auto;
			margin-top: 30px;
			margin-bottom: 30px;
			border: 1px black solid;
			background: #ddd;
		}
		.btn {
			  background: #3498db;
			  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
			  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
			  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
			  background-image: -o-linear-gradient(top, #3498db, #2980b9);
			  background-image: linear-gradient(to bottom, #3498db, #2980b9);
			  font-family: Arial;
			  color: #ffffff;
			  font-size: 20px;
			  padding: 10px 20px 10px 20px;
			  text-decoration: none;
			}

			.btn:hover {
			  background: #3cb0fd;
			  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
			  text-decoration: none;
			}
			.btn:focus {
				background: #3cb0fd;
			}
			select{
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
				width: 300px;
				padding: 20px;
				border: 1px black solid;
			}
			
			.footer{
				margin-top: 100px;
			}
	</style>
</head>
<body>
	<div class = "upper_header">
    <?php include '../extensions/header.php' ?>
    </div>
	<div class = "header">
	<div id = "menu_nav">
        <?php include '../extensions/nav.php'?>
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
		<div class = "content_wrapper" style = "margin-top: 5px;">
			<div class = "inner_conten" style = "width: 800px; margin: 0 auto;">
				<h2 style = "text-align: center;"><?= $oL::get('Шағым жіберу формасы')?></h2>
				<?php
				
					function load_faculty(){
						global $connection;
						$output = '';
						$sql = "SELECT * FROM faculties";
						$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
						
						while($row = mysqli_fetch_array($result)){
                            $sFacult = $row['facultyNameKZ'];
                            if ($_SESSION['lang'] != 'kaz'){
                                $sFacult = isset($row['facultyNameRU']) && mb_strlen($row['facultyNameRU']) ? $row['facultyNameRU'] : $row['facultyNameKZ'];
                            }
							$output .= '<option value = "'.$row["FacultyID"].'">' . $sFacult . '</option>';
						}
						return $output;
					}
				?>
				<div class = "select_box">
					<form method = "post" action = "sendShagym.php" style = "margin-top: 10px;">
						<?= $oL::get('Факультет немесе ҒЗО')?>
						<select name = "faculty" id = "faculty">
							<option value = ""><?= $oL::get('Факультетті немесе ҒЗО-ны таңдаңыз')?></option>
								<?php echo load_faculty(); ?>
						</select><br><br>
						<?= $oL::get('Кафедра немесе ҒЗИ')?>
						<select name = "cafedra" id = "cafedra">
							<option value = ""><?= $oL::get('Кафедраны немесе ҒЗИ-ды таңдаңыз')?></option>
								
						</select><br><br>
						<?= $oL::get('Оқытушы немесе ғылыми қызметкер')?>
						<select name = "tutor" id = "tutor">
							<option value = ""><?= $oL::get('Оқытушыны немесе ғылыми қызметкерді таңдаңыз')?></option>
								
						</select><br><br>
						<?= $oL::get('Еңбектері')?>
						<select name = "engbek" id = "engbek">
							<option value = ""><?= $oL::get('Еңбегін таңдаңыз')?></option>
								
						</select><br><br>
						<script>
							$(document).ready(function(){
							
								$("#faculty").change(function(){
									var FacultyID = $(this).val();
									$.ajax({
										url:"get_cafedra.php",
										method:"POST",
										data:{FacultyID:FacultyID},
										dataType:"text",
										success:function(data){
											$("#cafedra").html(data);
										}
									});
								});
								$("#cafedra").change(function(){
									var cafedraID = $(this).val();
									$.ajax({
										url:"get_tutor.php",
										method:"POST",
										data:{cafedraID:cafedraID},
										dataType:"text",
										success:function(data){
											$("#tutor").html(data);
										}
									});
								});
								$("#tutor").change(function(){
									var TutorID = $(this).val();
									$.ajax({
										url:"get_engbek.php",
										method:"POST",
										data:{TutorID:TutorID},
										dataType:"text",
										success:function(data){
											$("#engbek").html(data);
										}
									});
								});
								
							});
						</script>
						<input type = "hidden" name = "shagym_date" value = "<?php date_default_timezone_set("Asia/Dhaka"); echo date("d/m/Y H:i:s");?>"/>
						Шағым
						<textarea rows="8" cols="70" name = "shagym" style = "margin-top: 8px; border-radius:4px;"></textarea><br/><br/>
						<!--<input type = "submit" name = "send" value = "Шағымды жіберу">-->
					</form>
				</div>
			</div>
		</div>
	</div>	
</body>
</html>