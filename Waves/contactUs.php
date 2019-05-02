<?php

require ("Emailer.php");
require ("EmailValidator.php");

$subject = "";
$subjectError = "";
$message = "";
$messageError = "";
$userEmail = "";
$userEmailError = "";

if(isset($_POST["submit"])){

    $validator = new EmailValidator();
    $validEmail = true;

    if(isset($_POST["subject"])){
        $subject = $_POST["subject"];
    }

    if(isset($_POST["message"])){
        $message = $_POST["message"];
    }

    if(isset($_POST["userEmail"]) && $_POST["userEmail"] != ""){
        $userEmail = $_POST["userEmail"];
    } else{
        $userEmail = "wbrown1640@gmail.com";
    }

    if($validator->isEmpty($subject)){
        $validEmail = false;
        $subjectError = "Subject cannot be empty.";
    } elseif(!$validator->validateSubject($subject)){
        $validEmail = false;
        $subjectError = "Subject cannot be more than 25 characters.";
    }

    if($validator->isEmpty($message)){
        $validEmail = false;
        $messageError = "Message cannot be empty.";
    } elseif(!$validator->validateMessage($message)){
        $validEmail = false;
        $messageError = "Message cannot be more than 100 characters.";
    }

    if($validator->isEmpty($userEmail)){
        $validEmail = false;
        $userEmailError = "Email can be blank. You shouldn't see this message.";
    } elseif(!$validator->validateEmailAddress($userEmail)){
        $validEmail = false;
        $userEmailError = "Email is not valid.";
    }

    if($validEmail){

        $email = new Emailer();
        $email->setSenderAddress("wes@wdb40.com");
        $email->setSendToAddress($userEmail);
        $email->setSubjectLine($subject);
        $email->setMessageBody($message);

        $email->sendEmail();

        header('Location: index.html');

    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        Name: Wes Brown
        Date: 04/30/19
    -->

    <meta charset="UTF-8">
    <title>Contact Us</title>

    <meta name="description" content="Contact page for the WAVES Surfing School.">
    <meta name="keywords" content="waves,surf,surfing,lessons,california,contact">

    <link rel="stylesheet" type="text/css" href="css/standardStyle.css">
</head>
<body>

<header>
    <h1>W A V E S</h1>
    <img src="images/banner.png" alt="WAVES banner" title="WAVES banner">
</header>


<nav>
    <a href="index.html">Home</a>
    <a href="aboutUs.html">About Us</a>
    <a href="lessons.html">Lessons</a>
    <a href="camps.html">Camps</a>
    <a href="contactUs.html">Contact Us</a>
</nav>

<main>

    <h2>Send Us Questions</h2>
    <h3>Enter Email Information Below</h3>

    <form action="contactUs.php" method="post">

        <p>
            <label for="subject">Subject: </label>
            <input type="text" name="subject" id="subject" value="<?php echo $subject ?>">
            <span id="subjectError"><?php echo $subjectError ?></span>
        </p>

        <p>
            <label for="message">Message: </label>
            <span id="messageError"><?php echo $messageError ?></span>
        </p>

        <textarea name="message" id="message" cols="80" rows="10"><?php echo $message ?></textarea>

        <h3>Want a copy?</h3>
        <p>
            <label for="email">Enter Your Email: </label>
            <input type="text" id="email" name="userEmail" value="<?php echo $userEmail ?>">
            <span id="emailError"><?php echo $userEmailError ?></span>
        </p>

        <input type="submit" value="Send" name="submit">

    </form>
</main>

<section class="footer"></section>

</body>
</html>