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
		<title>Red Bean Wow Milk</title>
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
							<h2>Red Bean Wow Milk<br />
							 </h2>
						</header>

									<div class="12u$"><span class="image fit"><img src="../assets/images/thumbs/15.png" alt="" /></span></div>
								
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
							<p>Combine brown sugar and water in a small bowl and heat in microwave. Stir until the brown sugar is completely dissolved in the water. </p>
							<h4>Step 2</h4>
							<p>Cook the boba pearls according to package directions. Typical instructions: Heat 6 cups of water in a pot and bring to a boil. Add boba pearls and cover with lid. Simmer for 3 minutes, remove lid and simmer for additional 3 minutes. Drain boba and place in the brown sugar syrup. Allow to cool.</p>
							<h4>Step 3</h4>
							<p>When boba pearls are cooled, combine red bean paste and milk in a blender. Blend on low speed. Do not over-blend, or else the milk will become very foamy. Low quick pulses help reduce the amount of foam produced. Place drink in cups and add boba pearls. Add sugar syrup to taste for added sweetness. Drink with boba straws. </p>
	</section>


    <hr style="margin-top: 100px;">
    </div>
			</div>

		

 
	</body>
</html>