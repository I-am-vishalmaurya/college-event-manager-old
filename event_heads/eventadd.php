<?php
$title = "Manage events - Eventers";
$bodyColor = "bg-light";
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container-fluid  p-4">

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="form-group row border-0">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select name="event_name" class="form-select" placeholder="Select event name" id="eventNameDD">
                                    <?php
                                    include_once 'db/dbconfig.php';
                                    $email = $_SESSION['email'];
                                    $sqlEventNameDD = "SELECT event_name FROM events_name WHERE HOSTED_BY = '$email'";
                                    $result = mysqli_query($link, $sqlEventNameDD);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?php echo $row['event_name']; ?>"><?php echo $row['event_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" name="sub_event_name" placeholder="Sub-event Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="college_name" placeholder="College Name">

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="place" placeholder="City" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="dtttextbox" name="time" placeholder="Date & Time" required>
                                <script>
                                    var dtt = document.getElementById('dtttextbox')
                                    dtt.onfocus = function(event) {
                                        this.type = 'datetime-local';
                                        this.focus();
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" name="head_name" class="form-control form-control-user" placeholder="Event head name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <textarea class="form-control form-control-user" name="description" placeholder="Enter details about event" required rows="3"></textarea>
                            </div>
                        </div>

                        <button type="submit" id="post_event_btn" name="post-event-button" class="btn btn-primary btn-user btn-block w-100">
                            Post Event
                        </button>

                    </form>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Events</h1>
    </div>
    <!-- Total No of events card -->
    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-left-info rounded shadow h-100 pt-2 pb-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                                Total Events
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                4
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ---x--- Total No of events card----x---- -->
        <!-- Total No of registred people in events -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary-text text-uppercase mb-2">
                                Total Registration
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                120
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- -----x----- Total No of registred people in events-----x---- -->

    </div>

    <div class="row">
        <div class="text-start my-2">
            <h3 class="h3 text-gray-700 text-bold">Manage subevent</h3>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">

            <button class="btn p-3 border-primary font-weight-bold h-100" data-toggle="modal" data-target="#exampleModalCenter"><i class='bx bx-plus'> Add event</i></button>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <button class="btn p-3 border-primary font-weight-bold h-100"><i class='bx bx-plus'> Search event</i></button>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="showevent.php"><button class="btn p-3 border-primary font-weight-bold h-100"><i class='bx bx-plus'> Show event</i></button></a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <button class="btn p-3 border-primary font-weight-bold h-100"><i class='bx bx-plus'> Show event</i></button>
        </div>

    </div>
</div>
<?php
$event_name = $sub_event_name = $college_name = $place = $time = $head_name = $description = '';
if (isset($_POST['post-event-button'])) {
    $event_name = mysqli_real_escape_string($link, $_POST['event_name']);
    $sub_event_name = mysqli_real_escape_string($link, $_POST['sub_event_name']);
    $college_name = mysqli_real_escape_string($link, $_POST['college_name']);
    $place = mysqli_real_escape_string($link, $_POST['place']);
    $time = ($_POST['time']);
    $head_name = mysqli_real_escape_string($link, $_POST['head_name']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $email =  $_SESSION["email"];

    if ($event_name == $sub_event_name) {
        $_SESSION['status'] = 'Event and sub event name should be different.';
    } else {

        $sql = "INSERT INTO `event_details` (`EVENT_NAME`, `SUB_EVENT_NAME`,`unique_email`, `COLLEGE_NAME`, `PLACE`, `TIME`, `EVENT_HEAD_NAME`, `DESCRIPTION`) VALUES (?,?,?,?,?,?,?,?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssss", $event_name, $sub_event_name, $email, $college_name, $place, $time, $head_name, $description);
        }

        if ($bp = mysqli_stmt_execute($stmt)) {

            echo '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="btn-close" data-dismiss="alert"></button>
                <strong>Well done!</strong> You added event successfully.
                </div>';
        } else {
            $_SESSION['status'] = "Ops! Something went wrong.";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

?>

<?php
include 'includes/footer.php';
?>