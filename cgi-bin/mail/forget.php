<?php

include ('config.php');
include ('function.php');

$uemail = $_GET['email'];
$token = $_GET['token'];

$userID = UserID($uemail); 

$verifytoken = verifytoken($userID, $token);




if(isset($_POST['submit']))
{
	$new_password = $_POST['new_password'];
	$new_password = md5($new_password);
	$retype_password = $_POST['retype_password'];
	$retype_password = md5($retype_password);
	
	if($new_password == $retype_password)
	    {
		$update_password = mysqli_query($connection, "UPDATE tutors SET Password = '$new_password' WHERE tutorID = $userID");
		if($update_password)
		               {
				//mysqli_query($db, "UPDATE recovery_keys SET valid = 0 WHERE userID = $userID AND token ='$token'");
				$msg = 'Сіздің парольіңіз сәтті өзгерді. Жаңа құпия сөзбен кіріңіз.';
				$msgclass = 'bg-success';
		                }
	    } else
	                        {
				$msg = "Пароль сәйкес емес";
				$msgclass = 'bg-danger';
	                        }
	
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Құпия сөзді ұмыттыңыз ба?</title>

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">
    
</head>
<body>

<div class="container">
	<div class="row">
   
	<?php if($verifytoken == 1) { ?>
    	<div class="col-lg-4 col-lg-offset-4">        

        	<form class="form-horizontal" role="form" method="post">
			    <h3>Құпия сөзіңізді қалпына келтіріңіз</h3>

				<?php if(isset($msg)) { ?>
                    <div class="<?php echo $msgclass; ?>" style="padding:5px;"><?php echo $msg; ?></div>
                <?php } ?>
    
                <div class="row">
                    <div class="col-lg-12">
                    <label class="control-label">Жаңа құпия сөзді теріңіз</label>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-lg-12">
                        <input class="form-control" name="new_password" type="password" placeholder="Жаңа құпия сөзді теріңіз" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                    <label class="control-label">Жаңа құпия сөзді қайта теріңіз</label>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-lg-12">
                        <input class="form-control" name="retype_password" type="password" placeholder="Жаңа құпия сөзді қайта теріңіз" required>
                    </div>
                </div>
				
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-success btn-block" name="submit" style="margin-top:8px;">Жіберу</button>
                    </div>
                </div>
			</form>
		</div>
        
        <?php }else {?>
	    	<div class="col-lg-4 col-lg-offset-4">
   		       	<h3>Жарамсыз немесе жарамсыз токен</h3>
	            <p>Сіз қолданған сілтеме үзілген немесе пайдаланылған болуы мүмкін. Сілтемені дұрыс көшіргеніңізге немесе басқа белгішені сұрағаныңызға көз жеткізіңіз <a href="index.php">Мұнда</a>.</p>
			</div>
        <?php }?>            

	</div>
  
</div>    

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
