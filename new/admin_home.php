<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital@1&family=Roboto:ital,wght@0,300;0,500;1,400&family=VT323&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: "Montserrat", sans-serif;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
    </style>
</head>

<body class="font-[VT323] bg-[url('../images/gray.jpg')]">
    <nav class="bg-transparent backdrop-blur-lg border-2 sticky top-0 flex justify-between py-[0.2rem] items-center px-[5rem] z-10">
        <img src="../images/logo2.jpeg" alt="" class="w-[4rem] h-[4rem] rounded-md">

        <div class="flex gap-8 text-black text-[1.2rem]">
            <a href="admin_home.php" class="group transition-all duration-300">
                <span class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                Ticket
            </a>
            <a href="profile_admin.php" class="group transition-all duration-300">
                <span class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                Profile
            </a>
            <a href="status_admin.php" class="group transition-all duration-300">
                <span class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                Status
            </a>
        </div>
    </nav>


    <div class="bg-dark bg-[url('../images/gray.jpg')]" style="">
        <div class="container py-5" id="page-container">
            <div class="row">
                <div class="col-md-9 bg-transparent backdrop-blur-lg border-2 p-2 rounded-lg">
                    <div id="calendar"></div>
                </div>
                <div class="col-md-3">
                    <div class="cardt rounded-0 shadow">
                        <div class="card-header bg-gradient bg-dark text-light">
                            <h5 class="card-title">Schedule Form</h5>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <form action="save_schedule_admin.php" method="post" id="schedule-form">
                                    <input type="hidden" name="id" value="">
                                    <div class="form-group mb-2">
                                        <label for="title" class="control-label">Name</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required readonly>
                                    </div>
                                    <?php $value = '
                                    <div class="form-group mb-2">
                                        <label for="description" class="control-label">Description</label>
                                        <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                    </div>'
                                    ?>
                                    <div class="form-group mb-2">
                                        <label for="start_datetime" class="control-label">Start</label>
                                        <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="end_datetime" class="control-label">End</label>
                                        <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button class="btn btn-dark btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                                <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Event Details Modal -->
        <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">
                    <div class="modal-header rounded-0">
                        <h5 class="modal-title">Schedule Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body rounded-0">
                        <div class="container-fluid">
                            <dl>
                                <dt class="text-muted"></dt>
                                <dd id="title" class="fw-bold fs-4"></dd>
                                <dt class="text-muted">Description</dt>
                                <dd id="description" class=""></dd>
                                <dt class="text-muted">Start</dt>
                                <dd id="start" class=""></dd>
                                <dt class="text-muted">End</dt>
                                <dd id="end" class=""></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="modal-footer rounded-0">
                        <div class="text-end text-black">
                            <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                            <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Event Details Modal -->

        <?php
        $schedules = $conn->query("SELECT * FROM `website_economics`");
        $sched_res = [];
        foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
            $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
            $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
            $sched_res[$row['id']] = $row;
        }
        ?>
        <?php
        if (isset($conn)) $conn->close();
        ?>

        <!-- Add this JavaScript code to handle delete action -->
        <script>
            $(document).ready(function() {
                // Function to handle delete button click
                $('#delete').click(function() {
                    var eventId = $(this).data('id'); // Get the event ID from the button's data-id attribute

                    // Send AJAX request to delete the event
                    $.ajax({
                        url: 'delete_schedule.php', // PHP script to handle deletion
                        method: 'POST',
                        data: {
                            id: eventId
                        }, // Send event ID to PHP script
                        success: function(response) {
                            // Reload the page after successful deletion
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>

</body>
</div>
<script>
    // Get the username from the PHP session
    var username = "<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>";

    // Auto-fill the input field with the username
    document.getElementById('title').value = username;
</script>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./js/script.js"></script>

</html>