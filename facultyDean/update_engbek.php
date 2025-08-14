<!DOCTYPE html>
<html>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<head>
	<?php include '../extensions/head_enbek.php'; ?>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
					<h2 style = "text-align: center;"><?= $oL::get('Жүктелген еңбекті өзгерту')?></h2>
					<?php
						$tutor_query = mysqli_query($connection, "SELECT cafedras.cafedraID, cafedras.FacultyID, tutors.TutorID
						FROM cafedras
						INNER JOIN faculties ON faculties.FacultyID = cafedras.FacultyID
						INNER JOIN tutors ON tutors.CafedraID = cafedras.cafedraID
						WHERE mail = '$_SESSION[tutor]'") or die(mysqli_error($connection));
						$tutor = mysqli_fetch_array($tutor_query);
						$tut = $tutor['TutorID'];
					
						$enbekID = isset($_GET['engbekID']) ? $_GET['engbekID'] : null;
					
						if ($enbekID) {
							$query = mysqli_query($connection, "SELECT * FROM engbekter WHERE engbekID = '$enbekID'") or die(mysqli_error($connection));
							$data = mysqli_fetch_array($query);
						}
					
						function load_korsetkish($selected_kod_korsetkish = null) {
							global $connection;
							global $tut;
							$output = '';
							$sql = "SELECT * FROM korsetkishter WHERE bolimderID='1'";
							$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
							
							while ($row = mysqli_fetch_array($result)) {
								$kors = $row['korsetkish_ati'];
								if ($_SESSION['lang'] != 'kaz') {
									$kors = isset($row['korsetkish_ati2']) && mb_strlen($row['korsetkish_ati2']) ? $row['korsetkish_ati2'] : $row['korsetkish_ati'];
								}
								$selected = $row["kod_korsetkish"] == $selected_kod_korsetkish ? 'selected' : '';
								$output .= '<option id_esep="' . $row["id_esep"] . '" id_comment="' . $row["id_comment"] . '" value="' . $row["kod_korsetkish"] . '" id_shekteu="' . $row["id_shekteu"] . '" ' . $selected . '>' . $kors . '</option>';
							}
							return $output;
						}
					?>	
					<div class="select_box">
					<form id="form1" method="post" action="load_update_engbek.php" style="margin-top: 10px;" enctype="multipart/form-data">
						<?= $oL::get('Көрсеткіштер')?>
						<select name="korsetkish" id="korsetkish">
							<option>---</option>
							<?php echo load_korsetkish($data['kod_korset'] ?? null); ?>
						</select><br /><br />

						<span><?= $oL::get('Көрсеткіштің толық атауы')?></span><br />
						<textarea rows="8" cols="109" name="tolyk_korset" id="tolyk_korset" style="font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"><?php echo $data['tolyk_korset'] ?? ''; ?></textarea><br /><br />

						<?= $oL::get('Орындалған күні')?>
						<input type="date" name="date" required value="<?php echo $data['kuni'] ?? ''; ?>" /><br /><br />

						<?= $oL::get('Авторлардың жалпы санына қарай бөлінеді(автордың ішкі немесе сыртқы екеніне қарамастан)')?><span style="color:red" id="hideText"><?= $oL::get('Макс 7 автор')?></span><br/>
						<input type="number" id="univ_avtor_san" name="univ_avtor_san" value="<?php echo $data['univ_avtor_san'] ?? '1'; ?>" min="1"/><br /><br />

						<div id="hidingElem">
							<?= $oL::get('Еңбек санының түрлері')?>
							<select id="select_sany" name="select_sany">
								<option value="0" <?php if(isset($data['select_sany']) && $data['select_sany'] == 0) echo 'selected'; ?>>---</option>
								<option value="1" <?php if(isset($data['select_sany']) && $data['select_sany'] == 1) echo 'selected'; ?>><?= $oL::get('Әр 1 млн. теңге үшін')?></option>
								<option value="2" <?php if(isset($data['select_sany']) && $data['select_sany'] == 2) echo 'selected'; ?>><?= $oL::get('Деңгейі')?></option>
								<option value="5" <?php if(isset($data['select_sany']) && $data['select_sany'] == 5) echo 'selected'; ?>><?= $oL::get('Саны')?></option>
							</select><br /><br />

							<label for="sany" id="label_sany">---</label><br />
							<input type="number" id="sany" name="sany" value="<?php echo $data['sany'] ?? '1'; ?>" step="0.01"><br />
						</div><br />

						<span><?= $oL::get('Ескерту')?></span><br />
						<textarea rows="8" cols="109" name="eskertu" style="font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"><?php echo $data['eskertu'] ?? ''; ?></textarea><br /><br /><hr />

						<span><?= $oL::get('Растаушы файлды таңдау (PDF, JPG форматындағы файлдар)')?></span><br /><br />

						<?php if (!empty($data['file_ati'])): ?>
							<p>Current File: <?php echo htmlspecialchars($data['file_ati']); ?></p>
							<a href="<?php echo htmlspecialchars($data['file_ati']); ?>" target="_blank">View current file</a><br /><br />
						<?php endif; ?>

						<input type="file" name="file" accept="application/pdf, image/*" /><br /><br /><hr />

						<input type="hidden" name="tutor_id" value="<?php echo $tutor['TutorID'];?>"/>
						<input type="hidden" name="id_esep" id="id_esep1" value="<?php echo $data['id_esep'] ?? ''; ?>" />
						<input type="hidden" name="cafedra" value="<?php echo $tutor['cafedraID'];?>"/>
						<input type="hidden" name="faculty" value="<?php echo $tutor['FacultyID'];?>"/>
						<input type="hidden" name="engbek" value="<?php echo $data['engbekID'];?>"/>
						<input type="hidden" name="save_date" value="<?php date_default_timezone_set("Asia/Dhaka"); echo date("d/m/Y H:i:s");?>"/>                        

						<input type="submit" name="upload" value="<?= $oL::get('Жүктеу')?>"/>
					</form>
					</div>
					<div class = "works">
						<table>
							<thead>
							<tr>
								<th>№</th>
								<th><?= $oL::get('Кафедра')?></th>
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
							tutors.firstname, tutors.lastname, 
							tutors.patronymic, 
							tutors.firstnameTR, tutors.lastnameTR, 
							tutors.patronymicTR, 
							korsetkishter.korsetkish_ati, 
							korsetkishter.korsetkish_ati2,
							engbekter.sani, 
							engbekter.divBall,
							engbekter.univ_avtor_san, 
							engbekter.file_ati, 
							engbekter.kayt_sebeb, 
							engbekter.eskertu, 
							status.status_name,
							faculties.FacultyID, 
							status.statusID, 
							cafedras.cafedraNameKZ, 
							faculties.facultyNameKZ,
							cafedras.cafedraNameTR, 
							faculties.facultyNameTR 
							FROM engbekter 
							INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
							INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
							INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
							INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
							INNER JOIN status ON status.statusID = engbekter.kod_stat 
							WHERE Login = '$tutor_id' and engbekter.univ_avtor_san is not null and engbekter.del=0 ORDER BY engbekter.engbekID DESC";
							
							$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
							
							$i = 1;
							
							while($row = mysqli_fetch_array($result)){
                                $sLastName = $row['lastname'];
                                $sFirstName = $row['firstname'];
                                $sPatronymic = $row['patronymic'];
                                $sCafedra = $row['cafedraNameKZ'];
                                $korsetkih=$row['korsetkish_ati'];
                                if ($_SESSION['lang'] != 'kaz'){
                                    $sLastName = isset($row['lastnameTR']) && mb_strlen($row['lastnameTR']) ? $row['lastnameTR'] : $row['lastname'];
                                    $sFirstName = isset($row['firstnameTR']) && mb_strlen($row['firstnameTR']) ? $row['firstnameTR'] : $row['firstname'];
                                    $sPatronymic = isset($row['patronymicTR']) && mb_strlen($row['patronymicTR']) ? $row['patronymicTR'] : $row['patronymic'];
                                    $sCafedra = isset($row['cafedraNameTR']) && mb_strlen($row['cafedraNameTR']) ? $row['cafedraNameTR'] : $row['cafedraNameKZ'];
                                    $korsetkih= isset($row['korsetkish_ati2']) && mb_strlen($row['korsetkish_ati2']) ? $row['korsetkish_ati2'] : $row['korsetkish_ati'];
                                }
								echo "<tr> ";
								echo "<td>".$i."</td>";
								echo "<td>".$sCafedra."</td>";
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
	<script>
		
		$(document).ready(function () {
			var id_shekteu =$("#korsetkish option:selected").attr('id_shekteu');
            console.log("id_shekteu:", id_shekteu); 
			if (id_shekteu <= 1) {
				$("#sany").prop('disabled', true);
				$("#select_sany").prop('disabled', true);
			} else {
				$("#sany").prop('disabled', false);
				$("#select_sany").prop('disabled', false);
			}
    });
	</script>
</html>