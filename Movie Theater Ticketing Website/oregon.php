<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This is movie selection page for Oregon location. It retrieves film information from 
				films table and dates from films_schedule table. 
-->
<?php
include 'dbcon.php';

$mysqli = getCon();

//movie_list
$m_list_sql = "SELECT fm.film_title FROM films fm INNER JOIN films_schedule fs ON fm.film_id = fs.film_id WHERE location_id = 'OR_ANONE' AND showing_now='Y'  GROUP BY film_title";
$m_list = $mysqli->query($m_list_sql);

date_default_timezone_set('America/Los_Angeles');

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>The Premium Movie</title>

	<!-- css files -->
	<link rel="stylesheet" href="css/page.css" type="text/css">
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css">

	<!-- bootstrap js files -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body style="margin:0px; background-image: url('image/background.jpg');">
	<!-- nav bar -->
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #F5435B;">
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="main.html">Location<span class="sr-only">(current)</span></a>
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
			<span class="jumText">ANONE in Oregon</span>
		</div>
	</div>

	<!-- movie list -->
	<div id="listGroup">
		<h1>Please select a movie</h1>
		<div class="spaceblock"></div><br>
		<div style="text-align:center;">
			<?php
			$num = 1;
			while ($m_list_row = $m_list->fetch_array(MYSQLI_ASSOC)) {
				echo '<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample' . $num . '" role="button" aria-expanded="false" aria-controls="collapseExample">';
				echo $m_list_row['film_title'] . "</a>";
				$num = $num + 1;
			}
			?>
		</div>

		<?php
		// enable user to select movies starting tomorrow's showtime
		$tomorrow = Date('Y-m-d', strtotime('+1 day'));
		$counter = 1;

		$m_title_list_sql = "SELECT * FROM films fm INNER JOIN films_schedule fs ON fm.film_id = fs.film_id WHERE location_id = 'LA_ANONE' AND showing_now='Y' GROUP BY film_title";
		$m_title_list = $mysqli->query($m_title_list_sql);

		// get movie info and films_schedule info
		echo '<div class="movieContent">';
		while ($m_title_row = $m_title_list->fetch_array(MYSQLI_ASSOC)) {
			echo '<div class="collapse" id="collapseExample' . $counter . '" data-parent="#listGroup">';
			echo '<div class="movieContent_inside" style = "text-align:right;">';
			echo '<img src="image/' . $m_title_row['film_title'] . '.jpg " width="400px" class="img-fluid"></div>';
			echo '<div class="movieContent_inside" style = "text-align:left;">';
			echo '<span style="font-weight:bold;">Movie Title </span>[ ';
			echo $m_title_row['film_title'] . ' ]<br>';
			echo '<span style="font-weight:bold;">Run Time </span>[ ';
			echo $m_title_row['runtime'] . 'Mins ]<br>';
			echo '<span style="font-weight:bold;">Age Rating </span>[ ';
			echo $m_title_row['age_rating'] . ' ]<br>';
			echo '<span style="font-weight:bold;">About Moive</span>';
			echo '<div style="width:45%;">';
			echo $m_title_row['film_description'] . '<br>';
			echo '<form method="POST" style="padding-top:25%;" action="seats.php">';
			echo '<input type="hidden" id="location" name="location" value="OR_ANONE">';
			echo '<input type="hidden" id="movieID" name="movieID" value="' . $m_title_row['film_id'] . '">';
			echo '<input type="hidden" id="movieTitle" name="movieTitle" value="' . $m_title_row['film_title'] . '">';
			echo '<h5>Please select a date to proceed to ticket purchase.</h5>';
			echo '<input type="date" id="movieDate" name="movieDate" min="' . $tomorrow . '" max="' . $m_title_row['down_date'] . '" required><br><br>';
			echo '<input type="submit" class="btn btn-primary" id="movieBuy" value="Buy Tickets">';
			echo '</form>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			$counter = $counter + 1;
		}

		echo '</div>';
		?>
	</div><br>

</body>
<footer>
</footer>

</html>