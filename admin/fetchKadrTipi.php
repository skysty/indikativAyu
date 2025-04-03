<?php
require_once ('../incs/connect.php');
session_start();
$_SESSION['lang'];
$sql = "SELECT * FROM akademikKadrTipi";
$result = mysqli_query($connection, $sql) or die (mysqli_error($connection));

$data = array(); // Initialize an array to store the data
if ($result->num_rows > 0) {
    while($personal = $result->fetch_assoc()) {
        $name=($_SESSION['lang'] != 'kaz' && isset($personal['nameTR']) && mb_strlen($personal['nameTR'])) ? $personal['nameTR'] : $personal['name'];
        $row = array(
            'Id'=>$personal['Id'],
            'name'=>$name
        );
        $data[] = $row;
    }
}

// Encode data to JSON
echo json_encode($data);
?>
