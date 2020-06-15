<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This page has codes to implement add, edit/update, delete rows in all admin tables. 
				Edit will retrieve the row's information to fill the data form from the original page.
				Update will then submit the updated data form simiar to add features.
				Add/delete order will add/delete order and tickets as well according to order quantity
				and also update seat_available in films_schedule table as well.
-->
<?php
include '../dbcon.php';

session_start();

$mysqli = getCon();
// Check connection
if ($mysqli->connect_error) {
	die("Connection failed: " . $mysqli->connect_error);
}

// process based on tutorial
// source:https://www.youtube.com/watch?v=3xRMUDC74Cw	

$movie_id = '';
$movie_title = '';
$age_rate = '';
$run_time = '';
$release_date = '';
$down_date = '';
$showing_now = '';
$run_type = '';
$movie_description = '';

$schedule_id = '';
$schedule_film_id = '';
$schedule_location_id = '';
$schedule_date = '';
$schedule_time = '';
$schedule_seat = '';
$schedule_filter_id = '';

$location_id = '';
$location_address = '';
$location_city = '';
$location_state = '';
$location_zipcode = '';

$order_id = '';
$order_quantity = '';
$order_date = '';
$order_price = '';

$customer_id = '';
$customer_fn = '';
$customer_ln = '';
$customer_dob = '';
$customer_email = '';
$customer_phone = '';

$ticket_id = '';
$ticket_type = '';
$ticket_price = '';

$update_id = 0;
$update_movie = false;
$update_schedule = false;
$update_location = false;
$filter_schedule = false;
$update_order = false;
$update_customer = false;

// delete order - delete order, tickets, update seat_available in films_schedule
if (isset($_GET['delete_order'])) {
	$id = $_GET['delete_order'];

	$order_quantity_sql = "SELECT order_quantity FROM orders WHERE order_id=$id";
	$order_quantity_query = mysqli_query($mysqli, $order_quantity_sql);
	$order_row = $order_quantity_query->fetch_array();

	$schedule_id_sql = "SELECT schedule_id FROM tickets WHERE tickets.order_id=$id";
	$schedule_id_query = mysqli_query($mysqli, $schedule_id_sql);
	$schedule_id_row = $schedule_id_query->fetch_array();
	$schedule_id = $schedule_id_row['schedule_id'];

	$schedule_sql = "SELECT * FROM films_schedule WHERE schedule_id = '$schedule_id'";
	$schedule_query = mysqli_query($mysqli, $schedule_sql);
	$schedule_row = $schedule_query->fetch_array();

	$order_quantity = $order_row['order_quantity'];
	$updatedSeatQty = $schedule_row['seat_available'] + $order_quantity;

	// delete order, tickets
	$orders_del_sql = "DELETE FROM orders WHERE order_id=$id";
	$tickets_del_sql = "DELETE FROM tickets WHERE tickets.order_id = $id";
	$orders_delete = mysqli_query($mysqli, $orders_del_sql);
	$tickets_delete = mysqli_query($mysqli, $tickets_del_sql);

	// update seat_available in films_schedule (add back seats that were taken by order)
	$schedule_seat_update_sql = "UPDATE films_schedule SET seat_available = $updatedSeatQty WHERE schedule_id = '$schedule_id'";
	$schedule_seat_update = mysqli_query($mysqli, $schedule_seat_update_sql);

	if ($orders_delete && $tickets_delete && $schedule_seat_update) {
		$_SESSION['message'] = "Order ID " . $id . " has been deleted. Tickets for the order have been deleted.";
		$_SESSION['msg_type'] = "info";
	} else {
		$_SESSION['message'] = "Error deleting order ID " . $id . ". Please contact IT team.";
		$_SESSION['msg_type'] = "danger";
	}
	header('Location: admin_orders.php');
	exit;
}

