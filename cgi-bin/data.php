<?php
		
	header('Content-Type: application/json;');
	
	define('db_host','localhost');
    	define('db_user','techuser');
    	define('db_pass','jfq17_');
    	define('db_name','techuser');

	
	$mysqli = new mysqli(db_host,db_user,db_pass,db_name);
	$mysqli->set_charset("utf8");
	
	if(!$mysqli){
		die("Connection failed: " . $mysqli->error);
	}
		
	$sql = sprintf("SELECT T1.FacultyID, T1.facultyNameKZ, T1.facultyNameRU,  (T1.typ1 + T1.typ2 + T1.typ3)/T1.shtat_sany AS avg_faculty
	FROM (SELECT
	  faculties.FacultyID,
	  faculties.facultyNameKZ, 
	  faculties.facultyNameRU, 
	  faculties.shtat_sany,
	  SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball ELSE 0 END) * 0.55 AS typ1,
	  SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball ELSE 0 END) * 0.35 AS typ2,
	  SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball ELSE 0 END) * 0.15 AS typ3
	FROM engbekter
	RIGHT JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
	left JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
	WHERE faculties.activ = 1 AND engbekter.del=0 
	GROUP BY faculties.facultyNameKZ) AS T1 ORDER by avg_faculty DESC");
	
	$result = $mysqli->query($sql);
	
	$data = array();
	
	foreach($result as $row){
	    if (isset($_GET['lang']) && $_GET['lang'] != 'kaz'){
	        $row['facultyNameKZ'] = $row['facultyNameRU'];
        }
		$data[] = $row;
	}
	
	$result->close();
	$mysqli->close();
	
	print json_encode($data);
	
?>