<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:index.php');
    exit(); // Exit to prevent further execution
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_info'])) { // Check if the update_info button is clicked
    // Assuming you have established the database connection already

    // Sanitize input
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $price = mysqli_real_escape_string($conn, $_POST['price']); // Retrieve price from form input
    $status = mysqli_real_escape_string($conn, $_POST['status']); // Retrieve status from select option

    // Update the database to set the price and status
    $query = "UPDATE website_economics SET price='$price', status='$status' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        // Handle error if query fails
        echo "Error updating record: " . mysqli_error($conn);
        exit(); // Exit to prevent further execution
    }
}

// Retrieve data from the database
$query = "SELECT * FROM website_economics WHERE status='pairing'";
$result = mysqli_query($conn, $query);

if (!$result) {
    // Handle error if query fails
    echo "Error retrieving records: " . mysqli_error($conn);
    exit(); // Exit to prevent further execution
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital@1&family=Roboto:ital,wght@0,300;0,500;1,400&family=VT323&display=swap"
        rel="stylesheet">
</head>

<body class="font-[VT323] bg-[url('../images/gray.jpg')] bg-cover">
    <nav
        class="bg-transparent backdrop-blur-lg border-2 sticky top-0 flex justify-between py-[0.2rem] items-center px-[5rem] z-10">
        <img src="../images/logo2.jpeg" alt="" class="w-[4rem] h-[4rem] rounded-md">

        <div class="flex gap-8 text-black text-[1.2rem]">
            <a href="admin_home.php" class="group transition-all duration-300">
                <span
                    class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                    Ticket
            </a>
            <a href="profile_admin.php" class="group transition-all duration-300">
                <span
                    class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                    Profile
            </a>
            <a href="status_admin.php" class="group transition-all duration-300">
                <span
                    class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                    Status
            </a>
        </div>
    </nav>

    <section class="w-[100%] h-[100vh] flex justify-center items-center">
        <div
            class="bg-white h-[40%] flex flex-col justify-center items-center px-2 py-4 w-[70rem] h-[35rem] rem border-2 rounded-lg">
            <h1 class="font-bold text-[2rem] ">STATUS</h1>
            <table class="flex flex-col justify-center table-auto">
                <!-- Your table header content -->
                <table class="flex flex-col justify-center w-full h-full table-auto pt-10">
                    <tr class="flex justify-around w-full text-[1.2rem] border-b-2 mb-4">
                        <th>Name</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Price</th> <!-- New column for price -->
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['name'] != null && $row['title'] != null && $row['start_datetime'] != null && $row['end_datetime'] != null && $row['service'] != null) {
                            echo "<tr class='relative left-7 flex justify-around w-full'>";
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['start_datetime'] . '</td>';
                            echo '<td>' . $row['end_datetime'] . '</td>';
                            echo '<td>' . $row['service'] . '</td>';
                            echo "<td>";
                            echo "<form method='post'>"; // Add form tag
                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; // Hidden input for id
                            echo "<select name='status'>"; // Add onchange event to submit form on selection change
                            echo "<option value='pairing'>Pairing</option>";
                            echo "<option value='completed'>Completed</option>";
                            echo "</select>";
                            echo "</td>";
                            echo "<td>"; // New cell for price input
                            echo "<input type='text' name='price' placeholder='Enter price'>"; // Input field for price
                            echo "</td>";
                            echo "<td>"; // New cell for submit button
                            echo "<button type='submit' name='update_info'>Update</button>"; // Button to submit form
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </table>

        </div>
    </section>
</body>

</html>
