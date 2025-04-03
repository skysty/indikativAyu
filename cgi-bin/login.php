<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Логин беті</title>
	<link rel = "stylesheet" type = "text/css" href = "css/style.css">
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<script>
		history.pushState(null, null, location.href);
		window.onpopstate = function(event) {
			history.go(1);
		};
	</script>
	<style>
		input[type=text],input[type=password]{
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		input[type=submit] {
			width: 150px;
			background-color: #003366;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: 1px black solid;
			cursor: pointer;
		}

		input[type=submit]:hover {
			background-color: #000;
		}
		
		.login_form{
			margin: 0 auto;
			margin-top: 50px;
			width: 450px;
			padding: 30px;
			background: #eee;
			border: 1px black solid;
		}
		.login_inner{
			margin: 0 auto;
			width: 300px;
		}
		
		.footer{
			margin-top: 100px;
		}
	</style>
		<?php
            if (isset($_GET['lang']) && $_GET['lang'] != 'kaz'){
		$inst = '../files/instructions_rus.pdf';
                $_SESSION['lang'] = $_GET['lang'];}
	    else{
		//$_SESSION['lang'] = $_GET['lang'];}
	    
		$inst = '../files/instructions_kz.pdf';
            }
			include('incs/connect.php');
		?>
</head>
<body>
	<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;padding-top: 30px;"><?= $oL::get('ДУЛАТИ УНИВЕРСИТЕТІ')?></p>
	<p style = "font-size: 24px; text-align: center; color: #db261b; font-weight: bold;"><?= $oL::get('ІШКІ КӘСІБИ РЕЙТИНГІ')?></p>
	<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;"><?= $oL::get('Қош келдіңіз!!!') ?></p>
	<p style = "font-size: 24px; text-align: center; color: #db261b; font-weight: bold;"> <a target = "_blank" href = "<?php echo $inst; ?>"><?= $oL::get('Cайтқа кіру нұсқаулығын оқыңыз')?></a></p>
	 <!--<p style = "font-size: 24px; text-align: center; color: ##06ADD2 ; font-weight: bold;"> Серверден ақау шығуына байланысты сайт уақытша жұмыс жасамайды</p> -->
	<div class = "content">
		<div class = "login_form">
			<div class = "login_inner">
			
				<img src = "img/login_logo.png" style = "width: 200px; margin-left: 50px;">
				<form action = "doLogin.php" method = "post">
					<table>
						<tr>
							<td>
								<strong><?= $oL::get('Логин')?></strong>
								
							</td>
							<td>
								<input type = "text" name = "login" value = "" placeholder = "<?= $oL::get('Логинді теріңіз')?>">
							</td>
						</tr>
						<tr>
							<td>
								<strong><?= $oL::get('Құпия сөз')?></strong>
							</td>
							<td>
								<input type = "password" name = "password" placeholder = "<?= $oL::get('Құпия сөзді теріңіз')?>">
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
								<input type = "hidden" name = "lang" value = "<?= $_SESSION['lang'] ?? 'kaz'?>">
								<input type = "submit" name = "submit_login" value = "<?= $oL::get('Кіру')?>">
							</td>
						</tr>
                        <tr>
							<td>
							</td>
							<td>
								<a href="mail/index.php"><br><?= $oL::get('Құпия сөзді ұмыттым?')?></br></a>
							</td>
						</tr>                                               
					</table>
				</form>
                <div id="shortcuts_lang">
                    <select name="lang" id="lang" onchange="selectLang(this.value)">
                        <option value="kaz" <?= isset($_SESSION['lang']) && ($_SESSION['lang']) == 'kaz' ? 'selected' : ''; ?>><?= $oL::get('Қазақша')?></option>
                        <option value="rus" <?= isset($_SESSION['lang']) && ($_SESSION['lang']) == 'rus' ? 'selected' : ''; ?>><?= $oL::get('Орыс тілі')?></option>
                    </select>
                </div>
			</div>
		</div>
		<p style = "font-size: 24px; text-align: center; color: ##06ADD2 ; font-weight: bold;"><?= $oL::get('Сайтқа қатысты сұрақтар болса')?> </p>
		<p style = "font-size: 14px; text-align: center; color: ##06ADD2 ; font-weight: bold;">webmaster@dulaty.kz</p>
		<div class = "footer">
	</div>
        <script type="text/javascript">
            function selectLang(lang) {
                console.log(lang);
                location.href = '/login.php?lang='+lang;
            }
        </script>
</body>
</html>