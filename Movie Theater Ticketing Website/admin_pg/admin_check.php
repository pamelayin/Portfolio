<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This is to check if id and password input from admin_login.php match by comparing to employees database.
				 If match, proceed to admin_movies.php, else display error message on admin_login.php.
-->

<?php
include '../dbcon.php';

	session_start();
	$id=$_POST['id'];
	$pw=$_POST['pw'];

	$mysqli = getCon();
	// Check connection
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}

	//select employee row from db using id
	$check = "SELECT * FROM employees WHERE employee_id='$id'";
	$result = $mysqli->query($check);
	$cnt = $result->num_rows;

	//check if result's id and pw match - move to admin_movies or go back and display fail message
	if($result->num_rows==1){
		$row=$result->fetch_array(MYSQLI_ASSOC);
		if($row['employee_pw'] == $pw) {
			$_SESSION['employee_id']=$id;
			if(isset($_SESSION['employee_id']))
			{
				header("location:admin_movies.php");
			}
			else{
				header("location:admin_login.php?msg=failed");
			}
		}
		else{
			header("location:admin_login.php?msg=failed");
		}
	}
	else{
		header("location:admin_login.php?msg=failed");
	}

?>

