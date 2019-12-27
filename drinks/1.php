<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:../index.php"); // redirects if user is not logged in
	}
	$user = $_SESSION['user']; //assigns user value
?>
<html >
	<head>
		<title>Boba Tea</title>
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

					
					<section id="one">
						<header class="major">
							<h2>Boba Tea<br />
							 </h2>
						</header>

    
							
									<div class="12u$"><span class="image fit"><img src="../assets/images/thumbs/1.png" alt="" /></span></div>
								
						</section>


	<section>
	<div class="table-wrapper">
		<table class="alt">
			<thead>
				<tr>
					<th>Store</th>
					<th>Location</th>
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
							<p>Prepare the tea: Steep the tea bags with 4 cups of just boiled water. Let the tea sit until it reaches room temperature. There’s no need to remove the tea bags from the water as the tea is steeping. You can stick the tea in the fridge to speed up the cooling process.</p>
							<h4>Step 2</h4>
							<p>Prepare the simple syrup (if using): Add the water to a saucepan and heat the water until it starts to simmer. Add the sugar and stir until the sugar dissolves. Remove the saucepan from heat and let the simple syrup cool before transferring to a jar.</p>
							<h4>Step 3</h4>
							<p>Cook the tapioca pearls: Bring about 4 cups of water to boil and add the tapioca pearls. Stir the pearls and let them cook for about 5 minutes. The pearls should have floated to the top by now. Drain and rinse the pearls under cold water. Transfer them to a bowl.</p>
							<h4>Step 4</h4>
							<p>Assemble the drinks: Divide the cooked tapioca pearls into 4 large glasses. Next, add a few ice cubes to each glass. Pour 1 cup of the tea into each glass. Add 1 1/2 tablespoons of milk and 1 1/2 tablespoons of simple syrup into each glass. Stir and taste the milk tea. Add more milk or simple syrup to your taste. If you are serving the beverage to guests, have a small pitcher of milk and jar of simple syrup ready so that they can adjust the drink to their taste. The drink is usually served with large boba straws (large enough for the tapioca pearls to go through). If you don’t have the straws on hand, you can use spoons to scoop out the tapioca pearls.</p>
	</section>


    <hr style="margin-top: 100px;">
    </div>
			</div>

 
	</body>
</html>