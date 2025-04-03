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
<script type = "text/javascript" src = "../js/jquery.js"></script>
    <script type="text/javascript">
            /* <![CDATA[ */
            /* Locale for JS */
            <?php require_once '../locale/jslocale.php'; ?>

            /* ]]> */
        </script>
	<title><?=$oL::get('Еңбектерді растау')?></title>

	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.2/sweetalert2.min.css">
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.2/sweetalert2.min.js"></script>
	<link rel="shortcut icon" type="image/png" href="/img/logo211.png" />

	<script>

		$(document).ready(function(){											

			$("#status").change(function(){

				var kod_stat = $("#status option:selected").text();

				$.ajax({

					method:"POST",

					data:{kod_stat:kod_stat},

					dataType:"text",

					success:function(data){

						alert(kod_stat+" статусын таңдадыңыз!!!");

					}

				});

			});

		});

	</script>

	<style>
		.engbek{
			width: 900px;
			padding: 20px;
			margin: 0 auto;
			margin-bottom: 100px;
			border: black solid 1px;
			border-top: 1px black dashed;
		}
		.engbek select{
			padding: 5px;
		}
		table {
			width: 100%;
			font-size: 14px;
		}
		th, td {
			text-align: left;
			padding: 6px;
		}
		to_back:hover{
			background: red;
		}
	</style>

</head>

