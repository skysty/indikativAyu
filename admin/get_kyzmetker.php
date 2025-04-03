<?php
// Establish database connection
require_once ('../incs/connect.php');
session_start();
$_SESSION['tutor'];
$_SESSION['lang'];
// Fetch  from database
$sql = "SELECT tutors.firstname,
tutors.TutorID,
tutors.BirthDate,
tutors.firstnameTR, 
tutors.lastname,
tutors.phone,
tutors.lastnameTR,  
tutors.patronymic,
tutors.patronymicTR,  
faculties.FacultyID,  
cafedras.cafedraNameKZ,
cafedras.cafedraNameTR,  
faculties.facultyNameKZ,
faculties.facultyNameTR,
sex.nameKZ AS sexname,
sex.nameTR AS sexnameTR,
akademikKadrTipi.name AS kadrname,
akademikKadrTipi.nameTR AS kadrnameTR,
akademikDareje.name AS darejename,
akademikDareje.nameTR AS darejenameTR,
jumys_turi.name AS jumysname,
jumys_turi.nameTR AS jumysnameTR,
workstatus.Sany
FROM tutors 
JOIN cafedras ON cafedras.cafedraID = tutors.CafedraID
JOIN faculties ON faculties.FacultyID = cafedras.FacultyID
join sex on sex.Id=tutors.sexID
LEFT join akademikKadrTipi on akademikKadrTipi.Id = tutors.job_titleID
LEFT JOIN akademikDareje ON akademikDareje.Id= tutors.scientificID
LEFT JOIN jumys_turi ON jumys_turi.Id = tutors.jumys_turuID
JOIN workstatus ON workstatus.ShtatId = tutors.shtat_sanyId
WHERE tutors.deleted=0;";
$result = mysqli_query($connection, $sql) or die (mysqli_error($connection));

$data = array(); // Initialize an array to store the data

// Loop through the results from $sql1
while ($personal = mysqli_fetch_array($result)) {
    $sTitle = ($_SESSION['lang'] != 'kaz' && isset($personal['cafedraNameTR']) && mb_strlen($personal['cafedraNameTR'])) ? $personal['cafedraNameTR'] : $personal['cafedraNameKZ'];
    $facilty=($_SESSION['lang'] != 'kaz' && isset($personal['facultyNameTR']) && mb_strlen($personal['facultyNameTR'])) ? $personal['facultyNameTR'] : $personal['facultyNameKZ'];
    $firstname=($_SESSION['lang'] != 'kaz' && isset($personal['firstnameTR']) && mb_strlen($personal['firstnameTR'])) ? $personal['firstnameTR'] : $personal['firstname'];
    $lastname=($_SESSION['lang'] != 'kaz' && isset($personal['lastnameTR']) && mb_strlen($personal['lastnameTR'])) ? $personal['lastnameTR'] : $personal['lastname'];
    $patronymic=($_SESSION['lang'] != 'kaz' && isset($personal['patronymicTR']) && mb_strlen($personal['patronymicTR'])) ? $personal['patronymicTR'] : $personal['patronymic'];
    $sex=($_SESSION['lang'] != 'kaz' && isset($personal['sexnameTR']) && mb_strlen($personal['sexnameTR'])) ? $personal['sexnameTR'] : $personal['sexname'];
    $akademikKadrTipi=($_SESSION['lang'] != 'kaz' && isset($personal['kadrnameTR']) && mb_strlen($personal['kadrnameTR'])) ? $personal['kadrnameTR'] : $personal['kadrname'];
    $akademikDareje=($_SESSION['lang'] != 'kaz' && isset($personal['darejenameTR']) && mb_strlen($personal['darejenameTR'])) ? $personal['darejenameTR'] : $personal['darejename'];
    $jumys_turi=($_SESSION['lang'] != 'kaz' && isset($personal['jumysnameTR']) && mb_strlen($personal['jumysnameTR'])) ? $personal['jumysnameTR'] : $personal['jumysname'];
    $row = array(
        'sTitle' => $sTitle, // Assign sTitle here
        'facilty'=>$facilty,
        'firstname'=>$firstname,
        'lastname'=>$lastname,
        'patronymic'=>($patronymic !== null) ? $patronymic : '',
        'sex'=>$sex,
        'phone'=>($personal['phone']!==null)?$personal['phone']:'',
        'akademikKadrTipi'=>$akademikKadrTipi,
        'akademikDareje'=>$akademikDareje,
        'jumys_turi'=> $jumys_turi,
        'workstatus'=>$personal['Sany'],
        'birthdate'=>$personal['BirthDate'],
        'tutid'=>$personal['TutorID']
    );
    $data[] = $row;
} 

// Output the JSON
echo json_encode(array("data" => $data));
?>
