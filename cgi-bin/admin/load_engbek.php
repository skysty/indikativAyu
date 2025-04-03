<?php
	include('../incs/connect.php');
	require('../logicFunctions/functions.php');
	if(isset($_POST['upload'])){
		try	{	
				$korsetkish = $_POST['korsetkish'];
				$date = $_POST['date'];
				$save_date = $_POST['save_date'];
				$eskertu = $_POST['eskertu']??'';
				$FacultyID = $_POST['faculty'];
				$cafedraID = $_POST['cafedra'];
				$TutorID = $_POST['tutor_id'];
				$univ_avtor_san = $_POST['univ_avtor_san']??'';
				$univ_avtor_san2 = $_POST['univ_avtor_san2']??'';
				$sani = $_POST['sany']??'';
			    /*Авторлар*/
                		$avtor2 =$_POST['avtor_bir']??'';
				$avtor3 =$_POST['avtor_eki']??'';
				$avtor4 =$_POST['avtor_ush']??'';
				$avtor5 =$_POST['avtor_tort']??'';
				$avtor6 =$_POST['avtor_bes']??'';
				$avtor7 =$_POST['avtor_alty']??'';
				/*Авторлар*/ 
				$file = $_FILES['file']['name'];
				$file_size = $_FILES['file']['size'];
				$file_temp = $_FILES['file']['tmp_name'];
				$id_esep = $_POST['id_esep'];
			}
			catch (Exception $e) {
				// Log the error
				error_log($e->getMessage());

				// Display an error page to the user
				header("HTTP/1.1 500 Internal Server Error");
				include("../error/error_page.php");
				exit();
			}
		if($univ_avtor_san2!=null && $id_esep=="6"){
			switch($univ_avtor_san2){
				case "1":
					$is_valid=isFileSizeValid($file_size, $korsetkish, $TutorID, $connection);
					break;
				case "2":
					$tutor_info2 = getTutorInfo2($avtor2, $connection);
					$TutorID2 = $tutor_info2['TutorID'];
					$is_valid=isFileSizeValid2($file_size, $korsetkish, $TutorID, $TutorID2, $connection);
					break;
				case "3":
					//автор 2
					$tutor_info2 = getTutorInfo2($avtor2, $connection);
					$TutorID2 = $tutor_info2['TutorID'];
					//автор 3
					$tutor_info3 = getTutorInfo3($avtor3, $connection);
					$TutorID3 = $tutor_info3['TutorID'];
					$is_valid=isFileSizeValid3($file_size, $korsetkish, $TutorID, $TutorID2, $TutorID3, $connection);
					break;
				case "4":
                    //автор 2
					$tutor_info2 = getTutorInfo2($avtor2, $connection);
					$TutorID2 = $tutor_info2['TutorID'];
					//автор 3
					$tutor_info3 = getTutorInfo3($avtor3, $connection);
					$TutorID3 = $tutor_info3['TutorID'];
					//автор 4
					$tutor_info4 = getTutorInfo4($avtor4, $connection);
					$TutorID4 = $tutor_info4['TutorID'];
					$is_valid=isFileSizeValid4($file_size, $korsetkish, $TutorID, $TutorID2, $TutorID3, $TutorID4, $connection);
					break;
				case "5":
					//автор 2
					$tutor_info2 = getTutorInfo2($avtor2, $connection);
					$TutorID2 = $tutor_info2['TutorID'];
					//автор 3
					$tutor_info3 = getTutorInfo3($avtor3, $connection);
					$TutorID3 = $tutor_info3['TutorID'];
					//автор 4
					$tutor_info4 = getTutorInfo4($avtor4, $connection);
					$TutorID4 = $tutor_info4['TutorID'];
					//автор 5
					$tutor_info5 = getTutorInfo5($avtor5, $connection);
					$TutorID5 = $tutor_info5['TutorID'];
					$is_valid=isFileSizeValid5($file_size, $korsetkish, $TutorID, $TutorID2, $TutorID3, $TutorID4, $TutorID5, $connection);
					break;
				case "6":
					//автор 2
					$tutor_info2 = getTutorInfo2($avtor2, $connection);
					$TutorID2 = $tutor_info2['TutorID'];
					//автор 3
					$tutor_info3 = getTutorInfo3($avtor3, $connection);
					$TutorID3 = $tutor_info3['TutorID'];
					//автор 4
					$tutor_info4 = getTutorInfo4($avtor4, $connection);
					$TutorID4 = $tutor_info4['TutorID'];
					//автор 5
					$tutor_info5 = getTutorInfo5($avtor5, $connection);
					$TutorID5 = $tutor_info5['TutorID'];
					//автор 6
					$tutor_info6 = getTutorInfo6($avtor6, $connection);
					$TutorID6 = $tutor_info6['TutorID'];
					$is_valid=isFileSizeValid6($file_size, $korsetkish, $TutorID, $TutorID2, $TutorID3, $TutorID4, $TutorID5, $TutorID6, $connection);
					break;
				case "7":
					//автор 2
					$tutor_info2 = getTutorInfo2($avtor2, $connection);
					$TutorID2 = $tutor_info2['TutorID'];
					//автор 3
					$tutor_info3 = getTutorInfo3($avtor3, $connection);
					$TutorID3 = $tutor_info3['TutorID'];
					//автор 4
					$tutor_info4 = getTutorInfo4($avtor4, $connection);
					$TutorID4 = $tutor_info4['TutorID'];
					//автор 5
					$tutor_info5 = getTutorInfo5($avtor5, $connection);
					$TutorID5 = $tutor_info5['TutorID'];
					//автор 6
					$tutor_info6 = getTutorInfo6($avtor6, $connection);
					$TutorID6 = $tutor_info6['TutorID'];
					//автор 7
					$tutor_info7 = getTutorInfo7($avtor7, $connection);
					$TutorID7 = $tutor_info7['TutorID'];
					$is_valid=isFileSizeValid7($file_size, $korsetkish, $TutorID, $TutorID2, $TutorID3, $TutorID4, $TutorID5, $TutorID6, $TutorID7, $connection);
					break;
	            default:
					header('HTTP/1.0 404 Not Found');
					include('../error/error_count_author.php');
					exit();
					break;
			}
			
			if ($is_valid) {
				$temp = explode(".", $file);
				$newfilename = $TutorID . "_" . round(time()) . '.' . end($temp);
				move_uploaded_file($file_temp, __DIR__ . "/../files/" . $newfilename);
				if ($sani == null || $sani == 0) {
					$sani = 1;
				}
			switch($univ_avtor_san2){
                 case "1":
                    $query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID','11','1','$FacultyID','$cafedraID','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','1')") or die(mysqli_error($connection));
					break;
				 case "2":
                    $cafedraID2 = $tutor_info2['cafedraID'];
					$FacultyID2 = $tutor_info2['FacultyID'];
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID','11','1','$FacultyID','$cafedraID','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','1')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID2','11','1','$FacultyID2','$cafedraID2','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','2')") or die(mysqli_error($connection));
					break;
				 case "3":
					//автор 2
					$cafedraID2 = $tutor_info2['cafedraID'];
					$FacultyID2 = $tutor_info2['FacultyID'];
					//автор 3
					$cafedraID3 = $tutor_info3['cafedraID'];
					$FacultyID3 = $tutor_info3['FacultyID'];
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID','11','1','$FacultyID','$cafedraID','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','3')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID2','11','1','$FacultyID2','$cafedraID2','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','4')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID3','11','1','$FacultyID3','$cafedraID3','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','4')") or die(mysqli_error($connection));
					break;
				case "4":
					//автор 2
					$cafedraID2 = $tutor_info2['cafedraID'];
					$FacultyID2 = $tutor_info2['FacultyID'];
					//автор 3
					$cafedraID3 = $tutor_info3['cafedraID'];
					$FacultyID3 = $tutor_info3['FacultyID'];
					//автор 4
					$cafedraID4 = $tutor_info4['cafedraID'];
					$FacultyID4 = $tutor_info4['FacultyID'];
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID','11','1','$FacultyID','$cafedraID','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','3')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID2','11','1','$FacultyID2','$cafedraID2','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','5')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID3','11','1','$FacultyID3','$cafedraID3','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','5')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID4','11','1','$FacultyID4','$cafedraID4','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','5')") or die(mysqli_error($connection));
					break;
				case "5":
					//автор 2
					$cafedraID2 = $tutor_info2['cafedraID'];
					$FacultyID2 = $tutor_info2['FacultyID'];
					//автор 3
					$cafedraID3 = $tutor_info3['cafedraID'];
					$FacultyID3 = $tutor_info3['FacultyID'];
					//автор 4
					$cafedraID4 = $tutor_info4['cafedraID'];
					$FacultyID4 = $tutor_info4['FacultyID'];
					//автор 5
					$cafedraID5 = $tutor_info5['cafedraID'];
					$FacultyID5 = $tutor_info5['FacultyID'];
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID','11','1','$FacultyID','$cafedraID','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','3')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID2','11','1','$FacultyID2','$cafedraID2','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','6')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID3','11','1','$FacultyID3','$cafedraID3','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','6')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID4','11','1','$FacultyID4','$cafedraID4','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','6')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID5','11','1','$FacultyID5','$cafedraID5','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','6')") or die(mysqli_error($connection));
					break;
				case "6":
					//автор 2
					$cafedraID2 = $tutor_info2['cafedraID'];
					$FacultyID2 = $tutor_info2['FacultyID'];
					//автор 3
					$cafedraID3 = $tutor_info3['cafedraID'];
					$FacultyID3 = $tutor_info3['FacultyID'];
					//автор 4
					$cafedraID4 = $tutor_info4['cafedraID'];
					$FacultyID4 = $tutor_info4['FacultyID'];
					//автор 5
					$cafedraID5 = $tutor_info5['cafedraID'];
					$FacultyID5 = $tutor_info5['FacultyID'];
					//автор 6
					$cafedraID6 = $tutor_info6['cafedraID'];
					$FacultyID6 = $tutor_info6['FacultyID'];
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID','11','1','$FacultyID','$cafedraID','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','7')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID2','11','1','$FacultyID2','$cafedraID2','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','6')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID3','11','1','$FacultyID3','$cafedraID3','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','6')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID4','11','1','$FacultyID4','$cafedraID4','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','6')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID5','11','1','$FacultyID5','$cafedraID5','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','6')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID6','11','1','$FacultyID6','$cafedraID6','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','6')") or die(mysqli_error($connection));
					break;
				case "7":
					//автор 2
					$cafedraID2 = $tutor_info2['cafedraID'];
					$FacultyID2 = $tutor_info2['FacultyID'];
					//автор 3
					$cafedraID3 = $tutor_info3['cafedraID'];
					$FacultyID3 = $tutor_info3['FacultyID'];
					//автор 4
					$cafedraID4 = $tutor_info4['cafedraID'];
					$FacultyID4 = $tutor_info4['FacultyID'];
					//автор 5
					$cafedraID5 = $tutor_info5['cafedraID'];
					$FacultyID5 = $tutor_info5['FacultyID'];
					//автор 6
					$cafedraID6 = $tutor_info6['cafedraID'];
					$FacultyID6 = $tutor_info6['FacultyID'];
					//автор 7
					$cafedraID7 = $tutor_info7['cafedraID'];
					$FacultyID7 = $tutor_info7['FacultyID'];
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID','11','1','$FacultyID','$cafedraID','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','8')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID2','11','1','$FacultyID2','$cafedraID2','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','9')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID3','11','1','$FacultyID3','$cafedraID3','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','9')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID4','11','1','$FacultyID4','$cafedraID4','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','9')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID5','11','1','$FacultyID5','$cafedraID5','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','9')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID6','11','1','$FacultyID6','$cafedraID6','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','9')") or die(mysqli_error($connection));
					$query = mysqli_query($connection, "INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni, divBall) VALUES('$korsetkish','$TutorID6','11','1','$FacultyID6','$cafedraID6','$sani','$date','../files/$newfilename','-','$univ_avtor_san2','0','$eskertu','2','0','0','$save_date','9')") or die(mysqli_error($connection));
					break;
			    }
				header('Location: show_load_e.php');
			}
		}
		else if($file_size == FALSE){
			echo "<span style = 'color: red;'>FAIL TYM ÜLKEN</span>";
		} 
		else {
			
			$sql = "SELECT * FROM korsetkishter WHERE kod_korsetkish = '$korsetkish'";
			$res = mysqli_query($connection,$sql) or die(mysqli_error($connection));
			$korset_massiv = mysqli_fetch_array($res);
			
			$a = $korset_massiv['shekteu'];
			echo $a."<br />";
			
			$sql2 = "SELECT COUNT(engbekter.kod_korset) AS wCount, engbekter.kod_kizm FROM engbekter WHERE kod_kizm = '$TutorID' AND kod_korset = '$korsetkish'";
			$res2 = mysqli_query($connection,$sql2) or die(mysqli_error($connection));
			$korset_massiv2 = mysqli_fetch_array($res2);
			
			$b = $korset_massiv2['wCount'];
			echo $b."<br />";
			
			if($b < $a){

				$temp = explode(".", $file);
				$newfilename = $TutorID."_".round(time()) . '.' . end($temp);
				move_uploaded_file($file_temp, __DIR__ ."/../files/".$newfilename);
				if($sani == null ||  $sani == 0 ) 
				{
					$sani = 1;
				}				
				$query = mysqli_query($connection,"INSERT INTO engbekter(kod_korset, kod_kizm, kod_okujil, kod_univer, kod_fakul, kod_kafedra, sani, kuni,  file_ati, rastalu, univ_avtor_san, ball, eskertu, kod_stat, artik, ball8, saktalgan_kuni) VALUES('$korsetkish','$TutorID','11','1','$FacultyID','$cafedraID','$sani','$date','../files/$newfilename','-','$univ_avtor_san','0','$eskertu','2','0','0','$save_date')") or die(mysqli_error($connection));
				header('Location: show_load_e.php');
			} 
			else {
				header('Location: error.php');
			}
		}
	} else {
		echo "BIR QATE BAR";
	}
?>