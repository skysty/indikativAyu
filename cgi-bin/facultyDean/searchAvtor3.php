<?php
// Connect to the database using mysqli
include('../incs/connect.php');
header('Content-Type: text/html; charset=utf-8');
if (!empty($_POST["keyword"])) {
    $search = $_POST["keyword"] . '%';
    $stmt = mysqli_prepare($connection, "SELECT * FROM tutors WHERE firstname LIKE ? 
    OR lastname LIKE ? 
    OR patronymic LIKE ? 
    and deleted = 0  and CafedraID=0
    ORDER BY firstname LIMIT 0,6");
    if (!$stmt) {
        die('Statement preparation failed: ' . mysqli_error($connection));
    }
    mysqli_stmt_bind_param($stmt, 'sss', $search, $search, $search);
    if (!mysqli_stmt_execute($stmt)) {
        die('Statement execution failed: ' . mysqli_error($connection));
    }
    $result = mysqli_stmt_get_result($stmt);
    if (!empty($result)) {
?>
        <ul id="country-list">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <li onClick="selectAvtor3('<?php echo $row['Login'] ?>');">
                    <?php echo $row['lastname'] . ' ' . $row['firstname'] . ' ' . $row['patronymic']; ?>
                </li>
            <?php
            }// end while
            ?> 
        </ul>
<?php
    }// end if not empty
    mysqli_stmt_close($stmt);
}
mysqli_close($connection);
?>