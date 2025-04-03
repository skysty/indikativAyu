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
     <!--css--->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"> 
	<link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css" rel="stylesheet">
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

			<hr />		


			<div class="accordion" id="accordionExample">
				<div class="accordion-item ">
					<h2 class="accordion-header" id="headingOne">
					<button class="accordion-button btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="border-color: red;">
					<?= $oL::get('Растаушылар') ?>
					</button>
					</h2>
					<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
					<div class="accordion-body">
					<table id="univ_data" class="table table-striped table-bordered" border="1">
							<thead>
								<tr>
									<th>№</th>
									<th><?= $oL::get('Жауапты растаушылар аты жөні')?></th>
									<th><?= $oL::get('Жүктелген енбектер саны')?></th>
									<th><?= $oL::get('Тексерілмеген')?></th>
									<th><?= $oL::get('Тексеріліп расталған')?></th>
									<th><?= $oL::get('Қайтарылған')?></th>
									<th><?= $oL::get('Тексерілген, бірақ расталмаған')?></th>
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
						<?= $oL::get('Оқытушы-профессорлар және ғылыми қызметкерлер жүктеген еңбектер саны')?>
					</button>
					</h2>
					<div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
					<div class="accordion-body">
					<table id="cafedra_data" class="table table-striped table-bordered" border="1">
							<thead>
								<tr>
									<th>№</th>
									<th><?= $oL::get('Факултет')?></th>
									<th><?= $oL::get('Кафедра')?></th>
									<th><?= $oL::get('Аты жөні')?></th>
									<th><?= $oL::get('Жүктелген енбектер саны')?></th>
									<th><?= $oL::get('Тексерілмеген')?></th>
									<th><?= $oL::get('Тексеріліп расталған')?></th>
									<th><?= $oL::get('Қайтарылған')?></th>
									<th><?= $oL::get('Тексерілген, бірақ расталмаған')?></th>
									<th><?= $oL::get('Толық көру')?></th>
								</tr>
							</thead>
							</tbody>
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

<?php include '../extensions/scripts_data.php'; ?>
</body>
</html>