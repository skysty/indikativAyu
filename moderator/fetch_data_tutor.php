<?php
include('../incs/connect.php');
        session_start();
		$_SESSION['tutor'];
		$_SESSION['lang'];
		if(!isset($_SESSION['tutor'])){

			header('Location: ../login.php');
		}
    $sql1 = mysqli_query($connection, "SELECT T1.*, (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4) AS sum_val
    FROM (SELECT
            tutors.TutorID,
            tutors.RATE, 
            tutors.job_titleID,
            tutors.lastname, 
            tutors.lastnameTR, 
            engbekter.kod_kizm,
            tutors.firstname,
            tutors.firstnameTR,
        SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball ELSE 0 END) * 0.50 AS typ1,
        SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball ELSE 0 END) * 0.35 AS typ2,
        SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball ELSE 0 END) * 0.15 AS typ3,
        SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END)  AS typ4
    FROM engbekter
    LEFT JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
    LEFT JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
    WHERE tutors.deleted=0 AND tutors.RATE IN(1,2,3) AND  korsetkishter.bolimderID IN(1)
    GROUP BY tutors.lastname, tutors.firstname) AS T1 ORDER by sum_val DESC") or die(mysqli_error($connection));

    

    $sql_tuts = mysqli_query($connection, "SELECT 
        tutors.RATE,
        tutors.job_titleID, 
        tutors.lastname, 
        tutors.lastnameTR, 
        tutors.TutorID, 
        engbekter.kod_kizm, 
        tutors.firstname, 
        tutors.firstnameTR,
        0 AS typ1,
        0 AS typ2,
        0 AS typ3,
        0 AS typ4,
        SUM(engbekter.ball) AS sum_val FROM engbekter 
    RIGHT JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
    WHERE tutors.deleted=0 AND tutors.RATE IN(1,2,3) AND engbekter.kod_kizm IS NULL
    GROUP BY tutors.lastname, tutors.firstname ORDER BY sum_val DESC") or die(mysqli_error($connection));

    $data = array(); // Initialize an array to store the data

    // Loop through the results from $sql1
    $i = 0;
    while($tutor = mysqli_fetch_array($sql1)) {
        $row = array(
            'index'=>++$i,
            'lastName' => $_SESSION['lang'] != 'kaz' ? ($tutor['lastnameTR'] ?: $tutor['lastname']) : $tutor['lastname'],
            'firstName' => $_SESSION['lang'] != 'kaz' ? ($tutor['firstnameTR'] ?: $tutor['firstname']) : $tutor['firstname'],
            'typ1' => $tutor['typ1'],
            'typ2' => $tutor['typ2'],
            'typ3' => $tutor['typ3'],
            'typ4' => $tutor['typ4'],
            'sum_val' => sprintf("%.2f", $tutor['sum_val']),
            'tutorID' => $tutor['TutorID'],
            'link' => "tolyk.php?ID=" . $tutor['TutorID']
        );
        $data[] = $row;
    }
    // Loop through the results from $sql_tuts
    while($tutor2 = mysqli_fetch_array($sql_tuts)) {
        $row = array(
            'index'=>++$i,
            'lastName' => $_SESSION['lang'] != 'kaz' ? ($tutor2['lastnameTR'] ?: $tutor2['lastname']) : $tutor2['lastname'],
            'firstName' => $_SESSION['lang'] != 'kaz' ? ($tutor2['firstnameTR'] ?: $tutor2['firstname']) : $tutor2['firstname'],
            'typ1' => $tutor2['typ1'],
            'typ2' => $tutor2['typ2'],
            'typ3' => $tutor2['typ3'],
            'typ4' => $tutor2['typ4'],
            'sum_val' => sprintf("%.2f", $tutor2['sum_val']),
            'tutorID' => $tutor2['TutorID'],
            'link' => "tolyk.php?ID=" . $tutor2['TutorID']
        );
        $data[] = $row;
    }

    // Output the JSON
    echo json_encode($data);

?>