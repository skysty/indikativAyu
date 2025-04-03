<?php
session_start();

// Check if user is logged in with temporary password, if not, redirect to login page
if (!isset($_SESSION['temp_password']) || $_SESSION['temp_password'] !== true) {
    header("location: login.php");
    exit;
}

// Include database connection settings
include('incs/connect.php'); // Assuming your database connection settings are in incs/connect.php

// Password change form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate passwords
    if ($newPassword !== $confirmPassword) {
        $error = "Құпия сөздер бір біріне сәйкес келемейді";
    } else {
        // Update password in the database
        $userId = $_SESSION['user_id'];
        $hashedPassword = md5($newPassword); // Hash the new password, you might want to use more secure hashing methods

        // Prepare the SQL query
        $sql = "UPDATE tutors SET Password = ?, temporary_password = false WHERE TutorID = ?";
        $stmt = mysqli_prepare($connection, $sql);

        // Check if preparation succeeded
        if ($stmt === false) {
            die("Error in SQL query: " . mysqli_error($connection));
        }

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, 'si', $hashedPassword, $userId);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Password changed successfully
            unset($_SESSION['temp_password']); // Unset temp_password flag
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
                default:
                    echo "Error in roles";
                    break;
            }
            exit;
        } else {
            $error = "Құпия сөзді жаңарту кезінде қате пайда болды:" . mysqli_error($connection);
            
        }
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $oL::get('Құпия сөзді өзгерту')?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <a style="float:right;" class="btn btn-danger"href="logout.php"><?= $oL::get('Шығу')?></a>
        <h2 class="mt-5 mb-3"><?= $oL::get('Құпия сөзді өзгерту')?></h2>
        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group row">
                <label for="new_password" class="col-sm-3 col-form-label"><?= $oL::get('Жаңа Құпия Сөз:')?></label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="confirm_password" class="col-sm-3 col-form-label"><?= $oL::get('Құпия сөзді растаңыз:')?></label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary"><?= $oL::get('Жаңарту')?></button>
                </div>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
