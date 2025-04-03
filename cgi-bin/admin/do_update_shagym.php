<body>
<p>Worked</p>	
	<?php
		include('../incs/connect.php');
		
		$tutor_id = $_POST['tutor_id'];
		$shagym_id = $_POST['shagym_id'];
		$jauap = $_POST['jauap'];
		$jauap_kuni = $_POST['save_date'];
		
		if(isset($_POST['checked'])){
			echo $jauap_kuni;
			$sql = mysqli_query("UPDATE shagymdar SET kod_kizm = '$tutor_id', jauap = '$jauap', jauap_kuni = '$jauap_kuni', checked = '1' WHERE shagymID = '$shagym_id'") or die(mysql_error());
			header('Location: show_answer_shagym.php');
		} else {
			echo "Бір қате бар";
		}
	?>
</body>
