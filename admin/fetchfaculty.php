<?php
require_once ('../incs/connect.php');
session_start();
$_SESSION['lang'];
$sql = "SELECT  * FROM faculties";
$result = mysqli_query($connection, $sql) or die (mysqli_error($connection));

$data = array(); // Initialize an array to store the data
if ($result->num_rows > 0) {
    while($personal = $result->fetch_assoc()) {
        $facilty=($_SESSION['lang'] != 'kaz' && isset($personal['facultyNameTR']) && mb_strlen($personal['facultyNameTR'])) ? $personal['facultyNameTR'] : $personal['facultyNameKZ'];
        $row = array(
            'facilty'=>$facilty,
            'facid'=>$personal['FacultyID']
        );
        $data[] = $row;
    }
}

// Encode data to JSON
echo json_encode($data);
?>