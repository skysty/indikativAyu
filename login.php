<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INDIKATIV AYU</title>
  <script>
		history.pushState(null, null, location.href);
		window.onpopstate = function(event) {
			history.go(1);
		};
	</script>
  <link rel="shortcut icon" type="image/png" href="/img/favicon.png" />
  <link rel="stylesheet" href="../css/styles.min.css" />
  <?php
            if (isset($_GET['lang']) && $_GET['lang'] != 'kaz'){
		$inst = '../files/instructions_rus.pdf';
                $_SESSION['lang'] = $_GET['lang'];}
	    else{
			$inst = '../files/instructions_kz.pdf';
            }
			include('incs/connect.php');
		?>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <div class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="img/login_logo.png" width="180" alt="">
                </div>
                <p class="text-center"><?= $oL::get('Тілді өзгерту')?></p>
				<div style="text-align: center;" id="shortcuts_lang">
                    <select name="lang" id="lang" onchange="selectLang(this.value)">
                        <option value="kaz" <?= isset($_SESSION['lang']) && ($_SESSION['lang']) == 'kaz' ? 'selected' : ''; ?>><?= $oL::get('Қазақша')?></option>
                        <option value="tr" <?= isset($_SESSION['lang']) && ($_SESSION['lang']) == 'tr' ? 'selected' : ''; ?>><?= $oL::get('Turkçe')?></option>
                    </select>
                </div>
                <form action = "doLogin.php" method = "post" onsubmit="return validateForm()">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><?= $oL::get('Логин')?></label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="login" aria-describedby="emailHelp" placeholder = "<?= $oL::get('Email')?>">
					<span id="usernameError" style="color: red;"></span>
				</div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label"><?= $oL::get('Құпия сөз')?></label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder = "<?= $oL::get('Құпия сөзді теріңіз')?>">
					<span id="passwordError" style="color: red;"></span>
				</div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <a class="text-primary fw-bold" href="mail/index.php"><?= $oL::get('Құпия сөзді ұмыттым?')?></a>
                  </div>
				  <input type = "hidden" name = "lang" value = "<?= $_SESSION['lang'] ?? 'kaz'?>">
				  <input type = "submit" class="btn btn-primary w-100 fs-4 mb-4 rounded-2" name = "submit_login" value = "<?= $oL::get('Кіру')?>">
                  <!--<div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to Spike?</p>
                    <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a>
                  </div>-->
                </form>
				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
            function selectLang(lang) {
                console.log(lang);
                location.href = '/login.php?lang='+lang;
            }
        </script>
 <script type="text/javascript">
    function validateForm() {
      var username = document.getElementById('exampleInputEmail1').value;
      var password = document.getElementById('exampleInputPassword1').value;
      var usernameError = document.getElementById('usernameError');
      var passwordError = document.getElementById('passwordError');
      var isValid = true;

      // Reset error messages
      usernameError.textContent = '';
      passwordError.textContent = '';

      // Check if fields are empty
      if (username.trim() === '') {
        usernameError.textContent = '<?= $oL::get("Email-ді жазыңыз") ?>';
        isValid = false;
      }
      if (password.trim() === '') {
        passwordError.textContent = '<?= $oL::get("Құпия сөзді толтырыңыз") ?>';
        isValid = false;
      }

      return isValid;
    }
  </script>
  <script src="../js/jquery.js"></script>
  <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>