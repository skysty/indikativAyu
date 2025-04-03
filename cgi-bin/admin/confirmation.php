<body>
<p>Worked</p>	
	<?php
		include('../incs/connect.php');
		
		$tutor_id = $_POST['tutor_id'];
		$engbek_id = $_POST['engbek_id'];
		$tutor_moderator = $_POST['tutor_moderator'];
		
		$status = $_POST['status'];
		$kaytaru_sebebi = $_POST['kaytaru_sebebi'];
		$resolution = $_POST['resolution'];
		
		if(isset($_POST['confirmed'])){
			
			echo "Test echo <hr />";
				
			$main_sql = mysqli_query($connection,"SELECT korsetkishter.ball, korsetkishter.kod_korsetkish, engbekter.engbekID, engbekter.sani, engbekter.kod_fakul, engbekter.univ_avtor_san, engbekter.kod_kizm FROM engbekter INNER JOIN korsetkishter ON engbekter.kod_korset = korsetkishter.kod_korsetkish WHERE engbekID = '$engbek_id'") or die(mysql_error()); 
			
			$res = mysqli_fetch_array($main_sql);
				
			$first_ball = $res['ball'];
				
			echo "Ball = ".$first_ball."<hr />";
			
			$avtor_san = $res['univ_avtor_san'];
			
			echo "Avtor san = ".$avtor_san."<hr />";
			
			$sani = $res['sani'];
			
			echo "Sani = ".$sani."<hr />";
			
			$kod_korsetkish = $res['kod_korsetkish'];
			
			echo "Korsetkish ID = ".$kod_korsetkish."<hr />";
			
			$kod_fakul = $res['kod_fakul'];
			
			echo "Facultet ID = ".$kod_fakul."<hr />";
			
			echo "moderator ID = ".$tutor_moderator."<hr />";
			
			$last_ball = 1;
			
			if($status == 3){
				
				if($avtor_san > 1){				
					if($kod_korsetkish == 36){
						$r = 0.139 * $sani;
						$last_ball = $r/$avtor_san;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysqli_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysqli_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					} else if($kod_korsetkish == 37){
						$r = 0.139 * $sani * 2;
						$last_ball = $r/$avtor_san;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysqli_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysqli_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					} else if($kod_korsetkish == 31){
						$r = $first_ball * $sani;
						$last_ball = $r/$avtor_san;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					} else if($kod_korsetkish == 32){
						$r = $first_ball * $sani * 2;
						$last_ball = $r/$avtor_san;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					} else if($kod_korsetkish == 60){
						$s = $sani * 0.002*3;
						$last_ball = $s/$avtor_san;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');	
					} else if($kod_korsetkish == 61){
						$s = $sani * 0.002*2;
						$last_ball = $s/$avtor_san;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');	
					} else if($kod_korsetkish == 62){
						$s = $sani * 0.002 * 1;
						$last_ball = $s/$avtor_san;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					} else if($kod_korsetkish == 12){
						$s = $first_ball;
						$last_ball = $s/$avtor_san;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					} else {
						$last_ball = ($sani*$first_ball)/$avtor_san;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					}
				} else {
					if($kod_korsetkish == 36){
						$r = 0.139 * $sani;
						$last_ball = $r;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');					
					} else if($kod_korsetkish == 37){
						$r = 0.139 * $sani * 2;
						$last_ball = $r/$avtor_san;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					} else if($kod_korsetkish == 31){
						$r = $first_ball * $sani;
						$last_ball = $r;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					} else if($kod_korsetkish == 32){
						$r = $first_ball * $sani * 2;
						$last_ball = $r;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					} else if($kod_korsetkish == 60){
						$s = $sani * 0.002*3;
						$last_ball = $s;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');	
					} else if($kod_korsetkish == 61){
						$s = $sani * 0.002*2;
						$last_ball = $s;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');	
					} else if($kod_korsetkish == 62){
						$s = $sani * 0.002 * 1;
						$last_ball = $s;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					} else if($kod_korsetkish == 12){
						$s = $first_ball;
						$last_ball = $s;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					} else {
						$last_ball = $sani * $first_ball;
						echo $last_ball = sprintf("%.2f", $last_ball);
						$sql = mysql_query("UPDATE engbekter SET ball = '$last_ball', kod_stat = '3' WHERE engbekID = '$engbek_id'") or die(mysql_error());
						$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
						header('Location: show_conf_ok.php');
					}
				}				
			} else if($status == 4){
				$sql = mysql_query("UPDATE engbekter SET `ball` = '0', kod_stat = '4', kod_kayt_sebeb = '$kaytaru_sebebi', kayt_sebeb = '$resolution' WHERE `engbekID` = '$engbek_id'") or die(mysql_error());
				$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
				header('Location: show_conf_not_ok.php');
			} else if($status == 2){
				$sql = mysql_query("UPDATE engbekter SET `ball` = '0', kod_stat = '2' WHERE `engbekID` = '$engbek_id'") or die(mysql_error());		
				header('Location: engbek_tekseru.php');
			} else if($status == 5){
				$sql = mysql_query("UPDATE engbekter SET `ball` = '0', kod_stat = '5' WHERE `engbekID` = '$engbek_id'") or die(mysql_error());
				$sql2 = mysql_query("INSERT INTO tekserushi(kod_tekserushi,kod_korset,kod_fakultet) VALUES('$tutor_moderator','$kod_korsetkish','$kod_fakul')") or die(mysql_error());
				header('Location: show_conf_ok.php');
			}
		} else {
			echo "Бір қате бар";
		}
	?>
</body>
