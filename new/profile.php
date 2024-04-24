<?php
@include 'config.php';
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:index.php');
}

if (!isset($_SESSION['title'])) {
    header('location:index.php');
}

if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    // Update status to 'done' in the database
    $update_sql = "UPDATE website_economics SET status = 'done' WHERE id = $id";
    mysqli_query($conn, $update_sql);
}

$sql = "SELECT name, title, start_datetime, status, service, end_datetime 
FROM website_economics 
WHERE status = 'done'";

$result = mysqli_query($conn, $sql);
$sql2 = "SELECT name, id, title, price, start_datetime, service, end_datetime, status 
    FROM website_economics 
    WHERE service = 'repair' AND (status ='pairing' OR status = 'completed') AND name = '{$_SESSION['user_name']}'";


$result2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital@1&family=Roboto:ital,wght@0,300;0,500;1,400&family=VT323&display=swap"
        rel="stylesheet">
</head>

<body class="font-[VT323] bg-[url('../images/gray.jpg')] bg-cover">
    <nav
        class="bg-transparent backdrop-blur-lg border-2 sticky top-0 flex justify-between py-[0.2rem] items-center px-[5rem]">
        <img src="../images/logo2.jpeg" alt="" class="w-[4rem] h-[4rem] rounded-md">

        <div class="flex gap-8 text-black text-[1.2rem]">
            <a href="home.php" class="group transition-all duration-300 hover:text-blue-500">
                <span
                    class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                    Home
            </a>
            <a href="ticket.php" class="group transition-all duration-300 hover:text-blue-500">
                <span
                    class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                    Ticket
            </a>
            <a href="profile.php" class="group transition-all duration-300 hover:text-blue-500">
                <span
                    class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                    Profile
            </a>
            <a href="contact.php" class="group transition-all duration-300 hover:text-blue-500">
                <span
                    class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                    Contact Us
            </a>

        </div>
    </nav>

    <section class="w-[100%] h-[100vh] flex justify-center items-center">
        <div class="flex flex-col bg-black w-[70rem] h-[35rem] bg-transparent backdrop-blur-lg border-2 rounded-lg">
            <div class="flex flex-col justify-center items-center h-[60%] gap-2">
                <h1>User Profile</h1>
                <div class="h-[100px] w-[100px] rounded-full bg-red-400"></div>
                <?php echo "<p><strong>Username:</strong> " . $_SESSION['user_name'] . "</p>"; ?>
                <?php echo "<p><strong>Email:</strong> " . $_SESSION['email'] . "</p>"; ?>
                <a href="logout.php"><button
                        class="text-red-400 border-2 border-red-400 px-6 py-1 rounded-lg hover:bg-red-400 hover:text-white transition-all duration-300">Log
                        out</button></a>
            </div>

            <div class="bg-white h-[40%] flex flex-col justify-center items-center px-2 py-4 w-full h-full ">
                <h1 class="font-bold text-[2rem]">Update</h1>
                <table class="flex flex-col justify-center w-full h-full table-auto">
                    <tr class="flex justify-around w-full text-[1.2rem] border-b-2 mb-4">
                        <th>Name</th>
                        <th>Price</th> <!-- Corrected column name -->
                        <th>Status</th> <!-- New column for status -->
                        <th>Action</th> <!-- New column for action -->
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result2)) {
                        if ($row['name'] != null && $row['name'] == $_SESSION['user_name'] && $row['title'] != null && $row['start_datetime'] != null && $row['end_datetime'] != null ) {
                            echo "<tr class='relative left-7 flex justify-around w-full'>";
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['price'] . '</td>'; // Output price column
                            echo '<td>' . $row['status'] . '</td>'; // Output status column
                            // Action button column
                            echo '<td>';
                            if ($row['status'] != 'pairing') {
                                echo '<form action="profile.php" method="post">';
                                echo '<input type="hidden" name="id" value="' . $row['id'] . '"/>';
                                echo '<button type="submit" name="update_status" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Receive</button>';
                                echo '</form>';
                            } else {
                                echo 'Cannot update';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </table>

                <h1 class="font-bold text-[2rem] ">History</h1>
                <table class="flex flex-col justify-center w-full h-full table-auto">
                    <tr class="flex justify-around w-full text-[1.2rem] border-b-2 mb-4">
                        <th>Name</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Service</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['name'] != null && $row['name'] == $_SESSION['user_name'] && $row['title'] != null && $row['start_datetime'] != null && $row['end_datetime'] != null && $row['service'] != null ) {
                            echo "<tr class='relative left-7 flex justify-around w-full'>";
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['start_datetime'] . '</td>';
                            echo '<td>' . $row['end_datetime'] . '</td>';
                            echo '<td>' . $row['service'] . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </table>
            </div>


    </section>
</body>

</html>