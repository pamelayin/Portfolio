<!-- reference:
https://stackoverflow.com/questions/18379238/send-email-with-php-from-html-form-on-submit-with-the-same-script -->
<?php 
if(isset($_POST['submit'])){
    $to = "yinp@oregonstate.edu";
    $from = $_POST['email']; 
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $submission = "Name: ". $name . "\nEmail: " . $from . "\nSubject: " . $subject . 
    "\nMessage: " . $message;

    $headers = "From:" .$from."\r\n";
    $headers = "Cc: ".$from."\r\n";
    $headers .= "Bcc: leesa6@oregonstate.edu\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    mail($to,$subject,$message,$headers);
    
    }
?>


<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css">	
	<title>Email Received</title>
</head>
<body style="text-align: center;">
<!-- menu -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #F5435B;">

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="main.html">Location</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="contact.html">Contact Us</a>
      </li>
    </ul>
  </div>
  <a class="navbar-brand" href="#">ANONE Premium Movie</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
</nav>
    <p style="margin-top: 100px">Your message has been received. Thank you.</p>
    <a class="btn btn-primary" href="main.html" role="button">Go Back to Main Page</a>
</body>
</html>