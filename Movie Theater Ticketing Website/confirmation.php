<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This page takes all user input and create order/tickets and update seat_available in schedule accordingly.
				It will print out all information on page and send copy to user's email.
-->

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="css/page.css" type="text/css">

	<!-- Bootstrap core JavaScript
    ================================================== 
	Placed at top to load modal -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<title>Order Confirmation</title>
</head>

<body style="margin:0px; background-image: url('image/background.jpg');">
	<!-- navbar -->
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

	<!-- banner -->
	<div class="jumbotron jumbotron-fluid" style="background-image:url('image/moviemain.jpg'); background-size:cover;">
		<div class="container" style="text-align:center; height:12%;">
			<span class="jumText">Order Confirmation</span>
		</div>
	</div>

	<!-- existing email check -->
	<div class="modal fade" id="email_check_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Customer Info Check</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h6>Your customer information exists in our database. </h6>
					<p>Your previously registered information will be used for transaction. If you wish to change your customer information, please contact our customer service.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<?php
	include 'dbcon.php';

	if (isset($_POST['submit_order'])) {
		$scheduleIdPost = $_POST['scheduleId'];
		$movieLocationPost = $_POST['location'];
		$movieIdPost = $_POST['movieID'];
		$movieTitlePost = $_POST['movieTitle'];
		$movieDatePost = $_POST['movieDate'];
		$movieTimePost = $_POST['movieTime'];
		$movieTicketTypePost = $_POST['ticketType'];
		$movieTicketPricePost = $_POST['ticketPrice'];
		$movieSeatQtyPost = $_POST['seat_qty'];
		$firstNamePost = $_POST['firstName'];
		$lastNamePost = $_POST['lastName'];
		$custom_dob = $_POST['dob'];
		$custom_email = $_POST['email'];

		if (empty($_POST['phone'])) {
			$custom_phone = "";
		} else {
			$custom_phone = $_POST['phone'];
		}

		date_default_timezone_set('America/Los_Angeles');
		$today = date("y-m-d");
		$count = $movieSeatQtyPost;

		$mysqli = getCon();

		$totalprice = $movieSeatQtyPost * $movieTicketPricePost;

		//insert customer
		$customer_insert = "INSERT INTO customers (customer_first_name, customer_last_name, customer_dob, customer_email, customer_phone)
						VALUES ('$firstNamePost', '$lastNamePost', '$custom_dob', '$custom_email', '$custom_phone')";
		$customer_new = $mysqli->query($customer_insert);

		// if existing customer, show modal
		if ($customer_new === FALSE) {
			echo "<script type='text/javascript'>$('#email_check_modal').modal('show');</script>";
		}

		$customer_info_sql = "SELECT * FROM customers WHERE customer_email = '$custom_email'";
		$customer_info_sql_list = $mysqli->query($customer_info_sql);
		$customer_info_sql_list_row = $customer_info_sql_list->fetch_array(MYSQLI_ASSOC);

		// if existing customer, retrieve info from database
		if ($customer_new === FALSE) {
			$firstNamePost = $customer_info_sql_list_row['customer_first_name'];
			$lastNamePost = $customer_info_sql_list_row['customer_last_name'];
			$custom_dob = $customer_info_sql_list_row['customer_dob'];
			$custom_email = $customer_info_sql_list_row['customer_email'];
			$custom_phone =
				$customer_info_sql_list_row['customer_phone'];
		}

		//add order
		$orders_insert = "INSERT INTO orders (customer_email, order_date, order_quantity, order_price)
						VALUES ('{$customer_info_sql_list_row['customer_email']}', '$today', '$movieSeatQtyPost', '$totalprice')";

		if (mysqli_query($mysqli, $orders_insert)) {
			$order_id = mysqli_insert_id($mysqli);
		} else {
			echo $mysqli->error;
		}

		$orders_info_sql = "SELECT * FROM orders WHERE order_id = '$order_id'";
		$orders_info_sql_list = $mysqli->query($orders_info_sql);
		$orders_info_sql_list_row = $orders_info_sql_list->fetch_array(MYSQLI_ASSOC);

		//get_schedule_id
		$schedule_sql = "SELECT * FROM films_schedule WHERE schedule_id = '$scheduleIdPost'";
		$schedule_sql_list = $mysqli->query($schedule_sql);
		$schedule_sql_list_row = $schedule_sql_list->fetch_array(MYSQLI_ASSOC);

		$updatedSeatQty = $schedule_sql_list_row['seat_available'] - $movieSeatQtyPost;

		$schedule_seat_update_sql = "UPDATE films_schedule SET seat_available=$updatedSeatQty WHERE schedule_id = '$scheduleIdPost'";
		$schedule_seat_update = mysqli_query($mysqli, $schedule_seat_update_sql) or die($mysqli->error);

		//add tickets
		while ($count > 0) {

			$ticket_insert = "INSERT INTO tickets (schedule_id, ticket_type, ticket_price, order_id)
							VALUES ('{$schedule_sql_list_row['schedule_id']}', '$movieTicketTypePost', '$movieTicketPricePost','{$orders_info_sql_list_row['order_id']}')";
			if (mysqli_query($mysqli, $ticket_insert)) {
				$count = $count - 1;
			} else {
				echo $mysqli->error;
			}
		}

		$ticket_id_sql = "SELECT * FROM tickets WHERE order_id = '$order_id'";
		$ticket_sql_list = $mysqli->query($ticket_id_sql);
	}
	?>
	<h1>See you soon!</h1>

	<!-- order confirmation summary -->
	<p style="text-align: center;">Please keep a copy of this page for your record.</p>

	<div style="background-image: url('image/ticket_bg.png'); background-repeat: no-repeat; background-size: 700px 300px; background-position: center;">
		<div style=" height:300px; text-align:center;">

			<h3 style="padding-top: 30px; color:black;">Order Confirmation</h3>
			Order ID: <?php echo $order_id ?><br>
			Movie Title: <?php echo $movieTitlePost ?><br>
			Name: <?php echo $firstNamePost . " " . $lastNamePost ?><br>
			Location: <?php echo $movieLocationPost ?><br>
			Movie Show Time: <?php echo $movieDatePost . " at " . $movieTimePost . " PST"; ?><br>
			Ticket Type: <?php echo $movieTicketTypePost ?><br>
			Ticket Quantity: <?php echo $movieSeatQtyPost ?><br>
			Ticket ID:
			<!-- display tickets separated by comma -->
			<?php
			
			$ticketInfo = "";
			if ($ticket_sql_list->num_rows > 0) {
				//output data of each row
				while ($ticket_row = mysqli_fetch_assoc($ticket_sql_list)) {
					$ticketInfo .= $ticket_row['ticket_id'] . ", ";
				}
				// source: https://stackoverflow.com/questions/8585624/php-conditional-output-for-last-record-in-a-resultset/8585656
				$ticketInfo = rtrim($ticketInfo, ", ");
				echo $ticketInfo;
			} else {
				$mysqli->error;
			}

			// mail to customer
			$to = $custom_email;
			$from = "order-confirmation@ANONE.com";
			$name = "ANONE Customer Service";
			$subject = "ANONE Ticket Order Confirmation";

			$message = '<html><body>
				<div style=" height:300px; text-align:center;"><h2 style="background-color: #F5435B;">ANONE The Premium Movie </h2><br><h3>Order Confirmation</h3>Order ID: ' . $order_id . '<br>
				Movie Title: ' . $movieTitlePost . '<br>
				Name: ' . $firstNamePost . " " . $lastNamePost . '<br>
				Location: ' . $movieLocationPost . '<br>
				Movie Show Time: ' . $movieDatePost . " at " . $movieTimePost . ' PST<br>
				Ticket Type: ' . $movieTicketTypePost . '<br>
				Ticket Quantity: ' . $movieSeatQtyPost . '<br>
				Ticket ID: ' . $ticketInfo . '<br><p>Please contact us if you have any questions or concerns regarding this order confirmation.</p>';
			$message .= '</div></body></html>';

			$headers = "From:" . $from . "\r\n";
			$headers .= "Bcc: yinp@oregonstate.edu, leesa6@oregonstate.edu"."\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			mail($to, $subject, $message, $headers);

			?>
		</div>
	</div>
	<div style="text-align: center">
		<br><a href="main.html" class='btn btn-primary btn-sm'>Back to main</a>
	</div>

</body>

</html>