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
			.enbekData{
				margin-top: 450px;
			}
			#enbekData {
            	display: none; /* Initially hide the table */
				
        	}
			.inner_content {
				width: 1400px;
				margin: 0 auto;
		     /* Add horizontal scrollbar if content overflows */
				}
				/* Center the labels for the tabs */
			.tabs label {
			display: inline-block; /* Set display to inline-block */
			text-align: center; /* Center the text */
			padding: 10px 20px;
			background-color: #f2f2f2;
			cursor: pointer;
			border-radius: 5px 5px 0 0;
			}

			/* Center the tabs container */
			.main {
			text-align: center;
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
		<div class = "content_wrapper">
			<div class = "inner_content">
				<h2 style = "text-align: center;"><?=$oL::get('Еңбектерді тексеру')?></h2>
				<div class="select_box" style="width: 100%; padding:0px; border: none;">
						<div class="main">
							<ul class="tabs">
								<li>
									<input type="radio" checked name="tabs" id="tab1">
									<label for="tab1"><?=$oL::get('Толық тізімді тексеру')?></label>
									<div id="tab-content1" class="tab-content animated fadeIn">
										<div class="select_box">
											<form id="filterForm1">
												<?=$oL::get('Факультет')?>:
												<select name="faculty" id="faculty">
													<option value=""><?=$oL::get('Факультетті таңдаңыз')?></option>
													<?php echo load_faculty(); ?>
												</select><br><br>
												<?=$oL::get('Cтатус')?>:
												<select name="status" id="status">
													<option value=""><?=$oL::get('Cтатусты таңдаңыз')?></option>
													<?php echo load_status(); ?>
												</select>
												<br><br>
												<button type="submit"><?=$oL::get('Сүзгілеу')?></button>
											</form>
										</div>
									</div>
								</li>
								<li>
									<!--<input type="radio" name="tabs" id="tab2">
									<label for="tab2">Specific Tutor's Contributions Check</label>-->
									<div id="tab-content2" class="tab-content animated fadeIn">
										<div class="select_box">
											<form id="filterForm2">
												<?=$oL::get('Факультет')?>:
												<select name="faculty1" id="faculty1">
													<option value=""><?=$oL::get('Факультетті таңдаңыз')?></option>
													<!-- Populate options dynamically -->
												</select><br><br>
												<?=$oL::get('Кафедра')?>:
												<select name="cafedra" id="cafedra">
													<option value="">Select Department or Research Institute</option>
													<!-- Populate options dynamically -->
												</select><br><br>
												Tutor or Researcher:
												<select name="tutor" id="tutor">
													<option value="">Select Tutor or Researcher</option>
													<!-- Populate options dynamically -->
												</select><br><br>
												Status:
												<select name="status2" id="status2">
													<option value="">---</option>
													<!-- Populate options dynamically -->
												</select>
												<br><br>
												<button type="submit">Apply Filter</button>
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
			    <div class="enbekData">
					<table id="enbekTable" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th></th>
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
		$(document).ready(function () {
			// Function to handle form submission and update DataTable
			function handleFormSubmit(formId, url) {
				$(formId).submit(function (e) {
					e.preventDefault();
					$.ajax({
						type: 'POST',
						url: url,
						data: $(this).serialize(),
						dataType: 'json', // Specify JSON data type
						success: function (response) {
							var data = response.data; // Extract the data array from the response
							if (data.length > 0) {
								table.clear().rows.add(data).draw(); // Update DataTable with filtered data
							} else {
								// Clear the table and display custom message if no data available
								table.clear().draw();
								table.rows.add([]).draw();
							}
							$('#enbekTable').show(); // Show the table once data is loaded or message displayed
						}
					});
				});
			}
            function format(d) {
				return (
					'<dl>' +
					'<dt>Резолюция:</dt>' +
					'<dd>' +
					d.rez +
					'</dd>' +
					'</dl>'
				);
			}
			// Initialize DataTable with pagination and custom message for empty table
			var table = $('#enbekTable').DataTable({
				"columns": [
					{
                    "className": 'dt-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                	},
					{ "data": "ind" },
					{ "data": "cafedra" },
					{ "data": "fullname" },
					{ "data": "korsetkish" },
					{ "data": "sani" },
					{ "data": "univavtorsan" },
					{ "data": "fileLink",
					"render":function(data, type, row){
						return '<a href="' + row.fileLink + '" target="_blank">' + row.fileLink + '></a>';
					} 
					},
					{ "data": "ball" },
					{ "data": "kayt_sebeb" },
					{ "data": "status" },
					{ "data": "link",
					"render":function(data, type, row){
						return '<a href="' + row.link + '"><?= $oL::get('Толығырақ')?></a>';
					} 
				}
				],
				order: [[1, 'asc']],
				"language": {
					"url": 'languages/' + ER_Locale.lang + '.json',
					"emptyTable": ER_Locale.get('Кестеде деректер жоқ')
				},
					"initComplete": function () {
					var table = this.api();

					// Event listener for opening row
					$('#enbekTable tbody').on('click', 'td.dt-control', function () {
						var tr = $(this).closest('tr');
						var row = table.row(tr);
					
						if (row.child.isShown()) {
							// This row is already open - close it
							row.child.hide();
						}
						else {
							// Open this row
							row.child(format(row.data())).show();
						}
					});
				}
			});

			// Handle form submission for filterForm1
			handleFormSubmit("#filterForm1", "fetch_engbek.php");

			// Check if there are saved filter values in the localStorage
			var savedFaculty = sessionStorage.getItem("FacultyID");
			var savedStatus = sessionStorage.getItem("statusID");

			// Set the saved filter values in the form
			if (savedFaculty !== null) {
				$('#faculty').val(savedFaculty);
			}
			if (savedStatus !== null) {
				$('#status').val(savedStatus);
			}
			console.log("Saved Faculty:", savedFaculty);
			console.log("Saved Status:", savedStatus);
			// Submit the form automatically to fetch data if there are saved filter values
			 // Save filter values to localStorage when the form is submitted
			 $("#filterForm1").submit(function () {
				sessionStorage.setItem("FacultyID", $('#faculty').val());
				sessionStorage.setItem("statusID", $('#status').val());
			});
			// Trigger form submission when filter values change
				$('#faculty, #status').change(function () {
				$("#filterForm1").submit();
			});
			// Submit the form automatically if there are saved filter values
				if (savedFaculty !== null || savedStatus !== null) {
				$("#filterForm1").submit();
			}
			// Function to clear sessionStorage after a period of inactivity
			var inactivityTimeout = 5 * 60 * 1000; // 5 minutes in milliseconds

			var resetTimer = function() {
				clearTimeout(timer);
				timer = setTimeout(function() {
					sessionStorage.clear();
				}, inactivityTimeout);
			};

			var timer = setTimeout(function() {
				sessionStorage.clear();
			}, inactivityTimeout);

			// Reset timer on user activity
			$(document).on('mousemove keypress', resetTimer);
		});

	</script>
</body>
</html>