<?php
header('Content-Type: application/json;');
include('../incs/connect.php');
session_start();
$login = $_SESSION['tutor'];
$tutors = mysqli_query($connection, "SELECT 
tutors.TutorID,
 korsetkishter.dos_id, 
korsetkishter.kod_korsetkish, 
engbekter.engbekID, 
engbekter.dostup_id,
tutors.exist, 
tutors.firstname, 
tutors.lastname, 
tutors.patronymic, 
korsetkishter.korsetkish_ati, 
engbekter.sani, 
engbekter.univ_avtor_san, 
engbekter.file_ati, 
engbekter.ball, 
engbekter.kayt_sebeb, 
engbekter.eskertu, 
status.status_name, 
faculties.FacultyID, 
status.statusID, 
cafedras.cafedraNameKZ, 
faculties.facultyNameKZ 
FROM engbekter
INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 
INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
INNER JOIN status ON status.statusID = engbekter.kod_stat
Where korsetkishter.jauapty = '$login' AND  statusID=4 AND kayt_sebeb IS NOT NULL  AND engbekter.dostup_id=0
");
$tutorsList=[];
while($tutor=mysqli_fetch_assoc($tutors)){
    $tutorsList[]=$tutor;
}
echo json_encode($tutorsList);
?>