<body>	
<div class = "header">
		<div id = "menu_nav">
			<?php include '../extensions/nav.php'?>
		</div>
	</div>	

	<div class = "content">

		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 10px;">

		

			<?php

			

				$_SESSION['tutor'];

				$sql = mysqli_query($connection,"SELECT * FROM tutors WHERE mail = '$_SESSION[tutor]'") or die(mysqli_error($connection));

				$result = mysqli_fetch_array($sql);

				

				$sql2 = mysqli_query($connection,"SELECT 
				engbekter.engbekID,
				engbekter.kod_korset, 
				engbekter.file_ati,
				engbekter.sani, 
				engbekter.univ_avtor_san,
				engbekter.eskertu,
				engbekter.ball,
				tutors.TutorID, 
				tutors.lastname,
				tutors.firstname,
				tutors.patronymic,
				faculties.facultyNameKZ,
				faculties.facultyNameRU,
				cafedras.cafedraNameKZ,
				cafedras.cafedraNameRU,
				korsetkishter.korsetkish_ati,
				korsetkishter.korsetkish_ati2,
				status.status_nameRU,
				kaytaru_sebebi.sebepter,
                kaytaru_sebebi.sebepterRU
				FROM engbekter
				INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
				INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
				INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
				INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
				INNER JOIN status ON status.statusID = engbekter.kod_stat
				INNER JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb = engbekter.kod_kayt_sebeb
				WHERE engbekID = '$_GET[ID]'") or die(mysqli_error($connection));
				$engbek = mysqli_fetch_array($sql2);
				$showInput = $engbek['kod_korset'];
				function load_status(){
					global $connection;
					$output = '';
					$sql = "SELECT * FROM status";
					$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
					while($row = mysqli_fetch_array($result)){			
                         $statuss='';
						 if($_SESSION['lang']=='rus')
						 	$statuss=$row['status_nameRU'];
						 else
						    $statuss=$row['status_name'];
						$output .= '<option value = "'.$row["statusID"].'">' . $statuss . '</option>';				
					}
					return $output;
				}
				function load_sebep(){
					global $connection;
					$output = '';
					$sql = "SELECT * FROM kaytaru_sebebi";
					$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
					while($row = mysqli_fetch_array($result)){			
                        $sebep='';
						if($_SESSION['lang']=='rus')
							$sebep=$row['sebepterRU'];
						else
						 	$sebep=$row['sebepter'];
						$output .= '<option value = "'.$row["kod_kayt_sebeb"].'">' . $sebep . '</option>';				

					}
					return $output;
				}
			?>

			

			<h3 align = "center"><?=$oL::get('Оқытушы')?>:<?php echo " " . $engbek['lastname'] . " ". $engbek['firstname'] . " ". $engbek['patronymic'];?> <?=$oL::get('еңбегін тексеріп, растау')?></h3>

			
			<div class = "engbek">

				<form id="formconf"  method = "post">

					<table>

						<tr>

							<td><span>
								<strong>
									<?=$oL::get('Факультет атауы')?>:
								</strong>
							</td>
							<td><?php echo ($_SESSION['lang'] == 'rus') ? $engbek['facultyNameRU'] : $engbek['facultyNameKZ']; ?>
								</span>
							</td>
						</tr>

						<tr>

							<td>
								<span>
									<strong>
										<?=$oL::get('Кафедра атауы')?>:
									</strong>
								</td>
								<td>
									<?php echo ($_SESSION['lang'] == 'rus') ? $engbek['cafedraNameRU'] : $engbek['cafedraNameKZ']; ?>
								</span>
							</td>

						</tr>

						<tr>

							<td><span><strong><?=$oL::get('Аты-жөні')?>:</strong></td><td><?php echo $engbek['lastname'] . " " . $engbek['firstname'] . " " . $engbek['patronymic']; ?></span> </td>

						</tr>

						<tr>

							<td><span><strong><?=$oL::get('Көрсеткіш атауы')?>:</strong></td><td><?php echo ($_SESSION['lang'] == 'rus')? $engbek['korsetkish_ati2']: $engbek['korsetkish_ati']?></span></td>

						</tr>

						<tr>

							<td><span><strong><?=$oL::get('Еңбегі')?>:</strong></td><td><a target = "_blank" href = "<?php echo $engbek['file_ati']; ?>"><?php echo $engbek['file_ati']; ?></a></span></td>

						</tr>

						<tr>

							<td><span><strong><?=$oL::get('Еңбек санының түрлері')?>:</strong></td><td><?php echo $engbek['sani']; ?></span> </td>

						</tr>

						<tr>

							<td><span><strong><?=$oL::get('О университеті авторлар саны (Өзін қоса санағанда)')?>:</strong></td><td><?php echo $engbek['univ_avtor_san']; ?></span></td>

						</tr>

						<tr>
							<td>
								<span>
									<strong><?=$oL::get('Ескерту')?>:</strong>
								</td>
								<td>
									<?php echo $engbek['eskertu']; ?>
								</span>
							</td>
						</tr>
						<tr>

							<td>
								<span>
									<strong><?=$oL::get('Балл')?>:</strong>
								</td>
								<td>
									<?php echo $engbek['ball']; ?>
								</span>
								</td>
						</tr>
                          <tr>
						  <?php
								if ($showInput==54) {
									echo '<td><span><strong>Балл қосу хирша деңгейі 4-тен жоғары болған жайғдайда:</strong></td><td><input type="text" name="myInput"></span></td>';
									
								} else {
									echo '<input type="text" name="myInput" style="display: none;">';
								}
						   ?>
						   <?php
								if ($showInput==16) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else if ($showInput==17) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else if ($showInput==18) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else if ($showInput==19) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else if ($showInput==20) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else if ($showInput==21) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else if ($showInput==22) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else if ($showInput==23) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else if ($showInput==24) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else if ($showInput==25) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else if ($showInput==26) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else if ($showInput==27) {
									echo '<td><span><strong>Бас автор - 1 деп белгіленеді ары қарай ретімен қойылады максималды автор саны 7</strong></td><td><input type="text" name="myInputNum"></span></td>';
									
								}else {
									echo '<input type="text" name="myInputNum" style="display: none;">';
								}
						   ?>
			              </tr>
						<tr>

							<td><span><strong><?=$oL::get('Статус')?>:</strong> </span></td><td><select name = "status" id = "status" />

																					<?php echo load_status();?>

																				</select></td>

						</tr>

						<tr>

							<td><span><strong><?=$oL::get('Қайтару себебі')?>:</strong></span></td><td>	<select name = "kaytaru_sebebi" id = "kaytaru_sebebi" />

																							<?php echo load_sebep();?>

																						</select></td>

						</tr>

						<tr>

							<td><p style = "vertical-align: middle;"><strong><?=$oL::get('Резолюция')?>:</strong> </p></td><td><textarea cols = 50 rows = 10 name = "resolution" id = "resolution"></textarea></td>

						</tr>

						<input type = "hidden" name = "engbek_id" value = "<?php echo $engbek['engbekID']; ?>" />

						<input type = "hidden" name = "tutor_id" value = "<?php echo $engbek['TutorID']; ?>" />

						<input type = "hidden" name = "sani_simple" value = "<?php echo $engbek['sani']; ?>" />

						<input type = "hidden" name = "univ_avtor_san" value = "<?php echo $engbek['univ_avtor_san']; ?>" />

						<input type = "hidden" name = "tutor_moderator" value = "<?php echo $result['TutorID']; ?>" />
						

						<tr>

                                                        <!--<br>Деректер қоры жабылды! 01.06.2020 00:00<br/>-->

							<td></td>
							<td> 
								<input style = "width: 100px; height: 50px;" type = "submit" name = "confirmed" value = "<?=$oL::get('Растау')?>"> <span> <span><a href = "engbek_tekseru.php" style = "text-decoration: none; color: black;" class = "to_back"><?=$oL::get('Артқа қайту')?></a></td>

						</tr>

					</table>

				</form>

			</div>

		</div>

	</div>

	<div class = "footer">

	</div>

</body>
<script>
	$(document).ready(function() {
		// Listen for form submission
		$('#formconf').submit(function(event) {
			// Prevent the default form submission
			event.preventDefault();

			// Serialize form data
			var formData = $(this).serialize();

			// Explicitly add any additional fields if needed
			formData += '&confirmed=true';

			// Your AJAX request
			$.ajax({
				url: $(this).attr('action'),
				method: $(this).attr('method'),
				data: formData,
				dataType: "json", // Assuming your PHP script returns JSON
				success: function(response) {
					// Handle success response
					Swal.fire({
						icon: "success",
						title: response.message,
						showConfirmButton: true, // Allow users to close the alert
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {
					// Handle AJAX error
					console.error('AJAX Error:', textStatus, errorThrown);

					// Display a SweetAlert error message
					Swal.fire({
						title: ER_Locale.get('Қате'),
						text: ER_Locale.get('Оқытушы еңбегін балл қою кезінде қате пайда болды'),
						icon: 'error'
					});
				}
			});

			// Prevent the default form submission
			return false;
		});
	});

</script>
</html>