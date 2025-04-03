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
        $error = "Passwords do not match.";
    } else {
        // Update password in the database
        $userId = $_SESSION['user_id'];
        $hashedPassword = md5($newPassword); // Hash the new password, you might want to use more secure hashing methods

        // Prepare the SQL query
        $sql = "UPDATE tutors SET Password = ?, temporary_password = false WHERE ID = ?";
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
            header("location: login.php"); // Redirect to login page
            exit;
        } else {
            $error = "Error updating password: " . mysqli_error($connection);
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
    <title>Change Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<<div id = "menu_nav">
		<?php include '../extensions/nav.php'; ?>
	</div>
    <div class="container">
        <h2 class="mt-5 mb-3">Change Password</h2>
        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group row">
                <label for="new_password" class="col-sm-3 col-form-label">New Password:</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="confirm_password" class="col-sm-3 col-form-label">Confirm New Password:</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Change Password</button>
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
