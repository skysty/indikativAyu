<?php
include('../incs/connect.php');
        session_start();
		$_SESSION['tutor'];
		$_SESSION['lang'];
		if(!isset($_SESSION['tutor'])){

			header('Location: ../login.php');
		}
    $sql1 = mysqli_query($connection, "SELECT 
    firstname,
    firstnameTR,
    lastname,
    lastnameTR,
    mail,
    engbek_count,
    status_2_count,
    status_3_count,
    status_4_count,
    status_5_count
FROM tutor_engbek_stats
GROUP BY mail, firstname,firstnameTR,lastnameTR,
    lastname
ORDER BY firstname,
    lastname,firstnameTR,lastnameTR") or die(mysqli_error($connection));

    $data = array(); // Initialize an array to store the data

    // Loop through the results from $sql1
    $i = 0;
    while($tutor2 = mysqli_fetch_array($sql1)) {
        $row = array(
            'index'=>++$i,
            'lastName' => $_SESSION['lang'] != 'kaz' ? ($tutor2['lastnameTR'] ?: $tutor2['lastname']) : $tutor2['lastname'],
            'firstName' => $_SESSION['lang'] != 'kaz' ? ($tutor2['firstnameTR'] ?: $tutor2['firstname']) : $tutor2['firstname'],
            'engbek_count' => $tutor2['engbek_count'],
            'status_2_count' => $tutor2['status_2_count'],
            'status_3_count' => $tutor2['status_3_count'],
            'status_4_count' => $tutor2['status_4_count'],
            'status_5_count' => $tutor2['status_5_count']
        );
        $data[] = $row;
    }

    // Output the JSON
    echo json_encode($data);

?>