<?php
include('../incs/connect.php');
        session_start();
		$_SESSION['tutor'];
		$_SESSION['lang'];
		if(!isset($_SESSION['tutor'])){

			header('Location: ../login.php');
		}

        $c_sql = mysqli_query($connection,"SELECT T1.*,  (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4) AS sum_cafedra, (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4)/T1.shtat_sany AS avg_cafedra
        FROM (SELECT
          cafedras.cafedraID,
          cafedras.cafedraNameKZ, 
          cafedras.cafedraNameTR, 
          cafedras.shtat_sany,
          SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball  ELSE 0 END) * 0.50 AS typ1,
          SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball  ELSE 0 END) * 0.35 AS typ2,
          SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball  ELSE 0 END) * 0.10 AS typ3,
          SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END)  AS typ4
        FROM engbekter
        RIGHT JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
        LEFT JOIN faculties ON faculties.FacultyID = cafedras.FacultyID
        LEFT JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
        WHERE faculties.activ = 1 and cafedras.activ = 1
        GROUP BY cafedras.cafedraNameKZ) AS T1 ORDER by avg_cafedra DESC") or die(mysqli_error($connection));

    

        $data = array(); // Initialize an array to store the data

        // Loop through the results from $sql1
        $i = 0; // Start the index from 0
        while ($cafedra = mysqli_fetch_array($c_sql)) {
            $sTitle = ($_SESSION['lang'] != 'kaz' && isset($cafedra['cafedraNameTR']) && mb_strlen($cafedra['cafedraNameTR'])) ? $cafedra['cafedraNameTR'] : $cafedra['cafedraNameKZ'];

            $row = array(
                'index' => ++$i, // Increment index
                'sTitle' => $sTitle, // Assign sTitle here
                'shtat_sany' => $cafedra['shtat_sany'],
                'sum_cafedra' => sprintf("%.2f", $cafedra['sum_cafedra']),
                'avg_cafedra' => sprintf("%.2f", $cafedra['avg_cafedra']),
                'cafedraID' => $cafedra['cafedraID'],
                'link' => "tolyk_cafedra.php?ID=" . $cafedra['cafedraID']
            );
            $data[] = $row;
        } 

        // Output the JSON
        echo json_encode($data);

?>