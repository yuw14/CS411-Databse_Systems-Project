<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}
	$user = $_SESSION['user']; //assigns user value
?>
<html >
	<head>
		<title>Taro Slush</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main2.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>


	<body id="top" >

		<!-- Header -->
				<header id="header">
				<div class="inner">
					<a href="#" class="image avatar"><img src="../assets/images/avatar.jpg" alt="" /></a>
					<h1><strong>Hi <?php Print "$user"?>!</br></br></h1>
					<h2><a href="../select.php" style="text-decoration:none;">Search</strong></a></h2>
					<h2><a href="../edit.php" style="text-decoration:none;">Setting</strong></a></h2>
					<h2><a href="../rate.php" style="text-decoration:none;">Rate</strong></a></h2>
					<h2><a href="../recommendations.php" style="text-decoration:none;">Recommend</strong></a></h2>
					<br><br><br>

 				 	<h5><a href="../index.php">Log out</strong></a></h5>
 				</div>
			</header>

		<!-- Main -->
			<div id="main">

					<!-- One -->
					<section id="one">
						<header class="major">
							<h2>Taro Slush<br />
							 </h2>
						</header>

									<div class="12u$"><span class="image fit"><img src="../assets/images/thumbs/24.png" alt="" /></span></div>
								
						</section>


	<section>
	<div class="table-wrapper">
		<table class="alt">
			<thead>
				<tr>
					<th>Store</th>
					<th>Price</th>
				</tr>
			</thead>
		<tbody>
			<?php
				
					$link = mysqli_connect("localhost", "root", "", "first_db");
								$result = mysqli_query($link, "select distinct storeName, location, price from sells natural join stores where drinkID = 1"); 
					while($row = mysqli_fetch_array($result)){
						Print "<tr>";
						Print '<td align="center">'. $row['storeName']."</td>";
						Print '<td align="center">'. $row['location']."</td>";
						Print '<td align="center">'. $row['price']."</td>";
						Print "</tr>";
					}
			?>
									</tbody>
								
								</table>
					

			</section>


	<section>
						<h2>Recipe</h2>

						
							<h4>Step 1</h4>
							<p>Prepare the taro- Peel it and cut it into 1-inch cubes. Bring a pot of water to a boil and add a pinch of baking soda. Add the taro and boil until it is soft. Drain and transfer the taro cubes to a large bowl and let them cool.</p>
							<h4>Step 2</h4>
							<p>When the taro root is cool, add a 1-inch cube to the blender with the condensed milk, milk of your choice and the ice cubes. Blend the ingredients until they are smooth.</p>
							<h4>Step 3</h4>
							<p>Serve in large glass with tapioca pearls.</p>
	</section>


    <hr style="margin-top: 100px;">
    </div>
			</div>

		
 
	</body>
</html>