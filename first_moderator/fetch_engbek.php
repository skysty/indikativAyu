<?php
session_start(); // Start session

// Include connection file
require_once('../incs/connect.php');	

// Initialize session variables
$_SESSION['tutor'];
$_SESSION["faculty"] = isset($_POST["faculty"]) ? $_POST["faculty"] : "";
$_SESSION["status"] = isset($_POST["status"]) ? $_POST["status"] : "";

$output = '';
$i = 1;

// Prepare SQL query with placeholders for dynamic conditions
$sql = "SELECT engbekter.engbekID,
                tutors.firstname, 
                tutors.lastname,
                tutors.patronymic,
                tutors.firstnameTR, 
                tutors.lastnameTR,
                tutors.patronymicTR, 
                korsetkishter.korsetkish_ati, 
                korsetkishter.korsetkish_ati2,
                engbekter.sani, 
                engbekter.univ_avtor_san, 
                engbekter.file_ati, 
                engbekter.ball, 
                engbekter.kayt_sebeb, 
                engbekter.eskertu, 
                status.status_name,
                status.status_nameTR,  
                faculties.FacultyID, 
                status.statusID,
                kaytaru_sebebi.sebepter,
                kaytaru_sebebi.sebepterTR,
                cafedras.cafedraNameKZ,
                cafedras.cafedraNameTR,  
                faculties.facultyNameKZ,
                faculties.facultyNameTR  
        FROM engbekter
        Left JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
        INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
        INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
        INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
        INNER JOIN status ON status.statusID = engbekter.kod_stat
        LEFT JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb =  engbekter.kod_kayt_sebeb 
        WHERE engbekter.del = 0 AND tutors.roleID NOT IN(2,3)";

// Check and add dynamic conditions
if (!empty($_SESSION['tutor'])) {
    $login = $_SESSION['tutor'];
    $sql .= "AND (korsetkishter.jauapty = '$login' OR korsetkishter.jauapty_eki = '$login')";
}
if (!empty($_SESSION["faculty"])) {
    $sql .= "AND kod_fakul = '" . $_SESSION["faculty"] . "'";
}
if (!empty($_SESSION["status"])) {
    $sql .= "AND kod_stat = '" . $_SESSION["status"] . "'";
}

// Execute the query
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
$data = array();
// Fetch and display results
while ($row = mysqli_fetch_array($result)) {
    // Assign variables
    $sLastName = $row['lastname'];
    $sFirstName = $row['firstname'];
    $sPatronymic = $row['patronymic'];
    $sCafedra = $row['cafedraNameKZ'];
    $korsetkih = $row['korsetkish_ati'];
    $statuss = $row['status_name'];
    $sebep = $row['sebepter'];
    // Language check
    if ($_SESSION['lang'] != 'kaz') {
        $sLastName = isset($row['lastnameTR']) && mb_strlen($row['lastnameTR']) ? $row['lastnameTR'] : $row['lastname'];
        $sFirstName = isset($row['firstnameTR']) && mb_strlen($row['firstnameTR']) ? $row['firstnameTR'] : $row['firstname'];
        $sPatronymic = isset($row['patronymicTR']) && mb_strlen($row['patronymicTR']) ? $row['patronymicTR'] : $row['patronymic'];
        $sFacult = isset($row['facultyNameTR']) && mb_strlen($row['facultyNameTR']) ? $row['facultyNameTR'] : $row['facultyNameKZ'];
        $sCafedra = isset($row['cafedraNameTR']) && mb_strlen($row['cafedraNameTR']) ? $row['cafedraNameTR'] : $row['cafedraNameKZ'];
        $korsetkih = isset($row['korsetkish_ati2']) && mb_strlen($row['korsetkish_ati2']) ? $row['korsetkish_ati2'] : $row['korsetkish_ati'];
        $statuss = isset($row['status_nameTR']) && mb_strlen($row['status_nameTR']) ? $row['status_nameTR'] : $row['status_name'];
        $sebep = isset($row['sebepterTR']) && mb_strlen($row['sebepterTR']) ? $row['sebepterTR'] : $row['sebepter'];
    }
    $row = array(
        'index'=>++$i,
        'ind'=>$row['engbekID'],
        'cafedra'=>$sCafedra,
        'fullname' => $sLastName . " " . $sFirstName,
        'korsetkish'=>$korsetkih,
        'sani'=>$row["sani"],
        'fileLink'=>$row['file_ati'],
        'univavtorsan'=>$row["univ_avtor_san"],
        'link' => "engbek.php?ID=" . $row['engbekID'],
        'ball'=>$row["ball"],
        'kayt_sebeb'=>$sebep,
        'status'=>$statuss,
        'rez'=>$row['kayt_sebeb']
    );
    $data[] = $row;
}
echo json_encode(array("data" => $data));  
?>