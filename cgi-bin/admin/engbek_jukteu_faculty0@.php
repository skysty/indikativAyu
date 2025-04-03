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
	<title>Еңбекті жүктеу</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<style>
		input[type=text],input[type=password],input[type=date]{
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=number]{
			width: 200px;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		.select_box{
			width: 1000px;
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
			.works{
				margin: 0 auto;
				width: 1045px;
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
			<div class = "inner_conten" style = "width: 1000px; margin: 0 auto;">
				<h2 style = "text-align: center;">Орталықтандырылған ендіру (Факультет немесе ҒЗО)</h2>			
				<?php
					
				/*	if(isset($_SESSION['teacher'])){
					
					} else {
					
						header('Location: login.php');
					}
				*/
					$_SESSION['tutor'];
					$query = mysql_query("SELECT cafedras.cafedraID, cafedras.FacultyID, tutors.TutorID
					FROM cafedras
					INNER JOIN faculties ON faculties.FacultyID = cafedras.FacultyID
					INNER JOIN tutors ON tutors.CafedraID = cafedras.cafedraID
					WHERE Login = '$_SESSION[tutor]'") or die(mysql_error());
					$tutor = mysql_fetch_array($query);
					
					function load_korsetkish(){
						$output = '';
						$sql = "SELECT * FROM korsetkishter WHERE bolimderID IN(2,3)";
						$result = mysql_query($sql) or die(mysql_error());
						
						while($row = mysql_fetch_array($result)){			
							$output .= '<option value = "'.$row["kod_korsetkish"].'">' . $row["korsetkish_ati"] . '</option>';				
						}
						return $output;
					}
					
					function load_faculty(){
						$output = '';
						$sql = "SELECT * FROM faculties";
						$result = mysql_query($sql) or die(mysql_error());
						
						while($row = mysql_fetch_array($result)){			
							$output .= '<option value = "'.$row["FacultyID"].'">' . $row["facultyNameKZ"] . '</option>';				
						}
						return $output;
					}
				?>
						<script>
							$(document).ready(function(){
								
								$("#faculty1").change(function(){
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
							
								$("#korsetkish").change(function(){
									var kod_korsetkish = $("#korsetkish option:selected").text();
									$.ajax({
										method:"POST",
										data:{kod_korsetkish:kod_korsetkish},
										dataType:"text",
										success:function(data){
											$("#tolyk_korset").text(kod_korsetkish);
										}
									});
								});
								
								$("#select_sany").change(function(){
									var select_sany = $("#select_sany option:selected").text();
									var select_sanyID = $("#select_sany option:selected").val();
									$.ajax({
										method:"POST",
										data:{select_sany:select_sany},
										dataType:"text",
										success:function(data){
											$("#label_sany").text(select_sany);
										/*	if(select_sanyID == 3){
												alert("Сағат саны максимал 36");
												$('#sany').prop('min','1');
												$('#sany').prop('max','36');
											} else if(select_sanyID == 4){
												alert("Шаршы см. максимал 500");
												$('#sany').prop('min','1');
												$('#sany').prop('max','500');
											} 	*/								
										}
									});
								});
							});
						/*	function limit(element){
								var max_chars = 3;
								if(element.value.length > max_chars) {
									element.value = element.value.substr(0, max_chars);
								}
							} */
						</script>
				<div class = "select_box">
					<form method = "post" action = "load_engbek_faculty.php" style = "margin-top: 10px;" enctype = "multipart/form-data">
						Көрсеткіштер
						<select name = "korsetkish" id = "korsetkish">
							<option>---</option>
								<?php echo load_korsetkish(); ?>
						</select><br /><br />
						<span>Көрсеткіштің толық атауы</span><br />
						<textarea rows="8" cols="109" name = "tolyk_korset" id = "tolyk_korset" style = "font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"></textarea><br /><br />
						Орындалған күні
						<input type = "date" name = "date" placeholder = "жжжж-аа-кк"/><br /><br />
						Факультет немесе ҒЗО
						<select name = "faculty" id = "faculty1">
							<option>Факультетті немесе ҒЗО-ны таңдаңыз</option>
								<?php echo load_faculty(); ?>
						</select><br /><br />
						Кафедра немесе ҒЗИ
						<select name = "cafedra" id = "cafedra">
							<option>Кафедраны немесе ҒЗИ-ды таңдаңыз</option>
						</select><br /><br />
						<label for="sany" id = "label_sany">Саны</label><br /><input type = "number" id = "sany" name = "sany" value = "1" step="0.01" min="0.01"><br /><br />
						<label for="ball" id = "ball">Балы</label><br /><input type = "text" id = "ball" name = "ball" value = "1" step="0.01" min="0.01"><br /><br />
						<span>Ескерту</span><br />
						<textarea rows="8" cols="109" name = "eskertu" style = "font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"></textarea><br/><br/><hr />
						<span>Растаушы файлды таңдау (PDF, JPG форматындағы файлдар)</span><br/><br/>
						<input type = "file" name="file[]" accept="application/pdf, image/*" /><br /><br /><hr />
						<input type = "hidden" name = "tutor_id" value = "<?php echo $tutor['TutorID'];?>"/>
						<input type = "hidden" name = "save_date" value = "<?php date_default_timezone_set("Asia/Dhaka"); echo date("d/m/Y H:i:s");?>"/>						
						<!--<input type = "submit" name = "upload000" value = "Жүктеу"/>-->
					</form>
				</div>
				<div class = "works">
					<style>
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

						th {
							background-color: #003366;
							color: white;
						}
					</style>
					<?php
						
						$tutor_id = $_SESSION['tutor'];
						
						$sql = "SELECT engbekter.ball, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, korsetkishter.korsetkish_ati, 	engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ 
						FROM engbekter 
						INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
						INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
						INNER JOIN status ON status.statusID = engbekter.kod_stat 
						WHERE Login = '$tutor_id' ORDER BY engbekter.engbekID DESC";
						
						$result = mysql_query($sql) or die(mysql_error());
						
						echo "<table><tr><th>№</th><th>Кафедра/ҒЗИ</th><th>Аты жөні</th><th>Көрсеткіш</th><th>Саны</th><th>Автор саны</th><th>Файл аты</th><th>Балл</th><th>Қайтару себебі</th><th>Статус</th></tr>";
						
						$i = 1;
						
						while($row = mysql_fetch_array($result)){
							echo "<tr><td>".$i."</td><td>".$row["cafedraNameKZ"]."</td><td>".$row["lastname"]." ".$row["firstname"]."</td><td>".$row["korsetkish_ati"]."</td><td>".$row["sani"]."</td><td>".$row["univ_avtor_san"]."</td><td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td><td>".$row["ball"]."</td><td>".$row["kayt_sebeb"]."</td><td>".$row["status_name"]."</td></tr>";
							$i++;
						}
						
						echo "</table>";    	
					?>
				</div>
			</div>
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>