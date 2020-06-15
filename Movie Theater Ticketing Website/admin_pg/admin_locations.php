<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This page enables user to read and update locations table in database. 
				User is able to edit all address fields except the location_id (PK).
-->
<?php
require_once 'process.php';

	date_default_timezone_set('America/Los_Angeles');
	$today = date("yy-m-d");

	//select locations table
	$movies_location = "SELECT * FROM locations";
	$location_list = $mysqli->query($movies_location);

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
	<link rel="stylesheet" href="../bootstrap-table/dist/bootstrap-table.min.css" type="text/css">
	<link rel="stylesheet" href="../bootstrap-table/dist/extensions/sticky-header/bootstrap-table-sticky-header.min.css" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard.css" type="text/css">
  
</head>

<!-- top nav bar -->
<body  style="overflow-x:hidden;">
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
							<a class="nav-link" href="admin_schedules.php">
								<span data-feather="file"></span>
								Schedules
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="admin_locations.php">
								<span data-feather="map"></span>
								Locations <span class="sr-only">(current)</span>
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

		<!-- locations data form -->
		<div style="float:left; width:100%; margin-right:2%">
			<form method="post" action="process.php">
				<div class="form-group row">
					<label for="form_location_id" class="col-sm-2 col-form-label">Location ID</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="form_location_id" name="form_location_id" value="<?php echo $location_id; ?>" readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="address" class="col-sm-2 col-form-label">Address</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="address" name="address" value="<?php echo $location_address; ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="city" class="col-sm-2 col-form-label">City</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="city" name="city" maxlength="30" value="<?php echo $location_city; ?>" placeholder="ex: New York" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="state" class="col-sm-2 col-form-label">State</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="state" name="state" maxlength="2" value="<?php echo $location_state; ?>" placeholder="NY" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="zipcode" class="col-sm-2 col-form-label">Zipcode</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="zipcode" name="zipcode" pattern="[0-9]{5}" maxlength="5" value="<?php echo $location_zipcode; ?>" placeholder="00000" required>
					</div>
				</div>
				<!-- change button for add/update -->
				<div class="form-group row">
					<div class="col-sm-8">
						<?php
						if ($update_location == true) :
						?>
							<button type="submit" class="btn btn-info" name="update_location">Update Location</button>
						<?php else : ?>
							<button type="submit" class="btn btn-outline-dark" name="update_location" disabled>Update Location</button>
						<?php endif; ?>

					</div>
				</div>
			</form>
		</div>

		<!--locations table-->
		<div style="float:left; width:100%;">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
				<h2>Our Locations</h2>
			</div>
			<div class="table-responsive">
				<table class="table table-hover table-sm bootstrap-table" data-toggle="table">
					<thead class="thead-dark sticky-header">
						<tr>
							<th>Location ID</th>
							<th>Address</th>
							<th>City</th>
							<th>State</th>
							<th>Zipcode</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$movies_location2 = "SELECT * FROM locations";
						$location_list2 = $mysqli->query($movies_location2);
						while($location_list2_row = $location_list2->fetch_array(MYSQLI_ASSOC)){
							echo "<tr><td>".$location_list2_row['location_id']."</td>";
							echo "<td>".$location_list2_row['address']."</td>";
							echo "<td>".$location_list2_row['city']."</td>";
							echo "<td>".$location_list2_row['state']."</td>";
							echo "<td>".$location_list2_row['zipcode']."</td>";
							echo '<td><a href="admin_locations.php?edit_location='.$location_list2_row['location_id'].'" class="btn btn-sm"><span data-feather="edit"></span>Edit</a>';
							//echo '<a href="process.php?delete_location='.$location_list2_row['location_id'].'" class="btn btn-sm"><span data-feather="trash-2"></span>Delete</a>';
							echo '</td></tr>';
						}
						?>
					</tbody>
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
