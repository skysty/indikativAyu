<?php
require_once ('../incs/connect.php');
session_start();
$_SESSION['lang'];
$sql = "SELECT * FROM workstatus";
$result = mysqli_query($connection, $sql) or die (mysqli_error($connection));

$data = array(); // Initialize an array to store the data
if ($result->num_rows > 0) {
    while($personal = $result->fetch_assoc()) {
        $row = array(
            'Id'=>$personal['ShtatId'],
            'name'=>$personal['Sany']
        );
        $data[] = $row;
    }
}

// Encode data to JSON
echo json_encode($data);
?>
