<?php
    include('../incs/connect.php');

    if (isset($_POST['opk'])) {
        $ID = mysqli_real_escape_string($connection, $_POST['opk']);

        // Check the value of divBall
       
                $updateSql = "UPDATE engbekter SET del = 1 WHERE engbekID = '$ID'";
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
