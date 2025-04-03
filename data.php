<?php
		
	header('Content-Type: application/json;');
	
	define('db_host','localhost');
    	define('db_user','erbolat_root');
    	define('db_pass','H0_fU7_NU3_Nww_N');
    	define('db_name','erbolat_ip2024');

	
	$mysqli = new mysqli(db_host,db_user,db_pass,db_name);
	$mysqli->set_charset("utf8");
	
	if(!$mysqli){
		die("Connection failed: " . $mysqli->error);
	}
		
	$sql = sprintf("SELECT T1.*, 
	(T1.typ1 + T1.typ2 + T1.typ3 + T1.typ4) AS SumAllType, 
	(T1.typ1 + T1.typ2 + T1.typ3 + T1.typ4) / T1.shtat_sany AS avg_faculty
FROM (
 SELECT faculties.FacultyID,
		faculties.facultyNameKZ, 
		faculties.facultyNameTR, 
		faculties.shtat_sany,
		SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball ELSE 0 END) * 0.50 AS typ1,
		SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball ELSE 0 END) * 0.35 AS typ2,
		SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball ELSE 0 END) * 0.15 AS typ3,
		SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END) AS typ4
 FROM engbekter
 RIGHT JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
 LEFT JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
 WHERE faculties.activ = 1 AND engbekter.del=0 
 GROUP BY faculties.FacultyID, faculties.facultyNameKZ, faculties.facultyNameTR, faculties.shtat_sany
) AS T1
ORDER BY avg_faculty DESC");
	
	$result = $mysqli->query($sql);
	
	$data = array();
	
	foreach($result as $row){
	    if (isset($_GET['lang']) && $_GET['lang'] != 'kaz'){
	        $row['facultyNameKZ'] = $row['facultyNameTR'];
        }
		$data[] = $row;
	}
	
	$result->close();
	$mysqli->close();
	
	print json_encode($data);
	
?>