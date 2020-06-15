<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This page enables user to create, read, and delete order and tickets associated with the order.
				Tickets are created accordingly when order is created and updates the quantity available in films_schedule table.
				Same goes for order delete. Order details are shown in modal for ease of access.
-->

<?php
require_once 'process.php';

$mysqli = getCon();
// Check connection
if ($mysqli->connect_error) {
	die("Connection failed: " . $mysqli->connect_error);
}

// query that joins tickets and orders table to get both order info and tickets info associated with the order
$orders_sql = "SELECT orders.order_id AS order_id, tickets.schedule_id AS schedule_id, 
	tickets.ticket_type AS ticket_type, tickets.ticket_price AS ticket_price, orders.order_quantity AS order_quantity, 
	orders.order_price AS order_price, orders.order_date AS order_date, orders.customer_email AS customer_email 
	FROM orders 
	JOIN tickets ON orders.order_id = tickets.order_id GROUP BY order_id ORDER BY order_id ASC";
$orders_result = mysqli_query($mysqli, $orders_sql);

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

	<!-- jquery moved to header to use modal -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
							<a class="nav-link" href="admin_locations.php">
								<span data-feather="map"></span>
								Locations
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="admin_orders.php">
								<span data-feather="shopping-cart"></span>
								Orders/Tickets<span class="sr-only">(current)</span>
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

		<!-- orders data form -->
		<div style="width:100%">
			<form action="process.php" method="POST">
				<div style="float:left; width:50%;">
					<div class="form-group-row">
						<p>When order is created, tickets will be generated accordingly.<br>
							Please see specific info by clicking details in the table below after order is added.</p>
					</div>
					<div class="form-group row">
						<label for="schedule_id" class="col-sm-4 col-form-label">Schedule ID</label>
						<div class="col-sm-7">
							<input type="number" class="form-control" id="schedule_id" min="1" name="schedule_id" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="ticket_type" class="col-sm-4 col-form-label">Ticket Type</label>
						<div class="col-sm-7">
							<div class="btn-group btn-group-toggle" data-toggle="buttons" style="display:inline-block;">
								<label class="btn btn-outline-dark">
									<input type="radio" id="ticket_regular" name="ticket_type" value="Regular" required>
									Regular
								</label>
								<label class="btn btn-outline-dark">
									<input type="radio" id="ticket_special" name="ticket_type" value="Special" required>
									Special
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="ticket_price" class="col-sm-4 col-form-label">Ticket Price</label>
						<div class="col-sm-7">
							<!-- getTotal() - used for total price calculation -->
							<input type="number" class="form-control" id="ticket_price" name="ticket_price" onchange="getTotal()" required>
						</div>
					</div>
					<br>
				</div>

				<div style="float:left; width:50%;">
					<div class="form-group row">
						<label for="order_quantity" class="col-sm-4 col-form-label">Order Quantity</label>
						<div class="col-sm-7">
							<!-- getTotal() - used for total price calculation -->
							<input type="number" class="form-control" id="order_quantity" name="order_quantity" min="1" max="10" onchange="getTotal()" required>
						</div>
					</div>

					<!-- updated automatically using javascript below -->
					<div class="form-group row">
						<label for="order_id" class="col-sm-4 col-form-label">Total Price</label>
						<div class="col-sm-7">
							<input type="number" class="form-control" id="order_price" name="order_price" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="order_id" class="col-sm-4 col-form-label">Order Date</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="order_date" name="order_date" value="<?php echo date('Y-m-d'); ?>" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="customer_id" class="col-sm-4 col-form-label">Customer ID/Email</label>

						<!-- customers drop-down list -->
						<div class="col-sm-7">
							<select class="custom-select" name="customer_email" required>
								<option disabled selected>Select Customer</option>
								<?php
								$customers_sql = "SELECT customer_id, customer_email FROM customers";
								$customers_result = mysqli_query($mysqli, $customers_sql);
								while ($customer_row = $customers_result->fetch_array(MYSQLI_ASSOC)) {
									echo '<option value="' . $customer_row['customer_email'] . '">' . $customer_row['customer_id'] . ': ' . $customer_row['customer_email'] . '</option>';
								}
								?>
							</select>
						</div>
					</div><br>
				</div>

				<div style="width:100%; float:left">
					<div class="form-group row">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-dark" name="add_order">Add Order</button>
						</div>
					</div>
				</div>
			</form><br>
		</div>

		<!--order table-->
		<div style="float:left; width:100%; margin-bottom: 20px">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center" style="float:left; width:100%">
				<h2>Orders</h2>
			</div>

			<div class="table-responsive" style="height:400px;">
				<div id="movie_list_group">
					<table class="table table-hover table-sm bootstrap-table" data-toggle="table">
						<thead class="thead-dark sticky-header">
							<tr>
								<th>Order ID</th>
								<th>Schedule ID</th>
								<th>Ticket Type</th>
								<th>Ticket Price</th>
								<th>Order Quantity</th>
								<th>Total Price</th>
								<th>Order Date</th>
								<th>Customer Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//source: https://stackoverflow.com/questions/43286387/adding-a-delete-button-in-php-on-each-row-of-a-mysql-table
							if ($orders_result->num_rows > 0) {
								while ($row = mysqli_fetch_assoc($orders_result)) : ?>
									<tr>
										<td><?php echo $row['order_id'] ?></td>
										<td><?php echo $row['schedule_id'] ?></td>
										<td><?php echo $row['ticket_type'] ?></td>
										<td><?php echo $row['ticket_price'] ?></td>
										<td><?php echo $row['order_quantity'] ?></td>
										<td><?php echo $row['order_price'] ?></td>
										<td><?php echo $row['order_date'] ?></td>
										<td><?php echo $row['customer_email'] ?></td>
										<td>
											<button type="button" class="btn btn-sm view_data" name="view" id="<?php echo $row['order_id'] ?>"><span data-feather='info'></span>Details</a></button>
											<a href="process.php?delete_order=<?php echo $row['order_id']; ?>" class='btn btn-sm'><span data-feather='trash-2'></span>
												Delete</a></td>
									</tr>
							<?php endwhile;
							} else {
								echo "<p>Currently there are no orders.</p>";
								$mysqli->close();
							} ?>
						</tbody>
					</table>
				</div>
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
		// details modal implementation - send order_id data to admin_order_details.php file containing modal
		// source: https://makitweb.com/dynamically-load-content-in-bootstrap-modal-with-ajax/
		$(document).ready(function() {
			$('.view_data').click(function() {
				var order_id = $(this).attr("id");
				$.ajax({
					url: "admin_order_details.php",
					method: "post",
					data: {
						order_id: order_id
					},
					success: function(data) {
						$('#order_detail').html(data);
						$('#dataModal').modal("show");
					}
				});
			});
		});
	</script>

	<script>
		// total price change based on qty and individual ticket price
		var total = document.getElementById("order_price");
		total.onchange = function() {
			getTotal();
		};

		function getTotal() {
			var ticket_price = document.getElementById("ticket_price").value;
			var quantity = document.getElementById("order_quantity").value;
			var order_price = ticket_price * quantity;
			total.value = order_price;
		}
	</script>
</body>

</html>

<!-- Order Details Modal -->
<div id="dataModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Order Details</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body" id="order_detail">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>