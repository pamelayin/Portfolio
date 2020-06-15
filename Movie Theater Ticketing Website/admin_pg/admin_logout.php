<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This is sign out page for employees (admin access). Will send back to login page.
-->

<?php
	session_start();
	unset($_SESSION);
	session_destroy();
	header("location:admin_login.php");
?>