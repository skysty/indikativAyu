<?php
// Connect to the database using mysqli
include('../incs/connect.php');
header('Content-Type: text/html; charset=utf-8');
// Get the search query from the URL parameters
$nameAvtor = mysqli_real_escape_string($connection, $_GET['nameAvtor']);

// Prepare a SQL statement to search for matching results
        
$sql = "SELECT TutorID, lastname, firstname, patronymic FROM tutors WHERE firstname LIKE '".$nameAvtor."%' 
OR lastname LIKE '".$nameAvtor."%' 
OR patronymic LIKE '".$nameAvtor."%'";

$result = mysqli_query($connection, $sql);
// Check for errors
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
if (mysqli_num_rows($result) > 0) {
    $data = array();
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array('message' => 'No results found'));
}

// Close the database connection
mysqli_close($connection);
?>