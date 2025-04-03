<?php
require_once ('../incs/connect.php');
session_start();
$_SESSION['lang'];
$sql = "SELECT * FROM sex";
$result = mysqli_query($connection, $sql) or die (mysqli_error($connection));

$data = array(); // Initialize an array to store the data
if ($result->num_rows > 0) {
    while($personal = $result->fetch_assoc()) {
        $sex=($_SESSION['lang'] != 'kaz' && isset($personal['nameTR']) && mb_strlen($personal['nameTR'])) ? $personal['nameTR'] : $personal['nameKZ'];
        $row = array(
            'sexId'=>$personal['Id'],
            'name'=>$sex
        );
        $data[] = $row;
    }
}

// Encode data to JSON
echo json_encode($data);
?>
