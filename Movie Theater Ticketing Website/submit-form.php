<!-- reference:
https://stackoverflow.com/questions/18379238/send-email-with-php-from-html-form-on-submit-with-the-same-script -->

<?php 
if(isset($_POST['submit'])){
    $to = "yinp@oregonstate.edu"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$submission = "Name: ". $name . "\nEmail: " . $email . "\nSubject: " . $subject . 
	"\nMessage: " . $message;

    $headers = "From:" . $from;
    $headers .= 'Bcc: leesa6@oregonstate.edu' . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    mail($to,$subject,$message,$headers);

    echo "Your message has been received. Thank you.";

    }
?>