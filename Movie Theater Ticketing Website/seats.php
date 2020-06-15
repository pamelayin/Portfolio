<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This page enables user to select show time, ticket quantity, and ticket type for the date chosen.
-->
<?php
include 'dbcon.php';

$movieTitlePost = $_POST['movieTitle'];
$movieLocationPost = $_POST['location'];
$movieDatePost = $_POST['movieDate'];
$movieIdPost = $_POST['movieID'];

$mysqli = getCon();

date_default_timezone_set('America/Los_Angeles');

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Buy Ticket</title>
	<link rel="stylesheet" href="css/page.css" type="text/css">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
	<!-- Font Awesome-->
	<script src="https://kit.fontawesome.com/5e1bce92c7.js" crossorigin="anonymous"></script>

</head>

<body style="margin:0px; background-image: url('image/background.jpg');">
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

	<!-- banner -->
	<div class="jumbotron jumbotron-fluid" style="background-image:url('image/moviemain.jpg'); background-size:cover;">
		<div class="container" style="text-align:center; height:12%;">
			<span class="jumText">Reserve your seat</span>
		</div>
	</div>

	<!-- main -->
	<h1>Your movie<?php echo " in " . $movieLocationPost ?></h1>
	<div class="movieContent_inside" style="text-align:right;">
		<?php
		echo '<img src="image/' . $movieTitlePost . '.jpg " width="400px" class="img-fluid"></div>';
		?>
	</div>

	<div id="listGroup" class="movieContent_inside" style="text-align:left;">
		<form method="POST" action="transaction.php" class="needs-validation" style="padding-right:50%;">
			<?php
			$movie_time_sql = "SELECT * FROM films_schedule WHERE location_id = '" . $movieLocationPost . "' AND movie_date = '" . $movieDatePost . "' AND film_id = '" . $movieIdPost . "'";
			$movie_time_list = $mysqli->query($movie_time_sql);
			$num_row = $movie_time_list->num_rows;
			$time_table = array();
			$radio_time = 1;
			$num_time = 1;
			$num_form = 1;	//count number of forms
			$i = 0; // array parameter


			echo '<p><span style="font-weight:500;"> Movie Title</span>: ' . $movieTitlePost . '</p>';
			echo '<p><span style="font-weight:500;"> Movie Date</span>: ' . $movieDatePost . '</p>';
			// no showtimes
			if ($num_row == 0) {
				echo '<br><br><p style="font-weight:500; color: red;">Sorry, there are no showtimes for this movie for this date. <br>Please select another movie.</p><br>';
				echo '<br><input type="button" class="btn btn-danger" value="Go Back" onclick="history.back()">';
			} else {
				echo '<p style="margin-bottom:10px;"><span style="font-weight:500;"> Select Time</span>:<br><br> ';

				// get show times - toggle collapse/show
				while ($movie_time_list_row = $movie_time_list->fetch_array(MYSQLI_ASSOC)) {
					echo '<a class="btn btn-primary" data-toggle="collapse" href="#timeTable' . $num_time . '" role="button" aria-expanded="false" aria-controls="collapseExample">';
					echo $movie_time_list_row['start_time'] . "</a>";
					echo "&nbsp&nbsp&nbsp";
					$num_time = $num_time + 1;
					array_push($time_table, $movie_time_list_row['start_time']);
				}

				// get seat_available quantity
				while ($i < $num_row) {
					$movie_seat_sql = "SELECT * FROM films_schedule WHERE location_id = '" . $movieLocationPost . "' AND movie_date = '" . $movieDatePost . "' AND film_id = '" . $movieIdPost . "' AND start_time='" . $time_table[$i] . "'";
					$movie_seat_list = $mysqli->query($movie_seat_sql);
					$movie_seat_list_row = $movie_seat_list->fetch_array(MYSQLI_ASSOC);
					echo '<div class="collapse" id="timeTable' . $num_form . '" data-parent="#listGroup">';
					echo	'<form method="POST" action="transaction.php" class="needs-validation" style="padding-right:50%;">';
					echo	'<input type="hidden" id="location" name="location" value="' . $movieLocationPost . '">';
					echo	'<input type="hidden" id="movieID" name="movieID" value="' . $movieIdPost . '">';
					echo	'<input type="hidden" id="movieTitle" name="movieTitle" value="' . $movieTitlePost . '">';
					echo	'<input type="hidden" id="movieDate" name="movieDate" value="' . $movieDatePost . '">';
					echo	'<input type="hidden" id="scheduleId" name="scheduleId" value="' . $movie_seat_list_row['schedule_id'] . '">';
					echo	'<input type="hidden" id="movieTime" name="movieTime" value="' . $time_table[$i] . '">';
					echo	'<br><p><span style="font-weight:500;"> Ticket Type: </span><br><br>
					<div class="btn-group btn-group-toggle" data-toggle="buttons" style="display:inline-block; padding-bottom: 5%;">
						<label class="btn btn-primary active">
							<input type="radio" name="ticketPrice" id="ticketPrice" value="50" checked required>Regular Ticket ($50) &nbsp
						</label>
						<label class="btn btn-primary">
							<input type="radio" name="ticketPrice" id="ticketPrice" value="55" required>Special Ticket ($55)
						</label>
						<a target="_blank" href="#" title="Special tickets are limited edition collectable tickets.">
						<i class="fas fa-info-circle fa-lg"></i></a></div>';
					// seats available / not available
					if ($movie_seat_list_row['seat_available'] != 0) {
						echo '<p><span style="font-weight:500;"> Number of seats: </span><br><br>';
						echo '<input type="number" class="form-control" id="seat_qty" name = "seat_qty" min="1" max="' . $movie_seat_list_row['seat_available'] . '" placeholder="Available Seats: ' . $movie_seat_list_row['seat_available'] . '" required>';
						echo '<p id="priceTag"></p>';
						echo '<br><input type="submit" class="btn btn-primary" id="movieBuy" value="Next Step">';
					} else {
						echo '<input type="number" class="form-control" id="seat_qty" name = "seat_qty" placeholder="Ticket Sold Out" disabled>';
						echo '<br><input type="button" class="btn btn-danger" value="Go Back" onclick="history.back()">';
					}

					echo '</form>';
					echo '</div>';
					$i = $i + 1;
					$num_form = $num_form + 1;
				}
			}
			?>
		</form>
	</div>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

<footer>
</footer>

</html>