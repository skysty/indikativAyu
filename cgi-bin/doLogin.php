<?php
include('incs/connect.php');

if (isset($_GET['lang']) && $_GET['lang'] != 'kaz'){
    $_SESSION['lang'] = $_GET['lang']; //unset($_GET['lang']);
}
?>
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Қате</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
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
	<div class = "upper_header">
		<img src = "../img/login_logo.png" style = "width: 200px; float:left;">
		<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;">ДУЛАТИ УНИВЕРСИТЕТІ</p>
		<p style = "font-size: 24px; text-align: center; color: red;font-weight: bold;">ІШКІ КӘСІБИ РЕЙТИНГІ</p></br>
<div style = "font-size: 18px; text-align: center; color: #0094de;font-weight: bold;">		
<?php
$result= mysqli_query($connection,"SELECT text_jildar FROM jildar WHERE id_jildar = '1'");;
while($row = mysqli_fetch_array($result)){
	echo $row['text_jildar'];
 }

?>
</div></br>		
	</div>
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
				if(isset($_POST['submit_login'])){
					if(isset($_POST['login'])){
						if(isset($_POST['password'])){
							$query = mysqli_query($connection, "SELECT * FROM tutors WHERE Login = '$_POST[login]'") or die(mysqli_error());
							$tutor = mysqli_fetch_array($query);
							
							$password = $_POST['password'];
							
							$pass = md5($password);
							
							if($pass == $tutor['Password']){
								
								$_SESSION['tutor'] = $tutor['Login'];
								
								$_SESSION['roleID'] = $tutor['roleID'];
								$_SESSION['lang'] = $_POST['lang'] ?? 'kaz';

								if($_SESSION['roleID'] == 1){
									header('Location: tutor/index.php');
								} else if($_SESSION['roleID'] == 2){
									header('Location: admin/index.php');
								} else if($_SESSION['roleID'] == 3){
									header('Location: moderator/index.php');
								} else if($_SESSION['roleID'] == 4){
									header('Location: cafedraManager/index.php');
								} else if($_SESSION['roleID'] == 5){
									header('Location: facultyDean/index.php');
								} else if($_SESSION['roleID'] == 6){
									header('Location: first_moderator/index.php');
								} else {
									echo "Error in roles";
								}
							} else {
								echo "<h2 style = 'color: red; text-align: center;'>Логин немесе құпия сөзді тексеріңіз</h2><br />";
								echo "<h3 style = 'color: red; text-align: center;'><a href = 'login.php' id='backBtn'>Артқа қайту</a><h3>";
							}
						} else {
							echo "Қате № 2";
							include('login.php');
						}
					} else {
						echo "Қате № 3";
						include('login.php');
					}
				} else {
					echo "Қате № 4";
					include('login.php');
				}
			?>
		</div>
	</div>
</body>
</html>