<?php

	include('../incs/connect.php');

	

	$output = '';

	

	$sql = 'SELECT * FROM tutors WHERE deleted=0 AND cafedraID = "'.$_POST["cafedraID"].'"';

	

	$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));

	?><option selected="selected">---</option><?php

    while($row = mysqli_fetch_array($result)){
        $sLastName = $row['lastname'];
        $sFirstName = $row['firstname'];
        $sPatronymic = $row['patronymic'];
        if ($_SESSION['lang'] != 'kaz'){
            $sLastName = isset($row['lastnameTR']) && mb_strlen($row['lastnameTR']) ? $row['lastnameTR'] : $row['lastname'];
            $sFirstName = isset($row['firstnameTR']) && mb_strlen($row['firstnameTR']) ? $row['firstnameTR'] : $row['firstname'];
            $sPatronymic = isset($row['patronymicTR']) && mb_strlen($row['patronymicTR']) ? $row['patronymicTR'] : $row['patronymic'];
        }

        $output .= "<option value=" . $row['TutorID'] . ">" . $sLastName ." ". $sFirstName ." ". $sPatronymic ."</option>";

    } 

	echo $output; 	

?>