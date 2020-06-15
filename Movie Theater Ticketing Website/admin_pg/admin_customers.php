<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This page enables user to create, read, and update customers table in database. 
				Delete has been left out on purpose to reflect practicality. All fields are validated.
				PK is customer_email as suggested by instructor, but we decided to keep customer_id for ease of tracking.
-->

<?php
require_once 'process.php';

$mysqli = getCon();

// Check connection
if ($mysqli->connect_error) {
	die("Connection failed: " . $mysqli->connect_error);
}

//get customer table in ascending customer ID number in db
$customers_sql = "SELECT * FROM customers ORDER BY customer_id ASC";
$customers_result = mysqli_query($mysqli, $customers_sql);
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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="../bootstrap-table/dist/extensions/sticky-header/bootstrap-table-sticky-header.min.css" type="text/css">
</head>

<!-- top nav bar -->

<body style="overflow-x:hidden;">
	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
		<a class="navbar-brand col-sm-2 col-md-2 mr-0" href="#admin_dashboard.php">ANONE Database</a>
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
							<a class="nav-link" href="admin_movies.php">
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
							<a class="nav-link active" href="admin_customers.php">
								<span data-feather="users"></span>
								Customers<span class="sr-only">(current)</span>
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

		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-left pb-2 mb-3 border-bottom">
			<h1 class="h2">Control Data</h1>
		</div>

		<!-- customer data form -->
		<div style="float:left; width:100%; margin-right:2%">

			<form action="process.php" method="POST" class="needs-validation">
				<div class="form-group row">
					<label for="customer_id" class="col-sm-2 col-form-label">Customer ID</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" id="customer_id" min="1" name="customer_id" value="<?php echo $customer_id ?>" readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="customer_first_name" class="col-sm-2 col-form-label">First Name</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="customer_first_name" name="customer_first_name" value="<?php echo $customer_fn ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="customer_last_name" class="col-sm-2 col-form-label">Last Name</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="customer_last_name" name="customer_last_name" value="<?php echo $customer_ln ?>" required>
					</div>
				</div>

				<!-- birthday validation for adults only -->
				<?php
				$today = date('y-m-d');
				$mimnum_age = Date('Y-m-d', strtotime('-18 years'));
				?>

				<div class="form-group row">
					<label for="customer_dob" class="col-sm-2 col-form-label">Date of Birth</label>
					<div class="col-sm-8">
						<input type="date" class="form-control" id="customer_dob" name="customer_dob" max="<?php echo $mimnum_age; ?>" value="<?php echo $customer_dob ?>" placeholder="yyyy-mm-dd" required>
						<div class="invalid-feedback">
							Customer DOB invalid. Please try again.
						</div>
					</div>
				</div>

				<!-- if add customer, let user input, if update customer, disable email edit since PK -->
				<div class="form-group row">
					<label for="customer_email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-8">
						<?php
						if ($update_customer == true) :
						?>
							<input type="email" class="form-control" id="customer_email" name="customer_email" value="<?php echo $customer_email ?>" placeholder="email@example.com" readonly>
						<?php else : ?>
							<input type="email" class="form-control" id="customer_email" name="customer_email" value="<?php echo $customer_email ?>" placeholder="email@example.com" required>
						<?php endif; ?>

					</div>
				</div>

				<div class="form-group row">
					<label for="customer_phone" class="col-sm-2 col-form-label">Phone</label>
					<div class="col-sm-8">
						<input type="tel" pattern="[0-9]{3}[-]?[0-9]{3}[-]?[0-9]{4}" class="form-control" id="customer_phone" name="customer_phone" value="<?php echo $customer_phone ?>" placeholder="xxx-xxx-xxxx">
					</div>
				</div>

				<!-- change button for add/update -->
				<div class="form-group row">
					<div class="col-sm-10">
						<?php
						if ($update_customer == true) :
						?>
							<button type="submit" class="btn btn-info" name="update_customer">Update Customer Info</button>
						<?php else : ?>
							<button type="submit" class="btn btn-primary" name="add_customer">Add Customer</button>
						<?php endif; ?>
					</div>
				</div>
			</form>
			<br>
		</div>

		<!--customer table-->
		<div style="float:left; width:100%; margin-bottom: 20px">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
				<h2>Customers</h2>
			</div>

			<div class="table-responsive" style="height:320px">
				<table class="table table-hover table-sm bootstrap-table" data-toggle="table" data-search="true" data-search-align="left" data-show-search-button="true">
					<thead class="thead-dark sticky-header">
						<tr>
							<th>Customer ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>DOB</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//source: https://stackoverflow.com/questions/43286387/adding-a-delete-button-in-php-on-each-row-of-a-mysql-table
						if ($customers_result->num_rows > 0) {
							//output data of each row
							while ($row = mysqli_fetch_assoc($customers_result)) : ?>
								<tr>
									<td><?php echo $row['customer_id'] ?></td>
									<td><?php echo $row['customer_first_name'] ?></td>
									<td><?php echo $row['customer_last_name'] ?></td>
									<td><?php echo $row['customer_dob'] ?></td>
									<td><?php echo $row['customer_email'] ?></td>
									<td><?php echo $row['customer_phone'] ?></td>
									<td>
										<a href="admin_customers.php?edit_customer=<?php echo $row['customer_id']; ?>" class='btn btn-sm'><span data-feather='edit'></span> Edit</a>

								</tr>
						<?php endwhile;
						} else {
							echo "<p>Currently there are no customers.</p>";
							$mysqli->close();
						} ?>
					</tbody>
				</table><br>
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

	<script>
		// source: https://stackoverflow.com/questions/31352499/add-dash-in-auto-complete-phone-number/31352575
        // add dash in between phone numbers
		$(function() {
			$('#customer_phone').keydown(function(e) {
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
	</script>
</body>

</html>