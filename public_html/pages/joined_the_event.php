<?php
session_start();

include '../db/dbconfig.php';
include '../includes/ph_header.php';

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['eventjoin'];
    $email = $_SESSION['email'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $sql = "SELECT * FROM joined_events WHERE EVENT_ID = '$id'";
    $result = mysqli_query($link, $sql);
    if ($answer = mysqli_fetch_assoc($result)) {
        if ($answer['EMAIL'] == $email) {
            echo '<div class="alert alert-dismissible alert-warning">
                     <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                     <h4 class="alert-heading">Warning!</h4>
                     <p class="mb-0">You have already joined this event.</p>
                 </div>';
        } 
    }
    else {
            $sql_to_insert = 'INSERT INTO `joined_events` (`EMAIL`, `FIRST_NAME`, `LAST_NAME`, `EVENT_ID`) VALUES(?,?,?,?)';
            if ($stmt = mysqli_prepare($link, $sql_to_insert)) {
                mysqli_stmt_bind_param($stmt, "sssi", $email, $first_name, $last_name, $id);
            }
            if ($exe = mysqli_stmt_execute($stmt)) {
                echo '<div class="alert alert-dismissible alert-success">
                 <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                 <strong>Well done!</strong> You joined the event successfully <a href="../index.php" class="alert-link">Redirect to previous page</a>.
                 </div>';
            }
        }
    }



?>

<?php
include '../includes/ph_footer.php';
?>