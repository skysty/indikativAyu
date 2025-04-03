<?php
include ('config.php');
include ('function.php');
	
if(isset($_POST['submit']))
{
	$uemail = $_POST['uemaill'];
	$uemail = mysqli_real_escape_string($connection, $uemail);
	
	if(checkUser($uemail) == "true")
	{
		$userID = UserID($uemail);
		$token = generateRandomString();
		
		$query = mysqli_query($connection, "Update tutors Set recovery_keys =  '$token' Where  tutorID = $userID");
		if($query)
		{
			 $send_mail = send_mail($uemail, $token);
              

			if($send_mail === 'success')
			{
				 $msg = 'Қалпына келтіру нұсқаулығы бар хат сіздің электрондық поштаңызға жіберілді. Егер хат келмеген жағдайда СПАМ категориясы ішінен іздеңіз.';
				 $msgclass = 'bg-success';
			}else{
				$msg = 'Қате нәрсе бар.';
				$msgclass = 'bg-danger';
			}



		}else
		{
				$msg = 'Қате нәрсе бар.';
				 $msgclass = 'bg-danger';
		}
		
	}else
	{
		$msg = "Бұл электрондық пошта біздің дерекқорымызда жоқ. (ayu.edu.kz) почтасына тіркеліңіз";
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
<title>Құпия сөзді ұмыттым?</title>

<link href="css/bootstrap.css" rel="stylesheet">
    
</head>
<body>

<div class="container">
	<div class="row">

    	<div class="col-lg-4 col-lg-offset-4">        

        	<form class="form-horizontal" role="form" method="post">
			    <h3>Құпия сөзді ұмыттыңыз ба?</h3>

				<?php if(isset($msg)) {?>
                    <div class="<?php echo $msgclass; ?>" style="padding:5px;"><?php echo $msg; ?></div>
                <?php } ?>

                <p>
                    Құпия сөзіңізді ұмыттыңыз ба? Мәселе жоқ, оны түзетеміз. Электрондық поштаңызды төменде келтіріңіз және электрондық поштаға парольді қалпына келтіру жөніндегі нұсқаулық жібереміз.
                </p>
    
                <div class="row">
                    <div class="col-lg-12">
                    <label class="control-label">Сіздің электрондық поштаңыз (ayu.edu.kz)</label>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-lg-12">
                        <input class="form-control" name="uemaill" type="email" placeholder="Мына жерге енгізіңіз ..." required>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-success btn-block" name="submit" style="margin-top:8px;">Жіберу</button>
                    </div>
                </div>
			</form>
		</div>
	</div>
    </div>
</div>    

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
