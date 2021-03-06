<?php
$title = 'Joined events - Eventers';
include '../includes/joiners_header.php';
include '../includes/joiners_navbar.php';
require '../../db/dbconfig.php';
include '../../global/functions/functions.php';
?>

<div class="container">
    <div class="row mt-4">
        <div class="row mx-auto mb-2">
            <h3 class="h3 text-center text-primary">Your Joined Events</h3>
        </div>
        <?php
        $imgDestination = "../../global/uploads/subEventThumbnail/";
        $email = $_SESSION['email'];
        $sql = "SELECT EVENT_ID FROM `joined_events` WHERE EMAIL = '$email'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $event_id = $row['EVENT_ID'];
                $sql_2 = "SELECT * FROM `event_details` WHERE ID = '$event_id'";
                $result_2 = mysqli_query($link, $sql_2);
                if (mysqli_num_rows($result_2) > 0) {
                    while ($row_data_2 = mysqli_fetch_assoc($result_2)) {
        ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row_data_2['SUB_EVENT_NAME']; ?></h5>
                                    <h6 class="card-subtitle text-muted"><?php echo $row_data_2['EVENT_NAME']; ?></h6>
                                </div>
                                <img class="img card-img-top" width="200px" height="125px" src="<?php echo $imgDestination . $row_data_2['THUMBNAIL']; ?>" alt="">
                                <div class="card-body">

                                    <p class="card-text">
                                        <?php
                                        echo turnacteString($row_data_2['DESCRIPTION'], 85, false);
                                        ?>
                                    </p>
                                    <div class="row p-0 mb-2" style="border: none !important;">
                                        <div class="col">
                                            Location: <?php echo $row_data_2['PLACE']; ?>
                                        </div>
                                        <div class="col">
                                            Date: <?php echo date('d F Y', strtotime($row_data_2['TIME'])); ?>
                                        </div>
                                    </div>
                                    <form action="viewEvent.php" method="get">

                                        <input type="hidden" name="joinedEventID" value=<?php echo $row_data_2["ID"]; ?>>
                                        <button type="submit" class="btn btn-outline-primary btn-sm btn-block w-50">View</button>
                                        <a href="joined-event.php" class="btn btn-outline-primary btn-sm btn-block w-30">
                                            Read more
                                        </a>
                                        <a href="#" class="btn btn-outline-secondary btn-sm">
                                        <i class='bx bxs-heart' ></i>
                                        </a>
                                    </form>


                                </div>
                            </div>
                        </div>
        <?php
                    }
                }
            }
        } else {
            echo "<h3>You have not joined any events yet.</h3>";
        }
        ?>
    </div>
</div>

<?php
include '../includes/joiners_footer.php'
?>