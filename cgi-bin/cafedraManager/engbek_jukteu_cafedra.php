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
		<div class = "content_wrapper" style = "margin-top: 5px;">
			<div class = "inner_conten" style = "width: 1000px; margin: 0 auto;">
				<h2 style = "text-align: center;"><?= $oL::get('Кафедраның немесе ҒЗИ-дың орындалған жұмыстары')?></h2>			
				<?php
					$_SESSION['tutor'];
					$query = mysqli_query($connection,"SELECT cafedras.cafedraID, cafedras.FacultyID, tutors.TutorID
					FROM cafedras
					INNER JOIN faculties ON faculties.FacultyID = cafedras.FacultyID
					INNER JOIN tutors ON tutors.CafedraID = cafedras.cafedraID
					WHERE Login = '$_SESSION[tutor]'") or die(mysqli_error($connection));
					$tutor = mysqli_fetch_array($query);
					
					
					$query = mysqli_query($connection,"SELECT tutors.typeCafANDFac FROM tutors WHERE  Login = '$_SESSION[tutor]'") or die(mysqli_error($connection));
					$tutor1 = mysqli_fetch_array($query);
					$tt=$tutor1['typeCafANDFac'];
					function load_korsetkish(){
						global $tt;
						global $connection;
						$output = '';
						$sql = "SELECT * FROM korsetkishter WHERE bolimderID IN(3,7) and typeID='$tt' ";
						$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
						
						while($row = mysqli_fetch_array($result)){
							$kors = '';
							if($_SESSION['lang'] == 'rus')
								$kors = $row['korsetkish_ati2'];
							else
								$kors = $row['korsetkish_ati'];
								$output .= '<option id_esep="'.$row["id_esep"].'" id_comment="'.$row["id_comment"].'" value = "'.$row["kod_korsetkish"].'" id_shekteu="'.$row["id_shekteu"].'">' . $kors . '</option>';				
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
					<form method = "post" action = "load_engbek_cafedra.php" style = "margin-top: 10px;" enctype = "multipart/form-data">
						<?= $oL::get('Көрсеткіштер')?>
						<select name = "korsetkish" id = "korsetkish">
							<option>---</option>
								<?php echo load_korsetkish(); ?>
						</select><br /><br />
						<span><?= $oL::get('Көрсеткіштің толық атауы')?></span><br />
						<textarea rows="8" cols="109" name = "tolyk_korset" id = "tolyk_korset" style = "font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"></textarea><br /><br />
						<?= $oL::get('Орындалған күні')?>
						<input type = "date" name = "date" placeholder = "жжжж-аа-кк" /><br /><br />
						<label for="sany" id = "label_sany"><?= $oL::get('Саны')?></label><br />
						<input type = "number" id = "sany" name = "sany" onkeypress='validate(event)' value = "1" step="0.01" min="0.01"><br /><br />		
						<span><?= $oL::get('Ескерту')?></span><br />
						<textarea rows="8" cols="109" name = "eskertu" style = "font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"></textarea><br/><br/><hr />
						<span><?= $oL::get('Растаушы файлды таңдау (PDF, JPG форматындағы файлдар)')?></span><br/><br/>
						<input type = "file" name="file" accept="application/pdf, image/*" /><br /><br /><hr />
						<input type = "hidden" name = "tutor_id" value = "<?php echo $tutor['TutorID'];?>"/>
						<input type = "hidden" name = "cafedra" value = "<?php echo $tutor['cafedraID'];?>"/>
						<input type = "hidden" name = "faculty" value = "<?php echo $tutor['FacultyID'];?>"/>
						<input type = "hidden" name = "save_date" value = "<?php date_default_timezone_set("Asia/Dhaka"); echo date("d/m/Y H:i:s");?>"/>
                              		       <!-- <br>Деректер қоры жабылды! 01.06.2021 00:00<br/>-->
						<input type = "submit" name = "upload" value = "<?= $oL::get('Жүктеу')?>"/>										

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
						
						$sql = "SELECT engbekter.ball, 
						    engbekter.engbekID, 
                                                   tutors.firstname, 
                                                   tutors.lastname, 
                                                   tutors.patronymic,
						    tutors.firstnameRu, 
						    tutors.lastnameRu, 
						    tutors.patronymicRu,  
                                                   korsetkishter.korsetkish_ati, 	
                                                   engbekter.sani, 
                                                   engbekter.univ_avtor_san, 
                                                   engbekter.file_ati, 
                                                   engbekter.kayt_sebeb, 
                                                   engbekter.eskertu, 
                                                  status.status_name, 
                                                  faculties.FacultyID, 
                                                  status.statusID, 
                                                  cafedras.cafedraNameKZ, 
                                                  faculties.facultyNameKZ,
                                                  cafedras.cafedraNameRU, 
						   faculties.facultyNameRU  
						FROM engbekter 
						INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
						INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
						INNER JOIN status ON status.statusID = engbekter.kod_stat 
						WHERE Login = '$tutor_id' ORDER BY engbekter.engbekID DESC";
						
						$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
						
						echo "<table><tr><th>№</th><th>Кафедра/ҒЗИ</th><th>Аты жөні</th><th>Көрсеткіш</th><th>Саны</th><th>Автор саны</th><th>Файл аты</th><th>Балл</th><th>Қайтару себебі</th><th>Статус</th></tr>";
						
						$i = 1;
						
						while($row = mysqli_fetch_array($result)){
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