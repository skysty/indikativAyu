<?php
include('../incs/connect.php');
session_start();
$login = $_SESSION['tutor'];
if(isset($_POST['query'])){
    $search=$_POST['query'];
    $stmt=$connection->prepare("SELECT tutors.TutorID,
    tutors.dostup, korsetkishter.dos_id, 
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
    AND firstname LIKE CONCAT('%',?, '%') or lastname LIKE CONCAT('%',?,'%') ");
    $stmt->bind_param("ss", $search, $search);
} 
else{
    $stmt=$connection->prepare("SELECT tutors.TutorID,
    tutors.dostup, korsetkishter.dos_id, 
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
    Where korsetkishter.jauapty = '$login' AND  statusID=4 AND kayt_sebeb IS NOT NULL  AND engbekter.dostup_id=0");
}
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows>0){
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col' class='text-center'>№</th>";
    echo "<th scope='col'>Кафедра/ҒЗИ</th>";
    echo "<th scope='col'>Аты жөні</th>";
    echo "<th scope='col'>Көрсеткіш</th>";
    echo "<th scope='col'>Саны</th>";
    echo "<th scope='col'>Автор саны</th>";
    echo "<th scope='col'>Файл аты</th>";
    echo "<th scope='col'>Қайтару себебі</th>";
    echo "<th scope='col' class='text-center'>Құралдар</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
  $no=1;
while ($row=$result->fetch_assoc()){
    echo "<tr>";
    echo "<td style='display:none'>" . $row['kod_korsetkish'] . "</td>";
    echo "<td style='display:none'>" . $row['TutorID'] . "</td>";
    echo "<td style='display:none'>" . $row['engbekID'] . "</td>";
    echo "<td class='text-center'>" . $no++ . "</td>";
    echo "<td>" . $row['cafedraNameKZ'] . "</td>";
    echo "<td>" .$row["lastname"]." ".$row["firstname"]. "</td>";
    echo "<td>" .$row["korsetkish_ati"]. "</td>";
    echo "<td>" .$row["sani"]. "</td>";
    echo "<td>" .$row["univ_avtor_san"]. "</td>";
    echo "<td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td>";
    echo "<td>" .$row["kayt_sebeb"]. "</td>";
    echo "<td class='text-center'>";

    //echo "<button type='button' class='btn btn-primary editButton pad m-1'><span class='material-icons align-middle'>edit</span></button>";
    if($row["dostup"]And $row["dos_id"]){
    // кнопка доступа
            echo "
            <!-- Button trigger modal -->
                <button type='button' class='btn btn btn-danger  removeButton pad m-1'><span class='material-icons align-middle'>add</span></button>
                ";
            }else{
                echo "
                <!-- Button trigger modal -->
                <button type='button' class='btn btn-success checkButton pad m-1'><span class='material-icons align-middle'>check</span></button>
                ";
            }
    echo "</td>";

    echo "</tr>";
}

echo "</tbody>";
echo "</table>";
}else {
    echo "<h3>Сіз сұрап жатқан сұранымдар жоқ</h3>";
}
?>
