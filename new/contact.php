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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body class="font-[VT323] bg-[url('../images/gray.jpg')] bg-no-repeat bg-fill md:bg-cover select-none">

    <nav class="bg-transparent backdrop-blur-lg border-2 sticky top-0 flex justify-between py-[0.2rem] items-center px-[5rem] z-10">
        <img src="../images/logo2.jpeg" alt="" class="w-[4rem] h-[4rem] rounded-md">

        <div class="flex gap-8 text-black text-[1.2rem]">
            <a href="home.php" class="group transition-all duration-300 hover:text-blue-500">
                <span class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                Home
            </a>
            <a href="ticket.php" class="group transition-all duration-300 hover:text-blue-500">
                <span class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                Ticket
            </a>
            <a href="profile.php" class="group transition-all duration-300 hover:text-blue-500">
                <span class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                Profile
            </a>
            <a href="contact.php" class="group transition-all duration-300 hover:text-blue-500">
                <span class="bg-left-bottom bg-gradient-to-r from-black to-black bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-300 ease-out">
                Contact Us
            </a>

        </div>
    </nav>

    <section class="w-[100%] md:h-[100vh] h-[100%] my-[10rem] md:my-0 flex items-center justify-center">
        <div class="px-[8rem] py-[4rem] bg-transparent border-2 backdrop-blur-lg rounded-lg flex flex-col items-center justify-center  shadow-lg">
            <h1 class="mb-4 text-[2.5rem] font-bold border-b-4">Contact Us!</h1>
            <div class="flex flex-col items-center justify-center md:flex-row gap-[6rem]">
                <div>
                    <form action="" class="flex flex-col gap-4">
                        <input type="text" name="name" id="" placeholder="Your Name" class="border-2 rounded-lg px-2 py-1 text-[1.2rem] w-[20rem]">
                        <input type="text" name="email" id="" placeholder="Your Email Address" class="border-2 rounded-lg px-2 py-1 text-[1.2rem] w-[20rem]">
                        <textarea name="message" class="resize-none border-2 rounded-lg px-2 py-1 text-[1.2rem] w-[20rem]" rows="8" placeholder="Type a message..."></textarea>
                        <button id="submit" type="submit" value="SEND" class="px-2 py-4 border-2 bg-white rounded-lg hover:bg-blue-400 transition-all hover:scale-105 hover:text-white duration-300 gap-2 flex items-center justify-center"><i class="fa fa-telegram"></i>Submit</button>
                    </form>
                </div>
                <div class="border-2 bg-white rounded-lg w-[15rem] h-[26.7rem] gap-4 flex flex-col items-center justify-center">
                    <h1>Address</h1>
                    <h1>email@gmail.com</h1>
                    <h1>+6291212435678</h1>
                </div>
            </div>
        </div>
    </section>
</body>

<?php
// Initialize variables
$message = '';
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Get data from the form
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$to = "dumsurfer88@gmail.com";
	$subject = "Contact Form Submission";

	// Check if the message is not empty and email is valid
	if (!empty ($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// Compose the email body
		$txt = "Name: $name\n";
		$txt .= "Email: $email\n\n";
		$txt .= "Message:\n$message";

		// Set additional headers
		$headers = "From: noreply@demosite.com\r\n";
		$headers .= "CC: somebodyelse@example.com\r\n";

		// Send the email
		$success = mail($to, $subject, $txt, $headers);
	} else {
		$message = "Please fill in the message field and provide a valid email address.";
	}
}
?>

</html>