<!DOCTYPE html>
<html lang="en">
<head>
	<title>BobaCoffee Sign Up</title>
	<meta charset="UTF-8">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/login_util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login2.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="container-login" style="background-image: url('assets/images/bg1.jpg');">

		<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
			<span class="login-form-title p-b-37">
					BobaCoffee
			</span>
			<form class="login-form validate-form" action="signup.php" method="post">
				<span class="login-form-title p-b-37">
					
					Sign Up
				</span>

				<div class="wrap-input m-b-25">
					<input class="input" type="text" name="username" placeholder="username" required="required">
					<span class="focus-input"></span>
				</div>
				<div class="wrap-input m-b-25">
					<input class="input" type="password" name="password" placeholder="password" required="required">
					<span class="focus-input"></span>
				</div>
				<br>
				<div class="container-login-form-btn">
					<!-- <button class="login-form-btn">
						Sign Up
					</button> -->
					<input class="login-form-btn" type="submit" value="Sign Up"/>
				</div>
				
				<br><br>

				<div class="text-center">
					<a href="index.php" class="txt2 hov1">
						Sign In
					</a>
				</div>
			</form>

			
		</div>
	</div>
	
</body>
</html>

<?php

require_once __DIR__ .'/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

$config = \GraphAware\Bolt\Configuration::newInstance()
->withCredentials('lidingl2', 'b.iMdymGhdGYaM.wlkebHGSvwjzWA5F')
->withTimeout(10)
->withTLSMode(\GraphAware\Bolt\Configuration::TLSMODE_REQUIRED);

$driver = \GraphAware\Bolt\GraphDatabase::driver('bolt://hobby-efdadablacmmgbkedjegaddl.dbs.graphenedb.com:24787', $config);
$client = $driver->session();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$link = mysqli_connect("localhost", "root", "", "first_db");
	$username = mysqli_real_escape_string($link,$_POST['username']);
	$password = mysqli_real_escape_string($link,$_POST['password']);
    $bool = true;

	$query = mysqli_query($link, "Select * from users"); //Query the users table
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) //display all rows from query
	{
		$table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
		if($username == $table_users) // checks if there are any matching fields
		{
			$bool = false; // sets bool to false
			Print '<script>alert("Username has been taken!");</script>'; //Prompts the user
			Print '<script>window.location.assign("signup.php");</script>'; // redirects to register.php
		}
	}

	if($bool) // checks if bool is true
	{
		mysqli_query($link, "INSERT INTO users (username, password) VALUES ('$username','$password')"); //Inserts the value to table users
		$query_neo = "create (n1:Person{name: {name1}})";
		$param_neo = array('name1' => $username);
		$client -> run($query_neo, $param_neo);
		Print '<script>alert("Successfully Registered!");</script>'; // Prompts the user
		// $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
		Print '<script>window.location.assign("index.php");</script>';// redirects the user to the authenticated home page
		//Print '<script>window.location.assign("signup.php");</script>'; // redirects to register.php
	}

}
?>