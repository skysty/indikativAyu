<?php
// Establish database connection
require_once ('../incs/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tutorIIN = $_POST['iin'];
    $lastName = $_POST['lastname'];
    $firstName = $_POST['firstname'];
    $birthdate=$_POST['birthdate'];
    $patronymic = isset($_POST['patronymic'])? $_POST['patronymic']:null;
    $mail=$_POST['email'];
    $phone=$_POST['phone'];
    $sexid=$_POST['sex'];
    $cafedraid=$_POST['Cafedra'];
    $stat_sanyId=$_POST['workstatus'];
    $jumys_turu=$_POST['jumysTuru'];
    $scientificID=$_POST['akademikDareje'];
    $job_titleID=$_POST['akademikKadrTipi'];
    $hashedIIN = md5($tutorIIN);
    $fullName = ucfirst($lastName) . '_' . ucfirst($firstName);
    // Insert into database
    $sql = "INSERT INTO tutors (firstname, lastname, patronymic, BirthDate, IIN,
     `Login`, `Password`, phone, jumys_turuID, mail, RATE, 
     `roleID`, `sexID`, `CafedraID`, `deleted`,`shtat_sanyId`, `scientificID`, 
      `exist`, `job_titleID`,dostup) VALUES('$firstName','$lastName','$patronymic',
     '$birthdate','$tutorIIN','$fullName','$hashedIIN','$phone','$jumys_turu','$mail',
      '1','1','$sexid','$cafedraid','0','$stat_sanyId','$scientificID','1','$job_titleID','0')";
    if (mysqli_query($connection, $sql)) {
          echo "Task added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}
?>