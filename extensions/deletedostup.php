<?php
    include('../incs/connect.php');

    if (isset($_POST['korset'])) {
        $ID = mysqli_real_escape_string($connection, $_POST['korset']);

        // Check the value of divBall
       
                $updateSql = "UPDATE dostupkorset SET dostup = 1 WHERE Id = '$ID'";
                $updateResult = mysqli_query($connection, $updateSql);

                if ($updateResult) {
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Жазбаны жаңарту мүмкін болмады'));
                }
            }
         else {
            echo json_encode(array('success' => false, 'message' => 'Жазба табылмады'));
        }
    

    mysqli_close($connection);
?>