// add order - check date, time, available quantity beforehand
if (isset($_POST['add_order'])) {

	$customer_email = $_POST['customer_email'];
	$order_quantity = $_POST['order_quantity'];
	$order_date = $_POST['order_date'];
	$order_price = $_POST['order_price'];
	$schedule_id = $_POST['schedule_id'];;
	$ticket_type = $_POST['ticket_type'];
	$ticket_price = $_POST['ticket_price'];

	//get_schedule_id
	$schedule_sql = "SELECT * FROM films_schedule WHERE schedule_id = '$schedule_id'";
	$schedule = mysqli_query($mysqli, $schedule_sql);

	//if schedule exists
	if ($schedule->num_rows > 0) {
		$schedule_row = $schedule->fetch_array();

		if (empty($schedule_row['film_id'])) {
			$_SESSION['message'] = "Error: Invalid schedule. Film ID: NULL";
			$_SESSION['msg_type'] = "danger";
		} else {
			$movie_date_str = strtotime($schedule_row['movie_date']);
			$today = strtotime(date("y-m-d"));

			//check if date is past 
			if ($movie_date_str < $today) {
				$_SESSION['message'] = "Error: Cannot buy tickets for past dates.";
				$_SESSION['msg_type'] = "danger";

				//check if time is past current time today 
			} else if ($movie_date_str == $today) {
				$current_time = strtotime(date("G:i"));
				$schedule_start_time = date("G:i", strtotime($schedule_row['start_time']));

				if ($schedule_start_time < $current_time) {
					$_SESSION['message'] = "Error: Cannot buy tickets for today's past showings.";
					$_SESSION['msg_type'] = "danger";
				}
			} else {
				$updatedSeatQty = $schedule_row['seat_available'] - $order_quantity;
				//ticket quantity validation
				if ($updatedSeatQty < 0) {
					$_SESSION['message'] = "Error: Exceed maximum ticket quantity available. Available quantity: " . $schedule_row['seat_available'];
					$_SESSION['msg_type'] = "danger";
				} else {
					//update seat_available with order insertion
					$schedule_seat_update_sql = "UPDATE films_schedule SET seat_available = $updatedSeatQty WHERE schedule_id = '$schedule_id'";
					$schedule_seat_update = mysqli_query($mysqli, $schedule_seat_update_sql) or die($mysqli->error);
					$add_order = $mysqli->query("INSERT INTO orders (customer_email, order_quantity, order_date, order_price) 
							VALUES ('$customer_email', '$order_quantity', '$order_date', '$order_price')");

					//create tickets
					if ($add_order) {
						$order_id = mysqli_insert_id($mysqli);
						$count = 0;

						while ($count < $order_quantity) {
							$mysqli->query("INSERT INTO tickets (schedule_id, order_id, ticket_type, ticket_price) 
								VALUES ('$schedule_id', '$order_id', '$ticket_type', '$ticket_price')") or
								die($mysqli->error);
							$count++;
						}

						$_SESSION['message'] = "Tickets for order ID " . $order_id . " has been successfully generated.";
						$_SESSION['msg_type'] = "success";
					} else {
						$_SESSION['message'] = "Error creating tickets for order ID " . $order_id . ". Please contact IT team.";
						$_SESSION['msg_type'] = "danger";
					}
				}
			}
		}
	} else {
		//schedule doesn't exist
		$_SESSION['message'] = "Error: Schedule ID " . $schedule_id . " does not exist.";
		$_SESSION['msg_type'] = "danger";
	}
	header('Location: admin_orders.php');
	exit;
}

// edit order - not used/updated
if (isset($_GET['edit_order'])) {
	$id = $_GET['edit_order'];
	$orders_update_sql = "SELECT orders.order_id AS order_id, tickets.schedule_id AS schedule_id, 
	tickets.ticket_type AS ticket_type, tickets.ticket_price AS ticket_price, orders.order_quantity AS order_quantity, 
	orders.order_price AS order_price, orders.order_date AS order_date, orders.customer_email AS customer_email 
	FROM orders 
	JOIN tickets ON orders.order_id = tickets.order_id WHERE order_id=$id";
	$orders_update = mysqli_query($mysqli, $orders_update_sql);
	if ($orders_update->num_rows) {
		$row = $orders_update->fetch_array();
		$order_id = $row['order_id'];
		$schedule_id = $row['schedule_id'];
		$ticket_type = $row['ticket_type'];
		$ticket_price = $row['ticket_price'];
		$order_quantity = $row['order_quantity'];
		$order_price = $row['order_price'];
		$order_date = $row['order_date'];
		$customer_email = $row['customer_email'];
	} else {
		echo "Error updating order";
	}
}

// edit customer - retrieve data
if (isset($_GET['edit_customer'])) {
	$customer_id = $_GET['edit_customer'];
	$update_customer = true;
	$customers_update_sql = "SELECT * FROM customers WHERE customer_id=$customer_id";
	$customers_update = mysqli_query($mysqli, $customers_update_sql);
	if ($customers_update->num_rows) {
		$row = $customers_update->fetch_array();
		$customer_fn = $row['customer_first_name'];
		$customer_ln = $row['customer_last_name'];
		$customer_dob = $row['customer_dob'];
		$customer_email = $row['customer_email'];
		$customer_phone = $row['customer_phone'];
	} else {
		$_SESSION['message'] = "Error retrieving customer ID " . $customer_id . " information. Please contact IT team.";
		$_SESSION['msg_type'] = "danger";
		header('Location: admin_customers.php');
		exit;
	}
}

// update customer - submit form
if (isset($_POST['update_customer'])) {
	$customer_id = $_POST['customer_id'];
	$customer_first_name = $_POST['customer_first_name'];
	$customer_last_name = $_POST['customer_last_name'];
	$customer_dob = $_POST['customer_dob'];
	$customer_email = $_POST['customer_email'];

	if (empty($_POST['customer_phone'])) {
		$customer_phone = "";
	} else {
		$customer_phone = $_POST['customer_phone'];
	}

	$customers_update_sql =
		"UPDATE customers 
		SET customer_first_name='$customer_first_name', customer_last_name='$customer_last_name', customer_dob='$customer_dob', customer_email ='$customer_email', customer_phone='$customer_phone'
		WHERE customer_id=$customer_id";
	$customers_update = mysqli_query($mysqli, $customers_update_sql);

	if ($customers_update) {
		$_SESSION['message'] = "Customer ID " . $customer_id . " info has been updated.";
		$_SESSION['msg_type'] = "info";
	} else {
		$_SESSION['message'] = "Error updating customer ID " . $customer_id . " Please contact IT team.";
		$_SESSION['msg_type'] = "danger";
	}

	header('Location: admin_customers.php');
	exit;
}

// add customer
if (isset($_POST['add_customer'])) {

	$customer_first_name = $_POST['customer_first_name'];
	$customer_last_name = $_POST['customer_last_name'];
	$customer_dob = $_POST['customer_dob'];
	$customer_email = $_POST['customer_email'];

	if (empty($_POST['customer_phone'])) {
		$customer_phone = "";
	} else {
		$customer_phone = $_POST['customer_phone'];
	}

	$customer_insert = mysqli_query($mysqli, "INSERT INTO customers (customer_first_name, customer_last_name, customer_dob, customer_email, customer_phone) 
			VALUES ('$customer_first_name', '$customer_last_name', '$customer_dob', '$customer_email', '$customer_phone')");
	$new_customer_id = mysqli_insert_id($mysqli);

	$_SESSION['message'] = "Customer " . $new_customer_id . " has been added.";
	$_SESSION['msg_type'] = "success";

	if (!$customer_insert) {
		$_SESSION['message'] = "Customer with email address already exists.";
		$_SESSION['msg_type'] = "danger";
	}

	header("location: admin_customers.php");
	exit;
}

// add movie
if (isset($_POST['add_movie'])) {
	$movie_title = $_POST['movie_title'];
	$age_rate = $_POST['age_rate'];
	$run_time = $_POST['run_time'];
	$release_date = $_POST['release_date'];
	$down_date = $_POST['down_date'];
	$run_type = $_POST['run_type'];
	$movie_description = $mysqli->real_escape_string($_POST['movie_description']);
	$showing_now = $_POST['showing_now'];
	$film_id = $movie_title . "_" . $run_type . "_" . substr($release_date, 0, -6);

	$movie_insert = $mysqli->query("INSERT INTO films (film_id, age_rating, film_title, runtime, release_date, down_date, showing_now ,film_description)
		VALUES ('$film_id', '$age_rate', '$movie_title', '$run_time', '$release_date', '$down_date','$showing_now' , '$movie_description')") or die($mysqli->error);
	$movie_id = mysqli_insert_id($mysqli);
	$_SESSION['message'] = "Film ID " . $film_id . " has been added.";
	$_SESSION['msg_type'] = "success";

	if (!$movie_insert) {
		$_SESSION['message'] = "Error adding film ID " . $id . " Please contact IT team.";
		$_SESSION['msg_type'] = "danger";
	}

	header('Location: admin_movies.php');
	exit;
}

// delete movie
if (isset($_GET['delete_film'])) {
	$id = $_GET['delete_film'];

	$delete_film_sql = "DELETE FROM films WHERE film_id = '$id'";
	$delete_film_triger = $mysqli->query($delete_film_sql);

	if ($delete_film_triger) {
		$_SESSION['message'] = "Film ID " . $id . " has been deleted.";
		$_SESSION['msg_type'] = "success";
	} else {
		$_SESSION['message'] = "Error deleting film ID " . $id . " Please contact IT team.";
		$_SESSION['msg_type'] = "danger";
	}

	header('Location: admin_movies.php');
	exit;
}

// edit movie - retrieve film data
if (isset($_GET['edit_film'])) {
	$id = $_GET['edit_film'];

	$movie_edit_sql = "SELECT * FROM films WHERE film_id='$id'";
	$movie_result = $mysqli->query($movie_edit_sql) or die($mysqli->error);

	$update_movie = true;

	// determine run type based on film ID
	if (strpos($id, 'new') !== false) {
		$run_type = 'new';
	} else if (strpos($id, 're') !== false) {
		$run_type = 're';
	}

	if ($movie_result->num_rows) {
		$movie_row = $movie_result->fetch_array(MYSQLI_ASSOC);

		$movie_id = $movie_row['film_id'];
		$movie_title = $movie_row['film_title'];
		$age_rate = $movie_row['age_rating'];
		$run_time = $movie_row['runtime'];
		$release_date = $movie_row['release_date'];
		$down_date = $movie_row['down_date'];
		$movie_description = $movie_row['film_description'];
		$showing_now = $movie_row['showing_now'];
	} else {
		$_SESSION['message'] = "Error retrieving information for film ID " . $movie_id . ". Please contact IT team.";
		$_SESSION['msg_type'] = "danger";

		header('Location: admin_movies.php');
		exit;
	}
}

// update movie - submit form
if (isset($_POST['update_movie'])) {
	$movie_id = $_POST['movie_id'];
	$movie_title = $_POST['movie_title'];
	$age_rate = $_POST['age_rate'];
	$run_time = $_POST['run_time'];
	$release_date = $_POST['release_date'];
	$down_date = $_POST['down_date'];
	$run_type = $_POST['run_type'];
	$movie_description = $mysqli->real_escape_string($_POST['movie_description']);
	$showing_now = $_POST['showing_now'];
	$film_id = $movie_title . "_" . $run_type . "_" . substr($release_date, 0, -6);
	$movie_update_sql;

	$movie_update_sql =
		"UPDATE films 
				SET film_id ='$film_id', film_title = '$movie_title', runtime ='$run_time', age_rating='$age_rate',  release_date='$release_date', down_date = '$down_date', showing_now = '$showing_now', film_description ='$movie_description' 
				WHERE film_id='$movie_id'";
	$movie_update = $mysqli->query($movie_update_sql);

	if ($movie_update) {
		$_SESSION['message'] = "Film information for film ID " . $movie_id . " has been updated.";
		$_SESSION['msg_type'] = "info";
	} else {
		$_SESSION['message'] = "Error updating film ID " . $movie_id . ". Please contact IT team.";
		$_SESSION['msg_type'] = "danger";
	}

	header('Location: admin_movies.php');
	exit;
}

// add schedule 
if (isset($_POST['add_schedule'])) {
	$film_id = $_POST['film_id'];
	$location_id = $_POST['location_id'];
	$movie_date = $_POST['movie_date'];
	$start_time = $_POST['start_time'];
	$seat_available = $_POST['seat_available'];

	$schedule_insert = $mysqli->query("INSERT INTO films_schedule (film_id, location_id, movie_date, start_time, seat_available)
		VALUES ('$film_id', '$location_id', '$movie_date', '$start_time', '$seat_available')") or die($mysqli->error);
	$schedule_id = mysqli_insert_id($mysqli);

	if ($schedule_insert) {
		$_SESSION['message'] = "Schedule ID " . $schedule_id . " has been added.";
		$_SESSION['msg_type'] = "success";
	} else {
		$_SESSION['message'] = "Error adding schedule ID " . $schedule_id . ". Please contact IT team.";
		$_SESSION['msg_type'] = "danger";
	}

	header('Location: admin_schedules.php');
	exit;
}

// delete schedule
if (isset($_GET['delete_schedule'])) {
	$id = $_GET['delete_schedule'];

	$delete_schedule_sql = "DELETE FROM films_schedule WHERE schedule_id = '$id'";
	$delete_schedule_triger = $mysqli->query($delete_schedule_sql);

	if ($delete_schedule_triger) {
		$_SESSION['message'] = "Schedule ID " . $id . " has been deleted.";
		$_SESSION['msg_type'] = "info";
	} else {
		$_SESSION['message'] = "Schedule ID " . $id . " cannot be deleted due to existing orders. 
								Please contact IT team for further assistance.";
		$_SESSION['msg_type'] = "danger";
	}
	header('Location: admin_schedules.php');
	exit;
}

// edit schedule - retrieve info
if (isset($_GET['edit_schedule'])) {
	$id = $_GET['edit_schedule'];
	$schedule_edit_sql = "SELECT * FROM films_schedule WHERE schedule_id='$id'";
	$schedule_result = $mysqli->query($schedule_edit_sql) or die($mysqli->error);
	$update_schedule = true;

	if ($schedule_result->num_rows) {
		$schedule_row = $schedule_result->fetch_array(MYSQLI_ASSOC);
		$schedule_id = $schedule_row['schedule_id'];
		$schedule_film_id = $schedule_row['film_id'];
		$schedule_location_id = $schedule_row['location_id'];
		$schedule_date = $schedule_row['movie_date'];
		$schedule_time = $schedule_row['start_time'];
		$schedule_seat = $schedule_row['seat_available'];
	} else {
		$_SESSION['message'] = "Error retrieving schedule information for schedule ID " . $id . ". Please contact IT team.";
		$_SESSION['msg_type'] = "danger";
		header('Location: admin_schedules.php');
		exit;
	}
}

// update schedule - submit form
if (isset($_POST['update_schedule'])) {
	$schedule_id = $_POST['schedule_id'];
	$schedule_date = $_POST['movie_date'];
	$schedule_time = $_POST['start_time'];
	$schedule_seat =  $_POST['seat_available'];

	$schedule_update_sql =
		"UPDATE films_schedule
				SET movie_date ='$schedule_date', start_time='$schedule_time',  seat_available='$schedule_seat' 
				WHERE schedule_id='$schedule_id'";
	$schedule_update = $mysqli->query($schedule_update_sql);

	if ($schedule_update) {
		$_SESSION['message'] = "Schedule ID " . $schedule_id . " has been updated.";
		$_SESSION['msg_type'] = "info";
	} else {
		$_SESSION['message'] = "Error updating schedule ID " . $schedule_id . ". Please contact IT team.";
		$_SESSION['msg_type'] = "danger";
	}

	header('Location: admin_schedules.php');
	exit;
}

// filter schedule by location
if (isset($_GET['filter_schedule'])) {
	$id = $_GET['filter_schedule'];
	if ($id == 'ALL') {
		$filter_schedule = false;
	} else {
		$filter_schedule = true;
		$schedule_filter_id = $id;
	}
}

// edit location - retrieve data
if (isset($_GET['edit_location'])) {

	$id = $_GET['edit_location'];
	$location_edit_sql = "SELECT * FROM locations WHERE location_id='$id'";
	$location_result = $mysqli->query($location_edit_sql) or die($mysqli->error);
	$update_location = true;

	if ($location_result->num_rows) {
		$location_row = $location_result->fetch_array(MYSQLI_ASSOC);
		$location_id = $location_row['location_id'];
		$location_address = $location_row['address'];
		$location_city = $location_row['city'];
		$location_state = $location_row['state'];
		$location_zipcode = $location_row['zipcode'];
	} else {
		$_SESSION['message'] = "Error retrieving location information for location ID " . $id . ". Please contact IT team.";
		$_SESSION['msg_type'] = "danger";
		header('Location: admin_locations.php');
		exit;
	}
}

// update location - submit form
if (isset($_POST['update_location'])) {
	$location_id = $_POST['form_location_id'];
	$location_address = $_POST['address'];
	$location_city = $_POST['city'];
	$location_state =  $_POST['state'];
	$location_zipcode =  $_POST['zipcode'];

	$location_update_sql =
		"UPDATE locations
				SET address ='$location_address', city='$location_city', state='$location_state', zipcode ='$location_zipcode'
				WHERE location_id='$location_id'";

	$location_update = $mysqli->query($location_update_sql);

	if ($location_update) {
		$_SESSION['message'] = "Address for " . $location_id . " has been updated.";
		$_SESSION['msg_type'] = "info";
	} else {
		$_SESSION['message'] = "Error updating information for location ID " . $location_id . ". Please contact IT team.";
		$_SESSION['msg_type'] = "danger";
	}

	header('Location: admin_locations.php');
	exit;
}
