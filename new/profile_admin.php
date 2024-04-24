<?php @include 'config.php';
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:index.php');
} ?>
<?PHP
if (!isset($_SESSION['title'])) {
    header('location:index.php');
}
?>
<?php
include 'config.php';
$sql = "SELECT name, email, user_type FROM website_economics";
$result = mysqli_query($conn, $sql);
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
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital@1&family=Roboto:ital,wght@0,300;0,500;1,400&family=VT323&display=swap" rel="stylesheet">
</head>
<body class="font-[VT323] bg-[url('../images/gray.jpg')] bg-cover">
    <nav class="bg-transparent backdrop-blur-lg border-2 sticky top-0 flex justify-between py-[0.2rem] items-center px-[5rem]">
        <img src="../images/logo2.jpeg" alt="" class="w-[4rem] h-[4rem] rounded-md">

        <div class="flex gap-8 text-black text-[1.2rem]">
            <a href="admin_home.php" class="group transition-all duration-300 hover:text-blue-500">
                <span class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                Ticket
            </a>
            <a href="profile_admin.php" class="group transition-all duration-300 hover:text-blue-500">
                <span class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                Profile
            </a>
            <a href="status_admin.php" class="group transition-all duration-300">
                <span class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                Status
            </a>
            

        </div>
    </nav>

    <section class="w-[100%] h-[100vh] flex justify-center items-center">
        <div class="flex flex-col bg-black w-[70rem] h-[35rem] bg-transparent backdrop-blur-lg border-2 rounded-lg">
            <div class="flex flex-col justify-center items-center h-[60%] gap-2">
                <h1>User Profile</h1>
                <div class="h-[100px] w-[100px] rounded-full bg-red-400">

                </div>
                <?php echo "<p><strong>Username:</strong> " . $_SESSION['user_name'] . "</p>"; ?>
                <?php echo "<p><strong>Email:</strong> " . $_SESSION['email'] . "</p>"; ?>
                <a href="logout.php"><button class="text-red-400 border-2 border-red-400 px-6 py-1 rounded-lg hover:bg-red-400 hover:text-white transition-all duration-300">Log out</button></a>
            </div>

            <div class="bg-white h-[40%] flex flex-col justify-around items-center px-2 py-4">
                <h1 class="font-bold text-[2rem] ">Account</h1>
                <?php
            include 'config.php';

            if (isset($_POST['delete'])) {
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $name = $_POST['name'];

                $sql = "DELETE FROM `website_economics` WHERE `name` = '$name'";

                if (mysqli_query($conn, $sql)) {
                    echo "Record deleted successfully";
                } else {
                    echo "Error deleting record: " . mysqli_error($conn);
                }
            }

            $sql = "SELECT * FROM website_economics";
            $result = mysqli_query($conn, $sql);

            echo '<div class="numbers">';
            echo '<table class="flex flex-col justify-center w-full h-full table-auto">';
            echo '<tr class="flex justify-around w-[100vh] text-[1.4rem] border-b-2 mb-4">
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Action</th>
            </tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['name'] != null && $row['email'] != null && $row['user_type'] != null) {
                    echo '<tr class=" flex justify-around w-full ">';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['user_type'] . '</td>';
                    echo '<td>
                    <form method="post" action="">
                        <input type="hidden" name="name" value="' . $row['name'] . '">
                        <input style="border: none; background-color: red; color: white; border-radius: 2px; heigh: 30px; width: 50px; cursor:pointer" type="submit" name="delete" value="Delete">
                    </form>
            </td>';
                    echo '</tr>';
                }
            }

            echo '</table>';
            echo '</div>';

            // mysqli_close($conn); // Remove this line to fix the error
            ?>
            </div>

        </div>
    </section>
</body>
</html>