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
            $sLastName = isset($row['lastnameRu']) && mb_strlen($row['lastnameRu']) ? $row['lastnameRu'] : $row['lastname'];
            $sFirstName = isset($row['firstnameRu']) && mb_strlen($row['firstnameRu']) ? $row['firstnameRu'] : $row['firstname'];
            $sPatronymic = isset($row['patronymicRu']) && mb_strlen($row['patronymicRu']) ? $row['patronymicRu'] : $row['patronymic'];
        }

        $output .= "<option value=" . $row['TutorID'] . ">" . $sLastName ." ". $sFirstName ." ". $sPatronymic ."</option>";

    } 

	echo $output; 	

?>