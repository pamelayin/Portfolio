<!-- 
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This is sign-in page for employees (admin access).
-->

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v3.8.6">

	<title>The Premium Movie Employee Sign In Page</title>

	<!-- template used -->
	<link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">

	<!-- css files -->
	<link rel="stylesheet" href="../css/bootstrap.css" type="text/css">

	<!-- Custom styles for this template -->
	<link href="../css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
	<!-- header jumbotron -->
	<div class="jumbotron jumbotron-fluid" style="background-color: #F26B5B; background-size: 50%;">
		<div class="container">
			<h1 class="display-4">ANONE The Premium Movie Database Portal</h1>
		</div>
	</div>

	<!-- form -->
	<div class="container">
		<form class="form-signin" method="post" action="../admin_pg/admin_check.php">
			<h1 class="h3 mb-3 font-weight-normal">Please log in using employee ID and password.</h1>
			<!-- source: https://stackoverflow.com/questions/29024361/php-wrong-username-password-how-to-echo-it-properly -->
			<!-- wrong login message -->
			<?php if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
				echo '<p style="color: red">Wrong ID or password. Please try again.</p>';
			}
			?>
			
			<label for="inputID" class="sr-only">Employee ID</label>
			<input type="text" id="inputID" name="id" class="form-control" placeholder="ID: cs340" required autofocus>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" name="pw" class="form-control" placeholder="Password: test1234" required>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Log In</button>
			<p class="mt-5 mb-3 text-muted">&copy; ANONE The Premium Movie 2020</p>
		</form>
	</div>
</body>

</html>