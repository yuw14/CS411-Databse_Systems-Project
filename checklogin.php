<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "", "first_db");
	$username = mysqli_real_escape_string($link,$_POST['username']);
	$password = mysqli_real_escape_string($link,$_POST['password']);

	$query = mysqli_query($link, "SELECT * from users WHERE username='$username'"); 
	$exists = mysqli_num_rows($query); 
	$table_users = "";
	$table_password = "";
	if($exists > 0) 
	{
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) 
		{
			$table_users = $row['username']; 
			$table_password = $row['password']; 
		}
		if(($username == $table_users) && ($password == $table_password)) 
		{
				if($password == $table_password)
				{
					$_SESSION['user'] = $username; 
					header("location: select.php"); 
				}
				
		}
		else
		{
			Print '<script>alert("Incorrect Password!");</script>'; 
			Print '<script>window.location.assign("index.php");</script>'; 
		}

	}
	else
	{
		Print '<script>alert("Incorrect Username!");</script>'; 
		Print '<script>window.location.assign("index.php");</script>'; 
	}
?>