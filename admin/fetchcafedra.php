<?php
require_once ('../incs/connect.php');
session_start();
$_SESSION['lang'];
$sql = 'SELECT * FROM cafedras WHERE FacultyID = "'.$_POST["FacultyID"].'"';
$result = mysqli_query($connection, $sql) or die (mysqli_error($connection));

$data = array(); // Initialize an array to store the data
if ($result->num_rows > 0) {
    while($personal = $result->fetch_assoc()) {
        $cafedra=($_SESSION['lang'] != 'kaz' && isset($personal['cafedraNameTR']) && mb_strlen($personal['cafedraNameTR'])) ? $personal['cafedraNameTR'] : $personal['cafedraNameKZ'];
        $row = array(
            'cafname'=>$cafedra,
            'cafid'=>$personal['cafedraID']
        );
        $data[] = $row;
    }
}

// Encode data to JSON
echo json_encode($data);
?>