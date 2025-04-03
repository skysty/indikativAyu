<?php
include('incs/connect.php');

if (isset($_POST['lang']) && $_POST['lang'] != 'kaz'){
    $_SESSION['lang'] = $_POST['lang']; //unset($_GET['lang']);
}
?>
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?= $oL::get('Қате')?></title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<style>
		#backBtn{
			color: white; 
			text-decoration: none; 
			padding: 20px; 
			background:gray; 
			border:1px black solid;
		}
		#backBtn:hover{
			background: red;
			color:black;
		}
	</style>
</head>
<body>
	<div class = "header">
		<div id = "menu_nav">
			<nav id="primary_nav_wrap">
			</nav>
		</div>
	</div>
	<div class = "content">
		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 5px;">
			<?php
			
				session_start();
				if (isset($_POST['submit_login'])) {
					if (isset($_POST['login']) && isset($_POST['password'])) {
						$login = $_POST['login'];
						$password = $_POST['password'];
				
						// Validate inputs
						if (empty($login) || empty($password)) {
							echo "<h2 style='color: red; text-align: center;'>Логин немесе құпия сөзді тексеріңіз</h2><br />";
							include('login.php');
							exit;
						}
				
						// Prepared statement to avoid SQL injection
						$query = "SELECT * FROM tutors WHERE  mail = ? LIMIT 1";
						$stmt = mysqli_prepare($connection, $query);
						mysqli_stmt_bind_param($stmt, 's', $login);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
				        
						if ($result && $tutor = mysqli_fetch_assoc($result)) {
							$pass = md5($password);
				
							if ($pass == $tutor['Password']) {
								$_SESSION['lang'] = $_POST['lang'] ?? 'kaz';
								$_SESSION['roleID'] = $tutor['roleID'];
								// Check if user has a temporary password
								if ($tutor['temporary_password']) {
									$_SESSION['temp_password'] = true;
									$_SESSION['user_id'] = $tutor['TutorID']; // Assuming the user id is stored in the 'ID' column
									header("location: ch_password.php");
									exit;
								}

								// User authenticated successfully, set session variables
								$_SESSION['tutor'] = $tutor['mail'];
								$_SESSION['roleID'] = $tutor['roleID'];
								$_SESSION['lang'] = $_POST['lang'] ?? 'kaz';
				
								switch ($_SESSION['roleID']) {
									case 1:
										header('Location: tutor/index.php');
										break;
									case 2:
										header('Location: admin/index.php');
										break;
									case 3:
										header('Location: moderator/index.php');
										break;
									case 4:
										header('Location: cafedraManager/index.php');
										break;
									case 5:
										header('Location: facultyDean/index.php');
										break;
									case 6:
										header('Location: first_moderator/index.php');
										break;
									case 7:
										header('Location: bakylaushy/index.php');
										break;
									default:
										echo "Error in roles";
										break;
								}
								exit;
							} else {
								echo "<h2 style='color: red; text-align: center;'>Логин немесе құпия сөзді тексеріңіз</h2><br />";
								echo "<h3 style = 'color: red; text-align: center;'><a href = 'login.php' id='backBtn'>Артқа қайту</a><h3>";
							}
						} else {
							echo "<h2 style='color: red; text-align: center;'>Жүйеге кіруге рұқсат жоқ</h2><br />";
							echo "<h3 style = 'color: red; text-align: center;'><a href = 'login.php' id='backBtn'>Артқа қайту</a><h3>";
						}
					} else {
						echo "<h2 style='color: red; text-align: center;'>Логин немесе құпия сөзді тексеріңіз</h2><br />";
						echo "<h3 style = 'color: red; text-align: center;'><a href = 'login.php' id='backBtn'>Артқа қайту</a><h3>";
					}
				}
			?>
		</div>
	</div>
</body>
</html>