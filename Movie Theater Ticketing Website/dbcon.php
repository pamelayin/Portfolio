<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
    Description: This is dbcon file for phpMyAdmin access.
-->

<?php
function getCon()
{
	//Please enter your db info
    $host = 'localhost';
    $user = 'root';
    $pw = '';
    $dbName = 'movie';
    $mysqli = new mysqli($host, $user, $pw, $dbName);

	return $mysqli;
}

