<?php
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "7GAax6A4VJZ7XrqL";
	$db = "indikativ_2021";
	
	$connection = mysqli_connect($db_host, $db_user, $db_pass);
    if (mysqli_connect_errno()) {
		printf("Serverde baylanys jok: %s\n", mysqli_connect_error());
	}
	    mysqli_select_db($connection,$db);
		mysqli_set_charset($connection, "utf8")
?>