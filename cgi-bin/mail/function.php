<?php

function checkUser($email)
{
	global $connection;
	
	$query = mysqli_query($connection, "SELECT tutorID FROM tutors WHERE mail = '$email'");

	if(mysqli_num_rows($query) > 0)
	{
		return 'true';
	}else
	{
		return 'false';
	}
}

function UserID($email)
{
	global $connection;
	
	$query = mysqli_query($connection, "SELECT tutorID FROM tutors WHERE mail = '$email'");
	$row = mysqli_fetch_assoc($query);
	
	return $row['tutorID'];
}


function generateRandomString($length = 20) {
	// This function has taken from stackoverflow.com
    
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return md5($randomString);
}

function send_mail($to, $token)
{
	require 'PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer();
	$mail -> CharSet = "UTF-8";
	
	
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'ip@ayu.edu.kz';
	$mail->Password = 'Mktu2581@';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	
	$mail->From = 'ip@ayu.edu.kz';
	$mail->FromName = 'ip.ayu.edu.kz';
	//$mail->FromName = utf8_decode('ip.ayu.edu.kz');
	$mail->addAddress($to);
	$mail->addReplyTo('your_email@gmail.com', 'Reply');
	
	$mail->isHTML(true);
	
	$mail->Subject = 'Құпия сөзді жаңарту';
	$link = 'http://localhost:8081/indicative/mail/forget.php?email='.$to.'&token='.$token;
    $mail->Body    = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1251\"><b>Сәлеметсіз бе!</b><br><br>Сіз құпия сөзді қалпына келтіруді сұрадыңыз. Құпия сөзіңізді қалпына келтіру үшін <a href='$link' target='_blank'>мына сілтемені басыңыз</a>.";		
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		return 'fail';
	} else {
		return 'success';
	}
}

function verifytoken($userID, $token)
{	
	global $connection;	
	//$query = mysqli_query($db, "SELECT recovery_keys FROM tutors  WHERE tutorID = $userID AND recovery_keys = '$token'");
	$query = mysqli_query($connection, "SELECT recovery_keys FROM tutors  WHERE recovery_keys = '$token'");
	$row = mysqli_fetch_assoc($query);
	
	if(mysqli_num_rows($query) > 0)
	{
		return 1;
	}else
	{
		return 0;
	}	
}
?>