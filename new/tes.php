<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>User Profile</title>
</head>

<body class="bg-center bg-cover bg-no-repeat flex items-center justify-center min-h-screen">
    <div class="navbar" id="navbar">
        <img style="width: 20px; border-radius: 2px;" src="./images/logo2.jpeg" />
        <a href="home.php" class="text-white">Home</a>
        <a href="ticket.php" class="text-white">Ticket</a>
        <a href="profile.php" class="text-white">Profile</a>
        <a href="contactus.php" class="text-white">Contact</a>
    </div>
    <div class="profile-card bg-gray-900 w-96 text-center rounded overflow-hidden">
        <div class="card-header bg-gray-800 py-12 px-8 border-b-2 border-white backdrop-blur-20 shadow-lg text-white">
            <h1 class="top text-4xl font-semibold mb-4">User Profile</h1>
            <div class="profile">
                <div class="pic inline-block p-2 rounded-full bg-gradient-to-br from-blue-400 to-red-500">
                    <img src="images/pic.png" alt="" class="block w-24 h-24 rounded-full">
                </div>
                <div class="info text-lg text-red-500">
                    <?php echo "<p><strong>Username:</strong> " . $_SESSION['user_name'] . "</p>"; ?>
                    <?php echo "<p><strong>Email:</strong> " . $_SESSION['email'] . "</p>"; ?>
                </div>
                <a href="logout.php" class="contact-btn inline-block px-12 py-3 mt-4 border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition duration-300">Logout</a>
            </div>
        </div>
        <div class="card-footer bg-gray-200 py-12 px-4">
            <h1 class="top1 text-red-500 text-4xl font-semibold mb-4">History</h1>
            <div class="numbers">
                <table class="w-full">
                    <tr>
                        <th class="bg-gray-700 text-white py-4">Name</th>
                        <th class="bg-gray-700 text-white py-4">Start</th>
                        <th class="bg-gray-700 text-white py-4">End</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['name'] != null && $row['name'] == $_SESSION['user_name'] && $row['title'] != null && $row['start_datetime'] != null && $row['end_datetime'] != null) {
                            echo '<tr>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['start_datetime'] . '</td>';
                            echo '<td>' . $row['end_datetime'] . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
