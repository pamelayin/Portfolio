<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This page makes use of all tables except employees as join table to display all information
				related to the order. It will display schedule info, location info, customer info, ticket info, 
				and remaining order table attributes related to each order. This is displayed in modal form in admin_orders.php.
-->

<?php
include '../dbcon.php';

$mysqli = getCon();
// Check connection
if ($mysqli->connect_error) {
	die("Connection failed: " . $mysqli->connect_error);
}

?>

<?php if (isset($_POST['order_id'])) {
	$id = $_POST['order_id'];
	$order_details_sql =
		"SELECT orders.order_id AS order_id, films.film_id AS film_id, films_schedule.schedule_id AS schedule_id, 
			films.film_title AS title, films_schedule.movie_date AS date, films_schedule.start_time AS time, 
            locations.location_id AS location_id, locations.address, locations.city, locations.state, locations.zipcode,
			orders.order_quantity AS quantity, tickets.ticket_id AS ticket_id, tickets.ticket_type AS type, 
			tickets.ticket_price AS price, orders.order_price AS total_price, customers.customer_id AS customer_id,
            customers.customer_first_name AS first_name, customers.customer_last_name AS last_name, 
			customers.customer_dob AS DOB, customers.customer_email AS email 
            FROM orders 
            JOIN tickets ON orders.order_id = tickets.order_id 
            JOIN customers ON orders.customer_email = customers.customer_email
            JOIN films_schedule ON films_schedule.schedule_id = tickets.schedule_id 
            JOIN films ON films.film_id = films_schedule.film_id 
            JOIN locations ON locations.location_id = films_schedule.location_id
            WHERE orders.order_id = $id
			ORDER BY tickets.ticket_id ASC";

	$order_details = mysqli_query($mysqli, $order_details_sql);
	$order_rows = $order_details->num_rows;

	$count = 0;
	$ticketInfo = "";

	if ($order_rows > 0) {
		// source: https://stackoverflow.com/questions/12123933/php-check-mysql-last-row
		// generate list of ticket_id for the order
		while ($row = $order_details->fetch_assoc()) {
			if (++$count == $order_rows) {
				$ticketInfo .= $row['ticket_id']; ?>
				<h6><strong>Order ID: </strong><span> <?php echo $row['order_id'] ?></span></h6><br>

				<h6>Movie Info</h6>
				<p><strong>Film ID: </strong><span> <?php echo $row['film_id'] ?></span></p>
				<p><strong>Schedule ID: </strong><span> <?php echo $row['schedule_id'] ?></span></p>
				<p><strong>Title: </strong><span> <?php echo $row['title'] ?></span></p>
				<p><strong>Date: </strong><span> <?php echo $row['date'] ?></span></p>
				<p><strong>Time: </strong><span> <?php echo $row['time'] ?></span></p><br>

				<h6>Theater Info</h6>
				<p><strong>Location ID: </strong><span> <?php echo $row['location_id'] ?></span></p>
				<p><strong>Address: </strong><span> <?php echo $row['address'] . ", " . $row['city'] . ", " . $row['state'] . ", " . $row['zipcode'] ?></span></p><br>

				<h6>Ticket Info</h6>
				<p><strong>Ticket ID: </strong><span> <?php echo $ticketInfo ?></span></p>
				<p><strong>Ticket Type: </strong><span> <?php echo $row['type'] ?></span></p>
				<p><strong>Ticket Price: </strong><span> $<?php echo $row['price'] ?></span></p>
				<p><strong>Ticket Quantity: </strong><span> <?php echo $row['quantity'] ?></span></p>
				<p><strong>Total Price: </strong><span> $<?php echo $row['total_price'] ?></span></p></br>

				<h6>Customer Info</h6>
				<p><strong>Customer ID: </strong><span> <?php echo $row['customer_id'] ?></span></p>
				<p><strong>Name: </strong><span> <?php echo $row['first_name'], " ", $row['last_name'] ?></span></p>
				<p><strong>DOB: </strong><span> <?php echo $row['DOB'] ?></span></p>
				<p><strong>Email: </strong><span> <?php echo $row['email'] ?></span></p>

<?php } else {
				$ticketInfo .= $row['ticket_id'] . ", ";
			}
		}
	} else {
		echo "<p>No order information available.</p>";
		$mysqli->close();
	}
} ?>