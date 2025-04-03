<?php
include('../incs/connect.php');
        session_start();
		$_SESSION['tutor'];
		$_SESSION['lang'];
		if(!isset($_SESSION['tutor'])){

			header('Location: ../login.php');
		}

        $c_sql = mysqli_query($connection,"SELECT 
        TutorID, 
        facultyNameKZ,
        facultyNameTR,
        cafedraNameKZ,
        cafedraNameTR,
        firstname,
        firstnameTR,
        lastname,
        lastnameTR,
        engbek_count,
        status_2_count,
        status_3_count,
        status_4_count,
        status_5_count
        FROM tutor_engbek_uploadstats
        GROUP BY TutorID, firstname,firstnameTR, lastname,lastnameTR,facultyNameKZ, facultyNameTR, cafedraNameKZ,cafedraNameTR
        ORDER BY `engbek_count` DESC ") or die(mysqli_error($connection));

    

        $data = array(); // Initialize an array to store the data

        // Loop through the results from $sql1
        $i = 0; // Start the index from 0
        while ($uplfile = mysqli_fetch_array($c_sql)) {
            $sTitle = ($_SESSION['lang'] != 'kaz' && isset($uplfile['cafedraNameTR']) && mb_strlen($uplfile['cafedraNameTR'])) ? $uplfile['cafedraNameTR'] : $uplfile['cafedraNameKZ'];
            $facutly = ($_SESSION['lang'] != 'kaz' && isset($uplfile['facultyNameTR']) && mb_strlen($uplfile['facultyNameTR'])) ? $uplfile['facultyNameTR'] : $uplfile['facultyNameKZ'];
            
            $row = array(
                'index' => ++$i, // Increment index
                'sTitle' => $sTitle,
                'sFaculty'=> $facutly,// Assign sTitle here
                'lastName' => $_SESSION['lang'] != 'kaz' ? ($uplfile['lastnameTR'] ?: $uplfile['lastname']) : $uplfile['lastname'],
                'firstName' => $_SESSION['lang'] != 'kaz' ? ($uplfile['firstnameTR'] ?: $uplfile['firstname']) : $uplfile['firstname'],
                'engbek_count' => $uplfile['engbek_count'],
                'status_2_count' => $uplfile['status_2_count'],
                'status_3_count' =>$uplfile['status_3_count'],
                'status_4_count' => $uplfile['status_4_count'],
                'status_5_count' => $uplfile['status_5_count'],
                'tutorID' => $uplfile['TutorID'],
                'link' => "tolyk.php?ID=" . $uplfile['TutorID']
            );
            $data[] = $row;
        } 

        // Output the JSON
        echo json_encode($data);

?>