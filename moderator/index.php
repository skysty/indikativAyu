<html>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>

	<?php
        error_reporting(E_ALL); 
		ini_set('display_errors', 1);
		include('../incs/connect.php');

		

		session_start();
		$_SESSION['tutor'];
		$_SESSION['lang'];
		if(!isset($_SESSION['tutor'])){

			header('Location: ../login.php');

		}

	?>
	<title><?= $oL::get('Басты бет')?></title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<link rel="icon" type="image/png" href="../img/favicon.png" />
  <link rel="stylesheet" href="../css/styles.min.css" />
  <script type = "text/javascript" src = "../dataTables/jquery-3.7.1.min.js"></script>
        <script type="text/javascript">
        /* <![CDATA[ */
        /* Locale for JS */
        <?php require_once '../locale/jslocale.php'; ?>
        /* ]]> */
    	</script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> 
    				<!--DataTables-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>   
	<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>  
	<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>             
   <!--DataTables-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <!--css--->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"> 
	<link href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css" rel="stylesheet">
	<!--bootstap 5.3.0-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<!--css--->
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
	<script type = "text/javascript" src = "../chartjs/js/app.js"></script>

	<style>
		.content_wrapper{
			width: 1050px;
			margin: 0 auto;
		}
		.univer_table{
			display: block;
			margin: 10px;
			width: 500px;
			float:left;
		}
		.faculty_table{
			margin: 10px;
			width: 500px;
			float:left;
		}
		.cafedra_table{
			display:block;
		}
		table {
			border-collapse: collapse;
			border:1px black solid;
			width: 100%;
			font-size: 12px;
		}
		a{
			color: blue;
			text-decoration:none;
		}
		a:hover{
			color: red;
			text-decoration:underline;
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
		#chart_container{
			width: 1300px;
			height: 520px;
			display: flex;
		}
		
		.custom-outline {
			border-color: blue; /* Change to the desired outline color */
		}
	</style>

</head>

