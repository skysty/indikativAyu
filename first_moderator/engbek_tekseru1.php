<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
	<?php
		session_start();
		$_SESSION['tutor'];
		include('../incs/connect.php');
		$_SESSION['lang'];
		if(!isset($_SESSION['tutor'])){
			header('Location: ../login.php');
		}
	?>
	<title><?=$oL::get('Еңбектерді тексеру')?></title>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script type="text/javascript">
        /* <![CDATA[ */
        /* Locale for JS */
        <?php require_once '../locale/jslocale.php'; ?>
        /* ]]> */
    	</script>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/default.css" />
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.2/sweetalert2.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
		<style type="text/css">
	      .tabs input[type=radio] {
	          top: -9999px;
	          left: -9999px;
	      }
	      .tabs {
	        width: 940px;
	        float: none;
	        list-style: none;
	        position: relative;
	        padding: 0;
	        margin: 0 auto;
	      }
	      .tabs li{
	        float: left;
	      }
	      .tabs label {
	          display: block;
	          padding: 10px 20px;
	          border-radius: 2px 2px 0 0;
	          color: #08C;
	          background: rgba(255,255,255,0.2);
	          cursor: pointer;
	          position: relative;
	          top: 3px;
	          -webkit-transition: all 0.2s ease-in-out;
	          -moz-transition: all 0.2s ease-in-out;
	          -o-transition: all 0.2s ease-in-out;
	          transition: all 0.2s ease-in-out;
	      }
	      .tabs label:hover {
	        background: rgba(255,255,255,0.5);
	        top: 0;
	      }
	      
	      [id^=tab]:checked + label {
	        background: #003366;
	        color: white;
	        top: 0;
	      }
	      
	      [id^=tab]:checked ~ [id^=tab-content] {
	          display: block;
	      }
	      .tab-content{
	        z-index: 2;
	        display: none;
	        text-align: left;
	        width: 100%;
	        font-size: 20px;
	        line-height: 140%;
	        padding-top: 10px;
	        padding: 15px;
	        position: absolute;
	        top: 53px;
	        left: 0;
	        box-sizing: border-box;
	        -webkit-animation-duration: 0.5s;
	        -o-animation-duration: 0.5s;
	        -moz-animation-duration: 0.5s;
	        animation-duration: 0.5s;
	      }
		  
		.select_box{
			width: 600px;
			padding: 20px;
			margin: 0 auto;
			margin-bottom: 30px;
			border: 1px black solid;
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			background: #eee;
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
			.tables{
				margin-top: 400px;				
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
			<div class = "inner_content" style = "width: 1000px; margin: 0 auto;">
				<h2 style = "text-align: center;"><?=$oL::get('Еңбектерді тексеру')?></h2>
				<div class = "select_box" style = "width: 100%; padding:0px; border: none;">
					<div class="main">
						<ul class="tabs">
							<li>
							  <input type="radio" checked name="tabs" id="tab1">
							  <label for="tab1"><?=$oL::get('Толық тізім бойынша тексеру')?></label>
							  <div id="tab-content1" class="tab-content animated fadeIn">
								<div class = "select_box">
									<form method = "post" action = "" style = "margin-top: 10px;">
										<?=$oL::get('Факультет немесе ҒЗО')?>
										<select name = "faculty" id = "faculty">
											<option value = ""><?=$oL::get('Факультетті немесе ҒЗО-ны таңдаңыз')?></option>
												<?php echo load_faculty(); ?>
										</select><br><br>
										<?=$oL::get('Статус')?>
										<select name = "status" id = "status">
											<option value = ""><?=$oL::get('Статусты таңдаңыз')?></option>
												<?php echo load_status(); ?>
										</select>						
									</form>
								</div>	
							  </div>
							</li>
							<li>
							  <input type="radio" name="tabs" id="tab2">
							  <label for="tab2"><?=$oL::get('Нақты оқытушының еңбектерін тексеру')?></label>
							  <div id="tab-content2" class="tab-content animated fadeIn">												
								<div class = "select_box">
									<form method = "post" action = "" style = "margin-top: 10px;">
										<?=$oL::get('Факультет немесе ҒЗО')?>
										<select name = "faculty1" id = "faculty1">
											<option value = ""><?=$oL::get('Факультетті немесе ҒЗО-ны таңдаңыз')?></option>
												<?php echo load_faculty(); ?>
										</select><br><br>
										<?=$oL::get('Кафедра немесе ҒЗИ')?>
										<select name = "cafedra" id = "cafedra">
											<option value = ""><?=$oL::get('Кафедраны немесе ҒЗИ-ды таңдаңыз')?></option>
												
										</select><br><br>
										<?=$oL::get('Оқытушы немесе ғылыми қызметкер')?>
										<select name = "tutor" id = "tutor">
											<option value = ""><?=$oL::get('Оқытушыны немесе ғылыми қызметкерді таңдаңыз')?></option>
												
										</select><br><br>
										<?=$oL::get('Статус')?>
										<select name = "status2" id = "status2">
											<option value = "">---</option>
												<?php echo load_status(); ?>
										</select>
										<br><br>
									</form>
								</div>
							  </div>
							</li>
						</ul>
					</div>
				</div>			
				<?php
					function load_faculty(){
						global $connection;
						$output = '';
						$sql = "SELECT * FROM faculties";
						$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
						
						while($row = mysqli_fetch_array($result)){	
							$facul = ($_SESSION['lang'] != 'kaz' && isset($row['facultyNameTR']) && mb_strlen($row['facultyNameTR'])) ? $row['facultyNameTR'] : $row['facultyNameKZ'];
							$output .= '<option value = "'.$row["FacultyID"].'">' . $facul . '</option>';				
						}
						return $output;
					}
					
					function load_status(){
						global $connection;
						$output = '';
						$sql = "SELECT * FROM status";
						$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
						
						while($row = mysqli_fetch_array($result)){
							$statuss =($_SESSION['lang']!='kaz' && isset($row['status_nameTR']) && mb_strlen($row['status_nameTR'])) ? $row['status_nameTR'] : $row['status_name'];	
							$output .= '<option value = "'.$row["statusID"].'">' . $statuss . '</option>';				
						}
						return $output;
					}
				?>
				<div class = "tables">
					<div name = "engbek" id = "engbek">
					<table id="enbekTable" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>№</th>
								<th><?= $oL::get('Кафедра атауы')?></th>
								<th><?= $oL::get('Аты жөні')?></th>
								<th><?= $oL::get('Көрсеткіш')?></th>
								<th><?= $oL::get('Саны')?></th>
								<th><?= $oL::get('Автор саны')?></th>
								<th><?= $oL::get('Файл аты')?></th>
								<th><?= $oL::get('Балл')?></th>
								<th><?= $oL::get('Қайтару себебі')?></th>
								<th><?= $oL::get('Статус')?></th>
								<th><?= $oL::get('Толығырақ')?></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
				</table>
					</div>
				</div>
			</div>			
		</div>
	</div>
	<div class = "footer">
	</div>
	<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- SweetAlert JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.2/sweetalert2.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
<script>
		$(document).ready(function(){
			// Variables to store IDs
			var TutorID, FacultyID, statusID;
			var dataTableInitialized = false; // Flag to track DataTable initialization

			// Function to initialize DataTable
			function initializeDataTable() {
				// DataTable initialization
				$('#enbekTable').DataTable({
					"columns": [
						{ "data": "index" },
						{ "data": "cafedra" },
						{ "data": "fullname" },
						{ "data": "korsetkish" },
						{ "data": "sani" },
						{ "data": "univ_avtor_san" },
						{ "data": "fileLink" },
						{ "data": "ball" },
						{ "data": "kayt_sebeb" },
						{ "data": "status" }
					]
				});
			}

			// Function to handle Faculty dropdown change
			$("#faculty").change(function(){
				FacultyID = $(this).val();
				$.ajax({
					url: "fetch_engbek.php",
					method: "POST",
					data: { FacultyID: FacultyID },
					dataType: "json",
					success: function(data) {
						if (!dataTableInitialized) {
							initializeDataTable();
							dataTableInitialized = true;
						}
					}
				});
			});

			// Function to handle Status dropdown change
			$("#status").change(function(){
				$(".tables").css("margin-top", "400px");
				statusID = $(this).val();
				$.ajax({
					url: "fetch_engbek.php",
					method: "POST",
					data: { statusID: statusID },
					dataType: "json",
					success: function(data) {
						if (!dataTableInitialized) {
							initializeDataTable();
							dataTableInitialized = true;
						}
					}
				});
			});

			// Function to handle Faculty1 dropdown change
			$("#faculty1").change(function(){
				var FacultyID = $(this).val();
				$.ajax({
					url: "get_cafedraData.php",
					method: "POST",
					data: { FacultyID: FacultyID },
					dataType: "json", // Expect JSON response
					success: function(data) {
						// Clear existing options
						$("#cafedra").empty();

						// Append options for each item in the JSON array
						data.forEach(function(item) {
							$("#cafedra").append("<option value='" + item.cafedraId + "'>" + item.cafedraName + "</option>");
						});
					},
					error: function(xhr, status, error) {
						console.error("AJAX request failed:", status, error);
					}
				});
			});

			// Function to handle Cafedra dropdown change
			$("#cafedra").change(function(){
				var cafedraID = $(this).val();
				$.ajax({
					url: "get_tutorData.php",
					method: "POST",
					data: { cafedraID: cafedraID },
					dataType: "json",
					success: function(data) {
						$("#tutor").empty();
					// Append options for each item in the JSON array
						data.forEach(function(itemq) {
							$("#tutor").append("<option value='" + itemq.tutorId + "'>" + itemq.fullname + "</option>");
						});
					},
					error: function(xhr, status, error) {
						console.error("AJAX request failed:", status, error);
					}
				});
			});

			// Function to handle Tutor dropdown change
			$("#tutor").change(function(){
				TutorID = $(this).val();
				$.ajax({
					url: "get_engbek2.php",
					method: "POST",
					data: { TutorID: TutorID },
					dataType: "text",
					success: function(data) {
						// Process data if needed
					}
				});
			});

			// Function to handle Status2 dropdown change
			$("#status2").change(function(){
				$(".tables").css("margin-top", "650px");
				statusID = $(this).val();
				$.ajax({
					url: "get_engbek2.php",
					method: "POST",
					data: { statusID: statusID },
					dataType: "text",
					success: function(data) {
						// Process data if needed
					}
				});
			});
		});
	</script>
</body>
</html>