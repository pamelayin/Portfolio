<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This page enables user to create, read, update, and delete films_schedule table in database.
				This page has filter to see schedules based on theater location. 
-->
<?php
require_once 'process.php';

date_default_timezone_set('America/Los_Angeles');
$today = date("y-m-d");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>ANONE Database Admin Dashboard</title>

	<!-- template used -->
	<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">

	<!-- css files used -->
	<link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="../css/dashboard.css" type="text/css">
	<link rel="stylesheet" href="../bootstrap-table/dist/bootstrap-table.min.css" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="../bootstrap-table/dist/extensions/sticky-header/bootstrap-table-sticky-header.min.css" type="text/css">

</head>

<!-- top navbar -->

<body style="overflow-x:hidden;">
	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
		<a class="navbar-brand col-sm-2 col-md-2 mr-0" href="#">ANONE Database</a>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" name="logout" href="admin_logout.php">Sign out</a>
			</li>
		</ul>
	</nav>

	<!-- side navbar -->
	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link " href="admin_movies.php">
								<span data-feather="home"></span>
								Movie List
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="admin_schedules.php">
								<span data-feather="file"></span>
								Schedules <span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admin_locations.php">
								<span data-feather="map"></span>
								Locations
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admin_orders.php">
								<span data-feather="shopping-cart"></span>
								Orders/Tickets
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admin_customers.php">
								<span data-feather="users"></span>
								Customers
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
		<!-- source:https://www.youtube.com/watch?v=3xRMUDC74Cw	 -->
		<!-- session message displayed when there's update/error to SQL query -->
		<?php
		if (isset($_SESSION['message'])) : ?>
			<div class="alert alert-<?php echo $_SESSION['msg_type'] ?> alert-dismissible" role="alert">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
				?>
			</div>
		<?php endif; ?>

		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
			<h1 class="h2">Control Data</h1>
		</div>

		<!--schedule data form -->
		<div style="float:left; width:100%; padding-right: 2%;">
			<form method="post" action="process.php">
				<input type="hidden" class="form-control" id="schedule_id" name="schedule_id" value="<?php echo $schedule_id; ?>">
				<div class="form-group row">
					<label for="film_id" class="col-sm-2 col-form-label">Film ID</label>
					<div class="col-sm-8">
						<?php
						if ($update_schedule == true) :
						?>
							<input type="TEXT" class="form-control" id="film_id" name="film_id" value="<?php echo $schedule_film_id; ?>" readonly>
						<?php else : ?>
							<!-- movie dropdown list for current movie showings -->
							<select class="form-control" id="film_id" name="film_id">
								<?php
								$film_id_sql = "SELECT * FROM films WHERE showing_now ='Y'";
								$film_id_list = $mysqli->query($film_id_sql);
								while ($film_id_row = $film_id_list->fetch_array(MYSQLI_ASSOC)) {
									echo '<option value="' . $film_id_row['film_id'] . '">' . $film_id_row['film_id'] . '</option>';
								}
								?>
							</select>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group row">
					<label for="location_id" class="col-sm-2 col-form-label">Location ID</label>
					<div class="col-sm-8">
						<?php
						if ($update_schedule == true) :
						?>
							<input type="TEXT" class="form-control" id="location_id" name="location_id" value="<?php echo $schedule_location_id; ?>" readonly>
						<?php else : ?>
							<!-- location dropdown list -->
							<select class="form-control" id="location_id" name="location_id">
								<?php
								$location_id_sql = "SELECT * FROM locations";
								$location_id_list = $mysqli->query($location_id_sql);
								while ($location_id_row = $location_id_list->fetch_array(MYSQLI_ASSOC)) {
									echo '<option value="' . $location_id_row['location_id'] . '">' . $location_id_row['location_id'] . '</option>';
								}
								?>
							</select>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group row">
					<label for="movie_date" class="col-sm-2 col-form-label">Movie Date</label>
					<div class="col-sm-8">
						<input type="date" class="form-control" id="movie_date" name="movie_date" min="<?php echo $today; ?>" value="<?php echo $schedule_date; ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="start_time" class="col-sm-2 col-form-label">Start Time</label>
					<div class="col-sm-8">
						<input type="text" pattern="([01]?[0-9]{1}|2[0-3]{1}):[0-5]{1}[0-9]{1}" class="form-control" id="start_time" name="start_time" value="<?php echo $schedule_time; ?>" placeholder="ex: 13:20" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="seat_available" class="col-sm-2 col-form-label">Seats</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" id="seat_available" name="seat_available" max="10" value="<?php echo $schedule_seat; ?>" placeholder="10" required>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-8">
						<?php
						if ($update_schedule == true) :
						?>
							<button type="submit" class="btn btn-info" name="update_schedule">Update Schedule</button>
						<?php else : ?>
							<button type="submit" class="btn btn-primary" name="add_schedule">Add Schedule</button>
						<?php endif; ?>
					</div>
				</div>
			</form>
		</div>

		<!-- schedules data table -->
		<div style="float:left; width:100%;">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
				<h2>Movie Schedule</h2>
				<!-- filter by location -->
				<div class="dropdown" id="filter_btn">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter by Location<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="admin_schedules.php?filter_schedule=ALL" class="btn btn-sm">ALL</a></li>
						<?php
						$location_sql = "SELECT * FROM locations";
						$location_list = $mysqli->query($location_sql);
						while ($location_row = $location_list->fetch_array(MYSQLI_ASSOC)) {
							echo '<li><a href="admin_schedules.php?filter_schedule=' . $location_row['location_id'] . '" class="btn btn-sm">' . $location_row['location_id'] . '</a></li>';
						}
						?>
					</ul>
				</div>
			</div>
			<div class="table-responsive" style="height:320px;">
				<table class="table table-hover table-sm bootstrap-table" data-toggle="table" data-search="true" data-search-align="left" data-show-search-button="true">
					<thead class="thead-dark sticky-header">
						<tr>
							<th>Schedule ID</th>
							<th>Movie Title</th>
							<th>Location ID</th>
							<th>Date</th>
							<th>Start Time</th>
							<th>Seat Available</th>
							<th>Action</th>
						</tr>
					</thead>
					<!-- table for filtered location -->
					<?php if ($filter_schedule == true) : ?>
						<tbody>
							<?php
							$filter_movies_schedule = "SELECT * FROM films_schedule fms INNER JOIN films fm ON fms.film_id = fm.film_id WHERE location_id='$schedule_filter_id' ORDER BY movie_date ASC, film_title ASC";
							$filter_movies_schedule_list = $mysqli->query($filter_movies_schedule);

							while ($filter_schedule_list_row = $filter_movies_schedule_list->fetch_array(MYSQLI_ASSOC)) {
								echo "<tr><td>" . $filter_schedule_list_row['schedule_id'] . "</td>";
								echo "<td>" . $filter_schedule_list_row['film_title'] . "</td>";
								echo "<td>" . $filter_schedule_list_row['location_id'] . "</td>";
								echo "<td>" . $filter_schedule_list_row['movie_date'] . "</td>";
								echo "<td>" . $filter_schedule_list_row['start_time'] . "</td>";
								echo "<td>" . $filter_schedule_list_row['seat_available'] . "</td>";
								echo '<td><a href="admin_schedules.php?edit_schedule=' . $filter_schedule_list_row['schedule_id'] . '" class="btn btn-sm"><span data-feather="edit"></span>Edit</a>';
								echo '<a href="process.php?delete_schedule=' . $filter_schedule_list_row['schedule_id'] . '" class="btn btn-sm"><span data-feather="trash-2"></span>Delete</a></td>';
								echo '</tr>';
							}
							?>
						</tbody>
						<!-- table for all locations (unfiltered) -->
					<?php else : ?>
						<tbody>
							<?php
							$movies_schedule = "SELECT * FROM films_schedule fms INNER JOIN films fm ON fms.film_id = fm.film_id ORDER BY movie_date ASC, film_title ASC";
							$schedule_list = $mysqli->query($movies_schedule);

							while ($schedule_list_row = $schedule_list->fetch_array(MYSQLI_ASSOC)) {
								echo "<tr><td>" . $schedule_list_row['schedule_id'] . "</td>";
								echo "<td>" . $schedule_list_row['film_title'] . "</td>";
								echo "<td>" . $schedule_list_row['location_id'] . "</td>";
								echo "<td>" . $schedule_list_row['movie_date'] . "</td>";
								echo "<td>" . $schedule_list_row['start_time'] . "</td>";
								echo "<td>" . $schedule_list_row['seat_available'] . "</td>";
								echo '<td><a href="admin_schedules.php?edit_schedule=' . $schedule_list_row['schedule_id'] . '" class="btn btn-sm"><span data-feather="edit"></span>Edit</a>';
								echo '<a href="process.php?delete_schedule=' . $schedule_list_row['schedule_id'] . '" class="btn btn-sm"><span data-feather="trash-2"></span>Delete</a></td>';
								echo '</tr>';
							}
							$schedule_list->free();
							?>
						</tbody>
					<?php endif; ?>
				</table>

			</div>
		</div>
	</main>

	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>

	<!-- bootstrap-table plugin -->
	<script src="../bootstrap-table/dist/bootstrap-table.min.js"></script>
	<script src="../bootstrap-table/dist/extensions/sticky-header/bootstrap-table-sticky-header.min.js"></script>

	<!-- Icons -->
	<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
	<script>
		feather.replace()
	</script>

</body>

</html>