<body>
	<div class = "upper_header">
        <?php include '../extensions/header.php'?>
	</div><br />
	<div class = "header">	

	<div id = "menu_nav">
		<?php include '../extensions/nav.php'; ?>
	</div>

	</div>

	<div class = "content">
		<div class = "content_wrapper">					
			<?php

				$Login=$_SESSION['tutor'];

				$query = mysqli_query($connection,"SELECT * FROM tutors WHERE mail = '$Login'") or die(mysqli_error());

				$tut = mysqli_fetch_array($query);
				$sLastName = $tut['lastname'];
				$sFirstName = $tut['firstname'];
				$sPatronymic = $tut['patronymic'];
				$roleID=$tut['roleID'];
				if ($_SESSION['lang'] != 'kaz'){
                    $sLastName = isset($tut['lastnameTR']) && mb_strlen($tut['lastnameTR']) ? $tut['lastnameTR'] : $tut['lastname'];
                    $sFirstName = isset($tut['firstnameTR']) && mb_strlen($tut['firstnameTR']) ? $tut['firstnameTR'] : $tut['firstname'];
                    $sPatronymic = isset($tut['patronymicTR']) && mb_strlen($tut['patronymicTR']) ? $tut['patronymicTR'] : $tut['patronymic'];
                }
                $roleName = '';
				if($_SESSION['roleID'] == 1){
					$roleName = $oL::get('Оқытушы');
				} else if($_SESSION['roleID'] == 2){
					$roleName = $oL::get('Администратор');
				} else if($_SESSION['roleID'] == 3){
					$roleName = $oL::get('Модератор');
				} else if($_SESSION['roleID'] == 4){
					$roleName = $oL::get('Кафедра меңгерушісі');
				} else if($_SESSION['roleID'] == 5){
					$roleName = $oL::get('Декан');
				} else if($_SESSION['roleID'] == 6){
					$roleName = $oL::get('Бас модератор');
				}

				echo "<h2 style = 'color:#0094aa'>".$roleName.": " . $sLastName ." ". $sFirstName ." ". $sPatronymic . "</h2>";
				?>

			<hr />		
			<h1 style = "text-align: center; color: red"><?= $oL::get('Ағымдағы рейтинг 2023-2024')?></h1><hr />
			<h2 align = 'center' style = "color: #0094de"><?= $oL::get('Факультеттер рейтингі')?></h2>
			<div id = "chart_container">

				<canvas id = "mycanvas"></canvas>

			</div>	


			<div class = "univer_table">

				<?php

				//###########################################univer table display###############################################

					$sql3 = mysqli_query($connection, "SELECT engbekter.kod_fakul, 
						SUM(engbekter.ball) AS sum_univer FROM engbekter 
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul") or die(mysqli_error($connection));		
					$univer = mysqli_fetch_array($sql3);
					$sql4 = mysqli_query($connection,"SELECT engbekter.kod_fakul, 
						SUM(engbekter.ball)*0.50 AS sum_univer_gylym, 
						korsetkishter.typeID FROM engbekter 
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
						WHERE korsetkishter.typeID = 1") or die(mysqli_error($connection));
					$univer2 = mysqli_fetch_array($sql4);

					

					$sql5 = mysqli_query($connection, "SELECT 
						engbekter.kod_fakul, 
						SUM(engbekter.ball)*0.35 AS sum_univer_oku, 
						korsetkishter.typeID FROM engbekter 
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
						WHERE korsetkishter.typeID = 2") or die(mysqli_error($connection));
					$univer3 = mysqli_fetch_array($sql5);
					$sql6 = mysqli_query($connection, "SELECT engbekter.kod_fakul, 
						SUM(engbekter.ball)*0.15 AS sum_univer_tarbie, 
						korsetkishter.typeID FROM engbekter 
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
						WHERE korsetkishter.typeID = 3") or die(mysqli_error($connection));
					$univer4 = mysqli_fetch_array($sql6);

					$sql7 = mysqli_query($connection, "SELECT 
						engbekter.kod_fakul, 
						SUM(engbekter.ball) AS sum_baska, 
						korsetkishter.typeID FROM engbekter 
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
						WHERE  korsetkishter.typeID = 5") or die(mysqli_error($connection));
					$univer5 = mysqli_fetch_array($sql7);

					$a = array($univer4['sum_univer_tarbie'],$univer2['sum_univer_gylym'],$univer3['sum_univer_oku'],$univer5['sum_baska']);

					$univ = array_sum($a);

				?>

				<h3 align = 'center' style = "color: #0094de"><?= $oL::get('Университет бойынша')?></h3>

				<table id ="univer_t" class="table table-striped table-bordered" border="1">
					<thead>
						<tr>
							<th><?= $oL::get('Штат саны') ?></th>
							<th><?= $oL::get('Ғылым') ?></th>
							<th><?= $oL::get('Академиялық') ?></th>
							<th><?= $oL::get('Әлеуметтік-мәдени') ?></th>
							<th><?= $oL::get('Жалпы балл') ?></th>
							<th><?= $oL::get('Орта балл') ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div>
									<?php
										$result= mysqli_query($connection, "SELECT shtat_sani FROM jildar WHERE id_jildar= '1'");
										$shtat_sani = null;
										while($row = mysqli_fetch_array($result)){
											$shtat_sani = $row['shtat_sani'];
											echo $shtat_sani;
										}
									?>
								</div>
							</td>
							<td><?php echo sprintf("%.2f",$univer2['sum_univer_gylym']);?></td>
							<td><?php echo sprintf("%.2f",$univer3['sum_univer_oku']);?></td>
							<td><?php echo sprintf("%.2f",$univer4['sum_univer_tarbie']);?></td>
							<td><?php echo sprintf("%.2f",$univ);?></td>
							<td><?php global $shtat_sani; $avg = ($univ)/$shtat_sani; echo sprintf("%.2f",$avg);?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class = "faculty_table">
				<h3 align = 'center' style = "color: #0094de"><?= $oL::get('Факультеттер')?></h3>
				<table id="faculty_data" class="table table-striped table-bordered" border="1">
				<thead>
								<tr>
									<th>№</th>
									<th><?= $oL::get('Факультет атауы')?></th>
									<th><?= $oL::get('Штат саны')?></th>
									<th><?= $oL::get('Жалпы балл')?></th>
									<th><?= $oL::get('Орта балл')?></th>
									<th><?= $oL::get('Толық көру')?></th>
								</tr>
							</thead>
							
					<tbody>
					</tbody>
				</table>							
			</div>
			<div class="accordion" id="accordionExample">
				<div class="accordion-item ">
					<h2 class="accordion-header" id="headingOne">
					<button class="accordion-button btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="border-color: red;">
					<?= $oL::get('Оқытушы-профессорлар және ғылыми қызметкерлер рейтингі') ?>
					</button>
					</h2>
					<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
					<div class="accordion-body">
					<table id="univ_data" class="table table-striped table-bordered" border="1">
							<thead>
								<tr>
									<th>№</th>
									<th><?= $oL::get('Аты жөні')?></th>
									<th style="display: none;"><?= $oL::get('Ғылым бағыты')?></th>
									<th style="display: none;"><?= $oL::get('Академиялық бағыт')?></th>
									<th style="display: none;"><?= $oL::get('Әлеуметтік-мәдени бағыт')?></th>
									<th style="display: none;"><?= $oL::get('Қосылып алынған балл')?></th>
									<th><?= $oL::get('Жалпы балл')?></th>
									<th><?= $oL::get('Толық көру')?></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingTwo">
					<button class="accordion-button collapsed btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						<?= $oL::get('Кафедралар')?>
					</button>
					</h2>
					<div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
					<div class="accordion-body">
					<table id="cafedra_data" class="table table-striped table-bordered" border="1">
							<thead>
								<tr>
									<th>№</th>
									<th><?= $oL::get('Кафедра атауы')?></th>
									<th><?= $oL::get('Штат саны')?></th>
									<th><?= $oL::get('Жалпы балл')?></th>
									<th><?= $oL::get('Орта балл')?></th>
									<th><?= $oL::get('Толық көру')?></th>
								</tr>
							</thead>
							</tbody>
							</tbody>
					</table>
					</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingThree" style = "color: #0094de">
					<button class="accordion-button collapsed btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							<?= $oL::get('Ғылыми зерттеу институттары')?>
					</button>
					</h2>
					<div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
					<div class="accordion-body">
					<table id="institution_data" class="table table-striped table-bordered" border="1">
					<thead>
						<tr>
							<th>№</th>
							<th><?= $oL::get('Орталық атауы')?></th>
							<th><?= $oL::get('Штат саны')?></th>
							<th><?= $oL::get('Жалпы балл')?></th>
							<th><?= $oL::get('Орта балл')?></th>
							<th><?= $oL::get('Толық көру')?></th>
						</tr>
					<thead>
					<tbody>
					</tbody>
				</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class = "footer">
	</div>
	<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

	

<script>

	function HtmlTOExcel(type, fun, dl) {

    var elt = document.getElementById('univ_data');

    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });

    return dl ?

        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :

        XLSX.writeFile(wb, fun || ('tutor-recored.' + (type || 'xlsx')));

}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<?php include '../extensions/scripts_datatables.php'; ?>
</body>
</html>