<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
	<?php include '../extensions/head_enbek.php'; ?>
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
			<div class = "inner_conten" style = "width: 1000px; margin: 0 auto;">
				<h2 style = "text-align: center;"><?=$oL::get('Факультеттің немесе ҒЗО-ның орындалған жұмыстары')?></h2>			
				<?php
					$_SESSION['tutor'];
					$query = mysqli_query($connection,"SELECT cafedras.cafedraID, cafedras.FacultyID, tutors.TutorID
					FROM cafedras
					INNER JOIN faculties ON faculties.FacultyID = cafedras.FacultyID
					INNER JOIN tutors ON tutors.CafedraID = cafedras.cafedraID
					WHERE mail = '$_SESSION[tutor]'") or die(mysqli_error($connection));
					$tutor = mysqli_fetch_array($query);

					function load_korsetkish(){
						global $tt;
						global $connection;
						$output = '';
						$sql = "SELECT * FROM korsetkishter WHERE bolimderID IN(2) and typeID=2";
						$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
						
						while($row = mysqli_fetch_array($result)){
							$korset='';
							if($_SESSION['lang']=='rus')
								$korset=$row['korsetkish_ati2'];
							else
								$korset=$row['korsetkish_ati'];
							$output .= '<option value = "'.$row["kod_korsetkish"].'">' . $korset . '</option>';				
						}
						return $output;
					}
				?>
						<script>
                                                // mina kod barine koilsin-------------------------
							function validate(evt) {
								 var theEvent = evt || window.event;
								 var key = theEvent.keyCode || theEvent.which;
								 key = String.fromCharCode( key );
								 var regex = /[1-9]|\./;
								 if( !regex.test(key) ) {
									theEvent.returnValue = false;
									if(theEvent.preventDefault) theEvent.preventDefault();
								  }
							}
						//-------------------------------------------	
							$(document).ready(function(){
							
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
						<?=$oL::get('Көрсеткіштер')?>
						<select name = "korsetkish" id = "korsetkish">
							<option>---</option>
								<?php echo load_korsetkish(); ?>
						</select><br /><br />
						<span><?=$oL::get('Көрсеткіштің толық атауы')?></span><br />
						<textarea rows="8" cols="109" name = "tolyk_korset" id = "tolyk_korset" style = "font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"></textarea><br /><br />
						<?=$oL::get('Орындалған күні')?>
						<input type = "date" name = "date" placeholder = "жжжж-аа-кк" /><br /><br />
						<label for="sany" id = "label_sany"><?=$oL::get('Саны')?></label><br /><input type = "number" id = "sany" name = "sany" onkeypress='validate(event)' value = "1" step="0.01" min="0.01"><br /><br />		
						<span><?=$oL::get('Ескерту')?></span><br />
						<textarea rows="8" cols="109" name = "eskertu" style = "font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"></textarea><br/><br/><hr />
						<span><?=$oL::get('Растаушы файлды таңдау (PDF, JPG форматындағы файлдар)')?></span><br/><br/>
						<input type = "file" name="file" accept="application/pdf, image/*" /><br /><br /><hr />
						<input type = "hidden" name = "tutor_id" value = "<?php echo $tutor['TutorID'];?>"/>
						<input type = "hidden" name = "cafedra" value = "<?php echo $tutor['cafedraID'];?>"/>
						<input type = "hidden" name = "faculty" value = "<?php echo $tutor['FacultyID'];?>"/>
						<input type = "hidden" name = "save_date" value = "<?php date_default_timezone_set("Asia/Dhaka"); echo date("d/m/Y H:i:s");?>"/>
						<!--<br>Деректер қоры жабылды! 01.06.2021 00:00<br/>-->
						<input type = "submit" name = "upload" value = "<?=$oL::get('Жүктеу')?>"/>
						
					</form>
				</div>
				<div class = "works">
				<table>	
					<thead>
						<tr>
						<th>№</th>
						<th><?= $oL::get('Факультет')?></th>
						<th><?= $oL::get('Аты жөні')?></th>
						<th><?= $oL::get('Көрсеткіш')?></th>
						<th><?= $oL::get('Саны')?></th>
						<th><?= $oL::get('Автор саны')?></th>
						<th><?= $oL::get('Файл аты')?></th>
						<th><?= $oL::get('Балл')?></th>
						<th><?= $oL::get('Қайтару себебі')?></th>
						<th><?= $oL::get('Статус')?></th>
						</tr>
					</thead>
				<tbody>
					<?php
						
						$tutor_id = $_SESSION['tutor'];
						
						$sql = "SELECT engbekter.ball,
						 engbekter.engbekID,
						tutors.firstname,
						tutors.firstnameTR,
						engbekter.kod_kafedra,
						tutors.lastnameTR,
						tutors.lastname,
						tutors.patronymicTR,
						tutors.patronymic,
						korsetkishter.korsetkish_ati,
						korsetkishter.korsetkish_ati2,
						engbekter.sani,
						engbekter.univ_avtor_san,
						engbekter.file_ati,
						engbekter.kayt_sebeb,
						engbekter.eskertu,
						status.status_name,
						faculties.FacultyID,
						status.statusID,
						faculties.facultyNameKZ,
						faculties.facultyNameTR   
						FROM engbekter 
						LEFT JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
					    LEFT JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
						LEFT JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
						LEFT JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
						LEFT JOIN status ON status.statusID = engbekter.kod_stat 
						WHERE mail = '$tutor_id' and engbekter.kod_kafedra IS NULL   ORDER BY engbekter.engbekID DESC";
						
						$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
						
						
						$i = 1;
						
						while($row = mysqli_fetch_array($result)){
							$sLastName = $row['lastname'];
                                $sFirstName = $row['firstname'];
                                $sPatronymic = $row['patronymic'];
		                          $sFacult = $row['facultyNameKZ'];
                                //$sCafedra = $row['cafedraNameKZ'];
                                $korsetkih=$row['korsetkish_ati'];
                                if ($_SESSION['lang'] != 'kaz'){
                                    $sLastName = isset($row['lastnameTR']) && mb_strlen($row['lastnameTR']) ? $row['lastnameTR'] : $row['lastname'];
                                    $sFirstName = isset($row['firstnameTR']) && mb_strlen($row['firstnameTR']) ? $row['firstnameTR'] : $row['firstname'];
                                    $sPatronymic = isset($row['patronymicTR']) && mb_strlen($row['patronymicTR']) ? $row['patronymicTR'] : $row['patronymic'];
                                    $sFacult = isset($row['facultyNameTR']) && mb_strlen($row['facultyNameTR']) ? $row['facultyNameTR'] : $row['facultyNameKZ'];
                                    //$sCafedra = isset($row['cafedraNameRU']) && mb_strlen($row['cafedraNameRU']) ? $row['cafedraNameRU'] : $row['cafedraNameKZ'];
                                    $korsetkih= isset($row['korsetkish_ati2']) && mb_strlen($row['korsetkish_ati2']) ? $row['korsetkish_ati2'] : $row['korsetkish_ati'];
                                }

							echo "<tr> ";
								echo "<td>".$i."</td>";
								echo "<td>".$sFacult."</td>";
								echo "<td>".$sLastName." ".$sFirstName."</td>";
								echo "<td>".$korsetkih."</td>";
								echo "<td>".$row["sani"]."</td>";
								echo "<td>".$row["univ_avtor_san"]."</td>";
								echo "<td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td>";
								echo "<td>".$row["ball"]."</td><td>".$row["kayt_sebeb"]."</td><td>".$oL::get($row["status_name"])."</td>";
								echo "<td><button class='btn btn-danger delete-btn' data-id=".$row['engbekID']." onClick='deleteRecord(this)'>".$oL::get('Өшіру') ."</button></td>";
								echo "</tr>";
								$i++;
							}
							   	
						?>
						</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
<?php include '../extensions/scripts_enbek.php'; ?>
</html>