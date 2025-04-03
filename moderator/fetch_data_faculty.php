<?php
include('../incs/connect.php');
        session_start();
		$_SESSION['tutor'];
		$_SESSION['lang'];
		if(!isset($_SESSION['tutor'])){

			header('Location: ../login.php');
		}

        $f_sql = mysqli_query($connection,"SELECT T1.*, 
        (T1.typ1 + T1.typ2 + T1.typ3+T1.typ4) AS SumAllType, 
        (T1.typ1 + T1.typ2 + T1.typ3+T1.typ4)/T1.shtat_sany AS avg_faculty
        FROM (SELECT
            faculties.FacultyID,
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
        WHERE faculties.activ = 1
        GROUP BY faculties.facultyNameKZ) AS T1 ORDER by avg_faculty DESC") or die(mysqli_error($connection));

    

        $data = array(); // Initialize an array to store the data

        // Loop through the results from $sql1
        $i = 0; // Start the index from 0
        while ($faculty = mysqli_fetch_array($f_sql)) {
            $sTitle = ($_SESSION['lang'] != 'kaz' && isset($faculty['facultyNameTR']) && mb_strlen($faculty['facultyNameTR'])) ? $faculty['facultyNameTR'] : $faculty['facultyNameKZ'];

            $row = array(
                'index' => ++$i, // Increment index
                'sTitle' =>$sTitle, // Assign sTitle here
                'shtat_sany' => $faculty['shtat_sany'],
                'sumAllType' => sprintf("%.2f", $faculty['SumAllType']),
                'avg_faculty' => sprintf("%.2f", $faculty['avg_faculty']),
                'facultyID' => $faculty['FacultyID'],
                'link' => "tolyk_faculty.php?ID=" . $faculty['FacultyID']
            );
            $data[] = $row;
        } 

        // Output the JSON
        echo json_encode($data);

?>