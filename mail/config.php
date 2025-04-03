<?php
	$db_host = "localhost";
	$db_user = "erbolat_root";
	$db_pass = "H0_fU7_NU3_Nww_N";
	$db = "erbolat_ip2024";
	
	$connection = mysqli_connect($db_host, $db_user, $db_pass);
    if (mysqli_connect_errno()) {
		printf("Serverde baylanys jok: %s\n", mysqli_connect_error());
	}
	    mysqli_select_db($connection,$db);
		mysqli_set_charset($connection, "utf8")
?>