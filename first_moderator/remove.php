<?php

include('../incs/connect.php');

if (isset($_POST['savedata'])) {
  $enbekID = $_POST['enbID'];

  $query = "UPDATE `engbekter` SET `del`= 1 where `engbekID` = '$enbekID'";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Сәтті сақталды!!!';
  $_SESSION['message_type'] = 'қате';
  header('Location: enbek_jukteuopk.php');
}

?>
