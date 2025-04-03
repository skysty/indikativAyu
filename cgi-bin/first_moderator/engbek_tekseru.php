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
	<title><?=$oL::get('Еңбектерді тексеру')?></title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/default.css" />
	<link rel="icon" type="image/png" href="../img/favicon.png" />

		<!-- Edit Below -->
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../css/animate.min.css"></script>
    	<link href='../css/animate.min.css' rel='stylesheet' type='text/css'>
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
										<script>
											$(document).ready(function(){
												$("#faculty").change(function(){
													var FacultyID = $(this).val();
													$.ajax({
														url:"fetch_engbek.php",
														method:"POST",
														data:{FacultyID:FacultyID},
														dataType:"text",
														success:function(data){															
														}
													});
												});
												$("#status").change(function(){
													$(".tables").css("margin-top", "400px");
													var statusID = $(this).val();
													$.ajax({
														url:"fetch_engbek.php",
														method:"POST",
														data:{statusID:statusID},
														dataType:"text",
														success:function(data){
															FacultyID_var();
														}
													});
												});												
												
												var TutorID;
												var FacultyID;
												var statusID;
												function FacultyID_var(){
													var listEnbek;
													FacultyID = $( "#faculty option:selected" ).val();
													statusID = $( "#status option:selected" ).val();
													$.ajax({
														url:"fetch_engbek.php",
														method:"POST",
														data:{FacultyID:FacultyID,statusID:statusID},
														dataType:"text",
														success:function(data){
															$("#engbek").html(data);
															//FacultyID_var();
														}
													});
												}
												
										/*	---------------------------------------------------------------  */	
											
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
														url:"get_engbek2.php",
														method:"POST",
														data:{TutorID:TutorID},
														dataType:"text",
														success:function(data){
															//$("#engbek").html(data);
														}
													});
												});
												$("#status2").change(function(){
													$(".tables").css("margin-top", "650px");
													var statusID = $(this).val();
													$.ajax({
														url:"get_engbek2.php",
														method:"POST",
														data:{statusID:statusID},
														dataType:"text",
														success:function(data){
															TutorID_var();
														}
													});
												}); 
												
												function TutorID_var(){
													var listEnbek;
													TutorID = $( "#tutor option:selected" ).val();
													statusID = $( "#status2 option:selected" ).val();
													$.ajax({
														url:"get_engbek2.php",
														method:"POST",
														data:{TutorID:TutorID,statusID:statusID},
														dataType:"text",
														success:function(data){
															$("#engbek").html(data);
														}
														
													});
												}
												
											});
										</script>
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
										</select><br><br>
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
							$facul='';
							if($_SESSION['lang'] == 'rus'){
							    $facul=$row['facultyNameRU'];	
							}else{
							    $facul=$row['facultyNameKZ'];	
							}	
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
							$statuss='';
							if($_SESSION['lang']=='rus')
								$statuss=$row['status_nameRu'];	
							else
								$statuss=$row['status_name'];		
							$output .= '<option value = "'.$row["statusID"].'">' . $statuss . '</option>';				
						}
						return $output;
					}
				?>
				<div class = "tables">
					<div name = "engbek" id = "engbek">
					
					</div>
				</div>
			</div>			
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>