<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This page enables user to create, read, update, and delete films table in database. 
				
-->
<?php
require_once 'process.php';

//query for films table, films showing now, films not showing now
$movies = "SELECT * FROM films";
$movies_now = "SELECT * FROM films WHERE showing_now='Y'";
$movies_end = "SELECT * FROM films WHERE showing_now='N'";
$m_rs = $mysqli->query($movies);
$mnow_rs = $mysqli->query($movies_now);
$mend_rs = $mysqli->query($movies_end);

date_default_timezone_set('America/Los_Angeles');
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

	<!-- css files -->
	<link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="../css/dashboard.css" type="text/css">
	<link rel="stylesheet" href="../bootstrap-table/dist/bootstrap-table.min.css" type="text/css">
	<link rel="stylesheet" href="../bootstrap-table/dist/extensions/sticky-header/bootstrap-table-sticky-header.min.css" type="text/css">
</head>

<!-- top nav bar -->
<body style="overflow-x:hidden;">
	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0" ;>
		<a class="navbar-brand col-sm-2 col-md-2 mr-0" href="#">ANONE Database</a>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" name="logout" href="admin_logout.php">Sign out</a>
			</li>
		</ul>
	</nav>

	<!-- side nav bar -->
	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link active" href="admin_movies.php">
								<span data-feather="home"></span>
								Movie List <span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admin_schedules.php">
								<span data-feather="file"></span>
								Schedules
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
			<div class="alert alert-<?php echo $_SESSION['msg_type'] ?>" role="alert">
				<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
				?>
			</div>
		<?php endif; ?>

		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
			<h1 class="h2">Control Data</h1>
		</div>

		<!-- movie data form -->
		<div class="admin_movie_controle" style="width:100%">
			<div style="float:left; width:50%; padding-right:3%;" name="form_divider">
				<form action="process.php" method="POST">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="movie_title" name="movie_title" value="<?php echo $movie_title; ?>" placeholder="Please do not use following letters: \ / : * ? < > | ''" required>
							<input type="hidden" class="form-control" id="movie_id" name="movie_id" value="<?php echo $movie_id; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Age Rating</label>
						<div class="col-sm-10">
							<input type="number" pattern="(?:0[1-9]|1[0-9])" class="form-control" id="age_rate" name="age_rate" value="<?php echo $age_rate; ?>" placeholder="Numeric format (Ex:12)" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Run Time</label>
						<div class="col-sm-10">
							<input type="number" pattern="[0-9]+" class="form-control" id="run_time" name="run_time" value="<?php echo $run_time; ?>" placeholder="Minutes format (Ex:127)" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Release Date</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="release_date" name="release_date" value="<?php echo $release_date; ?>" placeholder="yyyy-mm-dd" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Down Date</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="down_date" name="down_date" value="<?php echo $down_date; ?>" placeholder="yyyy-mm-dd" required>
						</div>
					</div>
			</div>
			<div style="float:left; width:50%;  padding-right:3%;" name="form_divider">
				<div class="form-group row">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
					<div class="col-sm-10">
						<textarea id="movie_description" name="movie_description" class="form-control" rows="4" cols="50" required><?php echo $movie_description; ?></textarea>
					</div>
				</div>
				<br>
				<fieldset class="form-group">
					<div class="row">
						<legend class="col-form-label col-sm-2 pt-0">Run Type</legend>
						<div class="col-sm-10">
							<div class="btn-group btn-group-toggle" data-toggle="buttons" style="display:inline-block;">
								<!-- when echoing for edit, check the button that is selected, when new, check nothing, validate -->
								<label class="btn btn-outline-dark <?php if ($run_type == "new") echo "active"; ?>">
									<input type="radio" id="first_run" name="run_type" value="new" <?php if ($update_movie == true && $run_type == "new") {
																										echo "checked";
																									} else {
																										echo "required";
																									}
																									?>> First Run
								</label>
								<label class="btn btn-outline-dark <?php if ($run_type == "re") echo "active"; ?>">
									<input type="radio" id="rerun" name="run_type" value="re" <?php if ($update_movie == true && $run_type == "re") {
																									echo "checked";
																								} else {
																									echo "required";
																								}
																								?>> Re-run
								</label>
							</div>
						</div>
					</div>
				</fieldset>
				<div class="row">
					<legend class="col-form-label col-sm-2 pt-0">On Air</legend>
					<div class="col-sm-10">
						<div class="btn-group btn-group-toggle" data-toggle="buttons" style="display:inline-block;">
							<label class="btn btn-outline-dark <?php if ($showing_now == "Y") echo "active"; ?>">
								<input type="radio" id="yes" name="showing_now" value="Y" <?php if ($update_movie == true && $showing_now == "Y") {
																								echo "checked";
																							} else {
																								echo "required";
																							}
																							?>> Yes
							</label>
							<label class="btn btn-outline-dark <?php if ($showing_now == "N") echo "active"; ?>">
								<input type="radio" id="no" name="showing_now" value="N" <?php if ($update_movie == true && $showing_now == "N") {
																								echo "checked";
																							} else {
																								echo "required";
																							}
																							?>> No
							</label>
						</div>
					</div>
				</div><br>
			</div>
			<div style="float:left; width:100%" name="form_divider">
				<div class="form-group row">
					<div class="col-sm-10">
						<!-- change button for add/update -->
						<?php
						if ($update_movie == true) :
						?>
							<button type="submit" class="btn btn-info" name="update_movie">Update Movie</button>
						<?php else : ?>
							<button type="submit" class="btn btn-primary" name="add_movie">Add Movie</button>
						<?php endif; ?>
					</div>
				</div>
				</form>
			</div>
			<br>
		</div>

		<!--Movie table-->
		<div id="movie_list_group" style="float:left; width:100%">
			<!-- toggle buttons to filter all movies, playing now, and not playing -->
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
				<h2>Movie List</h2>
				<div style="text-align:left;"><br>
					<a class="btn btn-primary" data-toggle="collapse" href="#allmovie" role="button" aria-expanded="true" aria-controls="allmovie"> All Movie List </a>
					<a class="btn btn-primary" data-toggle="collapse" href="#movie_now" role="button" aria-expanded="false" aria-controls="movie_now"> Now playing </a>
					<a class="btn btn-primary" data-toggle="collapse" href="#movie_end" role="button" aria-expanded="false" aria-controls="movie_end"> Not playing </a>
				</div>
			</div>


			<div class="table-responsive" style="height:380px;">
				<div id="movie_menu">
					<!-- all movies table -->
					<div class="collapse show" id="allmovie" data-parent="#movie_list_group"><br>
						<table class="table table-hover table-sm bootstrap-table" data-toggle="table">
							<thead class="thead-dark sticky-header">
								<tr>
									<th>Movie Title</th>
									<th>Age Rating</th>
									<th>Run Time</th>
									<th>Play Now</th>
									<th>Release Date</th>
									<th>Down Date</th>
									<th data-width="500">Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								while ($m_rs_row = $m_rs->fetch_array(MYSQLI_ASSOC)) {
									echo "<tr><td>" . $m_rs_row['film_title'] . "</td>";
									echo "<td>" . $m_rs_row['age_rating'] . "</td>";
									echo "<td>" . $m_rs_row['runtime'] . "</td>";
									echo "<td>" . $m_rs_row['showing_now'] . "</td>";
									echo "<td>" . $m_rs_row['release_date'] . "</td>";
									echo "<td>" . $m_rs_row['down_date'] . "</td>";
									echo "<td>" . $m_rs_row['film_description'] . "</td>";
									echo '<td><a href="admin_movies.php?edit_film=' . $m_rs_row['film_id'] . '" class="btn btn-sm"><span data-feather="edit"></span>Edit</a>';
									echo '<a href="process.php?delete_film=' . $m_rs_row['film_id'] . '" class="btn btn-sm"><span data-feather="trash-2"></span>Delete</a></td>';
									echo '</tr>';
								}  
								?>
							</tbody>
						</table>
					</div>

					<!-- playing now movie table -->
					<div div class="collapse" id="movie_now" data-parent="#movie_list_group"><br>
						<table class="table table-hover table-sm bootstrap-table" data-toggle="table">
							<thead class="thead-dark sticky-header">
								<tr>
									<th>Movie Title</th>
									<th>Age Rating</th>
									<th>Run Time</th>
									<th>Play Now</th>
									<th>Release Date</th>
									<th>Down Date</th>
									<th data-width="500">Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								while ($mnow_rs_row = $mnow_rs->fetch_array(MYSQLI_ASSOC)) {
									echo "<tr><td>" . $mnow_rs_row['film_title'] . "</td>";
									echo "<td>" . $mnow_rs_row['age_rating'] . "</td>";
									echo "<td>" . $mnow_rs_row['runtime'] . "</td>";
									echo "<td>" . $mnow_rs_row['showing_now'] . "</td>";
									echo "<td>" . $mnow_rs_row['release_date'] . "</td>";
									echo "<td>" . $mnow_rs_row['down_date'] . "</td>";
									echo "<td>" . $mnow_rs_row['film_description'] . "</td>";
									echo '<td><a href="admin_movies.php?edit_film=' . $mnow_rs_row['film_id'] . '" class="btn btn-sm"><span data-feather="edit"></span>Edit</a>';
									echo '<a href="process.php?delete_film=' . $mnow_rs_row['film_id'] . '" class="btn btn-sm"><span data-feather="trash-2"></span>Delete</a></td>';
									echo '</tr>';
								}
								?>
							</tbody>
						</table>
					</div>

					<!-- not playing movie table -->
					<div div class="collapse" id="movie_end" data-parent="#movie_list_group"><br>
						<table class="table table-hover table-sm bootstrap-table" data-toggle="table">
							<thead class="thead-dark sticky-header">
								<tr>
									<th>Movie Title</th>
									<th>Age Rate</th>
									<th>Run Time</th>
									<th>Play Now</th>
									<th>Release Date</th>
									<th>Down Date</th>
									<th data-width="500">Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								while ($mend_rs_row = $mend_rs->fetch_array(MYSQLI_ASSOC)) {
									echo "<tr><td>" . $mend_rs_row['film_title'] . "</td>";
									echo "<td>" . $mend_rs_row['age_rating'] . "</td>";
									echo "<td>" . $mend_rs_row['runtime'] . "</td>";
									echo "<td>" . $mend_rs_row['showing_now'] . "</td>";
									echo "<td>" . $mend_rs_row['release_date'] . "</td>";
									echo "<td>" . $mend_rs_row['down_date'] . "</td>";
									echo "<td>" . $mend_rs_row['film_description'] . "</td>";
									echo '<td><a href="admin_movies.php?edit_film=' . $mend_rs_row['film_id'] . '" class="btn btn-sm"><span data-feather="edit"></span>Edit</a>';
									echo '<a href="process.php?delete_film=' . $mend_rs_row['film_id'] . '" class="btn btn-sm"><span data-feather="trash-2"></span>Delete</a></td>';
									echo '</tr>';
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<br>
			</div>
		</div>
	</main>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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