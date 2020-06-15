<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
    Description: This page brings all the user selected information from location and seats page. 
                This page asks user to input contact information and card info. Card information is not collected, only validated.
-->
<?php
include 'dbcon.php';

$mysqli = getCon();

$movieLocationPost = $_POST['location'];
$movieIdPost = $_POST['movieID'];
$movieTitlePost = $_POST['movieTitle'];
$movieDatePost = $_POST['movieDate'];
$movieTimePost = $_POST['movieTime'];
$movieTicketPricePost = $_POST['ticketPrice'];
$seatQtyPost = $_POST['seat_qty'];
$scheduleIdPost = $_POST['scheduleId'];

$total_price = number_format($movieTicketPricePost) * $seatQtyPost;

if ($movieTicketPricePost == 50) {
    $ticket_type = 'Regular';
} else {
    $ticket_type = 'Special';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Premium Movie</title>

    <!-- template used -->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

    <!-- css files -->
    <link rel="stylesheet" href="css/page.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link href="css/form-validation.css" rel="stylesheet">

</head>

<body class="bg-light" style="margin:0px; background-image: url('image/background.jpg')" ;>
    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #F5435B;">
        <div class="collapse navbar-collapse">
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
    </nav>

    <!--banner -->
    <div class="jumbotron jumbotron-fluid" style="background-image:url('image/moviemain.jpg'); background-size:cover;">
        <div class="container" style="text-align:center; height:12%;">
            <span class="jumText">Payment</span>
        </div>
    </div>

    <!--Display movie info-->
    <div class="container" style="width:100%; margin-bottom:7%;">
        <p style="font-size: 30px; font-weight:600; text-align:center;">You Movie Information</p>
        <div style="float:left; text-align:left; width:50%; padding-left:25%;">
            <?php
            echo '<p><span style="font-weight:500;"> Movie Title</span>: ' . $movieTitlePost . '<br>';
            echo '<span style="font-weight:500;"> Movie Date</span>: ' . $movieDatePost . '<br>';
            echo '<span style="font-weight:500;"> Movie Time</span>: ' . $movieTimePost . '<br>';
            echo '<span style="font-weight:500;"> Location</span>: ' . $movieLocationPost . '<br>';
            ?>
        </div>
        <div style="float:right; text-align:left; width:50%; padding-left:2%; ">
            <?php

            echo '<span style="font-weight: 500;"> Ticket Type</span>: ' . $ticket_type . '<br>';
            echo '<span style="font-weight:500;"> Number of Seats</span>: ' . $seatQtyPost . '<br>';
            echo '<span style="font-weight:500;"> Total Price</span>: $' . $total_price . '<br>';
            ?>
        </div>
    </div>

    <br>
    <div class="spaceblock"></div><br>

    <!--Form-->
    <div class="container">
        <p style="font-size: 25px; font-weight:450; text-align:center;">Payment Information</p>
        <p class="lead" style="text-align:center;">Please check your reservation info and complete the payment</p>
        <form method="POST" action="confirmation.php" class="needs-validation" novalidate>

            <div class="row">
                <!-- customer info -->
                <div style="float:left; margin-right:2%; width: 48%; padding: 5%; background-color: rgba(245,67,91, 0.1)">
                    <h4 class="mb-3">Personal Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName"><span style="font-weight:500;">First Name</span></label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                            <div class="invalid-feedback">
                                Please input your first name.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName"><span style="font-weight:500;">Last Name</span></label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                            <div class="invalid-feedback">
                                Please input your last name.
                            </div>
                        </div>
                    </div>
                    <!-- validate age to be adult (18+ yrs) -->
                    <?php
                    $today = date("y-m-d");
                    $mimnum_age = Date('Y-m-d', strtotime('-18 years'));
                    ?>
                    <div class="mb-3">
                        <label for="date"><span style="font-weight:500;">Date of Birth</span></label>
                        <input type="date" class="form-control" id="dob" name="dob" placeholder="yyyy-mm-dd" max="<?php echo $mimnum_age; ?>" required>
                        <div class="invalid-feedback">
                            You must be 18 years or older to purchase ticket.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email"><span style="font-weight:500;">Email* </span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone"><span style="font-weight:500;">Phone</span><span class="text-muted"> (Optional)</span></label>
                        <input type="tel" pattern="[0-9]{3}[-]?[0-9]{3}[-]?[0-9]{4}" class="form-control" id="phone" name="phone" placeholder="xxx-xxx-xxxx">
                        <div class="invalid-feedback">
                            Please enter a valid phone number. (format: xxx-xxx-xxxx)
                        </div>
                        <br>
                        <p class="text-muted">* Order confirmation will be sent to your email.</p>
                    </div>
                </div>
                <!-- payment info -->
                <div style="float:right; margin-left: 2%; width:48%; padding: 5%; background-color: rgba(245,67,91, 0.1)">
                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Full name is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" pattern="[0-9]{16}" class="form-control" id="cc-number" placeholder="" required>
                            <div class="invalid-feedback">
                                Please input valid credit card number.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" pattern="(?:0[1-9]|1[0-2])[/]?[0-9]{2}" class="form-control" id="cc-expiration" placeholder="MM/YY" required>
                            <div class="invalid-feedback">
                                Please input valid expiration date in MM/YY format.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cc-expiration">CVV</label>
                            <input type="text" pattern="[0-9]{3}" class="form-control" id="cc-cvv" required>
                            <div class="invalid-feedback">
                                Please input valid 3 digit CVV code.
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">

                    <input type="hidden" id="location" name="location" value="<?php echo $movieLocationPost; ?>">
                    <input type="hidden" id="movieID" name="movieID" value="<?php echo $movieIdPost; ?>">
                    <input type="hidden" id="movieTitle" name="movieTitle" value="<?php echo $movieTitlePost; ?>">
                    <input type="hidden" id="movieDate" name="movieDate" value="<?php echo $movieDatePost; ?>">
                    <input type="hidden" id="location" name="movieTime" value="<?php echo $movieTimePost; ?>">
                    <input type="hidden" id="ticketType" name="ticketType" value="<?php echo $ticket_type; ?>">
                    <input type="hidden" id="ticketPrice" name="ticketPrice" value="<?php echo $movieTicketPricePost; ?>">
                    <input type="hidden" id="seat_qty" name="seat_qty" value="<?php echo $seatQtyPost; ?>">
                    <input type="hidden" id="scheduleId" name="scheduleId" value="<?php echo $scheduleIdPost; ?>">
                    <input type="hidden" id="totalPrice" name="totalPrice" value="<?php echo $total_price; ?>">

                </div>
                <div style="text-align: center; width: 100%; padding-bottom: 5%; padding-top: 2%;">
                    <button class="btn btn-primary btn-lg" type="submit" name="submit_order">Continue to checkout</button>
                </div>
            </div>
        </form>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script>
        // source: https://stackoverflow.com/questions/31352499/add-dash-in-auto-complete-phone-number/31352575
        // add dash in between phone numbers
        $(function() {
            $('#phone').keydown(function(e) {
                var key = e.charCode || e.keyCode || 0;
                $text = $(this);
                if (key !== 8 && key !== 9) {
                    if ($text.val().length === 3) {
                        $text.val($text.val() + '-');
                    }
                    if ($text.val().length === 7) {
                        $text.val($text.val() + '-');
                    }
                }
                return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
            })
        });
        
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>