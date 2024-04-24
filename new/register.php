<?php

@include 'config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM website_economics WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $error[] = 'user already exist!';
    } else {

        if ($pass != $cpass) {
            $error[] = 'password not matched!';
        } else {
            $insert = "INSERT INTO website_economics(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:index.php');
        }
    }
}
;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍪☞  ＰＵｔα 𝔩σ𝔤 𝕚Ň  🍔💗</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital@1&family=Roboto:ital,wght@0,300;0,500;1,400&family=VT323&display=swap" rel="stylesheet">
</head>
<body class="flex items-center font-[VT323] bg-[url('../images/gray.jpg')] bg-no-repeat bg-cover  select-none">
    <section class="w-[100%] h-[100vh] flex items-center justify-center">
        <div class="px-[4rem] py-[3rem] bg-transparent backdrop-blur-lg border-2 rounded-lg shadow-lg flex flex-col items-center justify-center space-y-4">
            <form action="" method="post" class="flex flex-col items-center justify-center space-y-4">
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    }
                    ;
                }
                ;
                ?>

                <h1 class="font-bold text-[2.5rem] border-b-4 px-4">Register</h1>
                <input type="text" name="name" id="" placeholder="Enter your Name" class="border-2 rounded-full px-4 py-2 text-[1.2rem] w-[20rem]">
                <input type="email" name="email" id="" placeholder="Enter your Email Address" class="border-2 rounded-full px-4 py-2 text-[1.2rem] w-[20rem]">
                <input type="password" name="password" id="" placeholder="Enter your Password" class="border-2 rounded-full px-4 py-2 text-[1.2rem] w-[20rem]">
                <input type="password" name="cpassword" id="" placeholder="Confirm your Password" class="border-2 rounded-full px-4 py-2 text-[1.2rem] w-[20rem]">
                <div class="pilih">
                <select name="user_type">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                    </select>
                </div>
                <button name="submit" class="border-2 border-gray-100 rounded-lg px-2 py-2 w-[14rem] hover:scale-110 transition-all duration-300 hover:text-white hover:bg-blue-400">Register</button>
                <p>Already have an account? <a href="index.php" class="text-blue-400">Login here</a>!</p>
            </form>
        </div>
    </section>
</body>
</html>
