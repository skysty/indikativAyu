<?php
    include('../incs/connect.php');

    if (isset($_POST['id'])) {
        $engbekID = mysqli_real_escape_string($connection, $_POST['id']);
    
        // Check the value of divBall
        $sql = "SELECT divBall, ball, kod_stat FROM engbekter WHERE engbekID = '$engbekID'";
        $result = mysqli_query($connection, $sql);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $divBall = $row['divBall'];
            $ball = $row['ball'];
            $kod_stat = $row['kod_stat'];
            // Update the record based on divBall value
            if ($kod_stat == 4 || $ball != 0) {
                echo json_encode(array('success' => false, 'message' => 'Кешіріңіз көрсеткіш тексерілгендіктен өшірілмейді'));
            } else {
                $updateSql = "UPDATE engbekter SET del = 1 WHERE engbekID = '$engbekID'";
                $updateResult = mysqli_query($connection, $updateSql);
    
                if ($updateResult) {
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Жазбаны жаңарту мүмкін болмады'));
                }
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Жазба табылмады'));
        }
    
        mysqli_close($connection);
    }
    
?>