<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}
	$user = $_SESSION['user']; //assigns user value
	$id_exists = false;
?>
<html >
	<head>
		<title>Rate drinks</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main2.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>

	<body id="top" >

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="#" class="image avatar"><img src="assets/images/avatar.jpg" alt="" /></a>
					<h1><strong>Hi <?php Print "$user"?>!</br></br></h1>
					<h2><a href="select.php" style="text-decoration:none;">Search</strong></a></h2>
					<h2><a href="edit.php" style="text-decoration:none;">Setting</strong></a></h2>
					<h2><a href="rate.php" style="text-decoration:none;">Rate</strong></a></h2>
					<h2><a href="recommendations.php" style="text-decoration:none;">Recommend</strong></a></h2>
					<br><br><br>

 				 	<h5><a href="index.php">Log out</strong></a></h5>
 				</div>
			</header>

		<!-- Main -->
			<div id="main">

					<!-- One -->
					<section id="one">
						<header class="major">
							<h2>Rate our drinks.<br />
							 Let us know more about our product!</h2>
						</header>
						<p>You can rate all our drinks here.</p>

					</section>

    
 <form class="form-horizontal" role="form" action="rate.php" method="post" style="padding-top:60px;padding-left: 0px;">
 
  <div class="form-group">
    <div class="row">

	  <label for="update info" class="col-sm-2 control-label">Rating</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="i_info" id="i_info" style="padding-right: 100px" placeholder="info">

	  </div>

	  <br><br>
	  <label for="update info" class="col-sm-2 control-label">Drinks  </label>

		<!-- <div class="12u$"> -->
			<div class="select-wrapper">
				<select name="insert" id="insert" >
					<option value="0">Select one</option>
					<!-- <option value="1">friends ID</option> -->
						    <option value="1">Bobatea</option>
						    <option value="2">Mocha</option>
						    <option value="3">Latte</option>
						    <option value="4">Americano</option>
						    <option value="5">Cappuccino</option>
						    <option value="6">Espresso</option>
						    <option value="7">Chai Tea</option>
						    <option value="8">Hot Chocolate</option>
						    <option value="9">Frappuccino</option>
						    <option value="10">KF Milk Tea</option>
						    <option value="11">Coconut Milk Tea</option>
						    <option value="12">Honey Lemonade</option>
						    <option value="13">Matcha Red Bean</option>
						    <option value="14">Oolong Tea Cap</option>
						    <option value="15">Red Bean Wow Milk</option>
						    <option value="16">Herbal Jelly Wow Milk</option>
						    <option value="17">Iced Chai Tea Latte</option>
						    <option value="18">Caramel Apple Spice</option>
						    <option value="19">Caramel Cream</option>
						    <option value="20">Iced Americano</option>
						    <option value="21">Honey Tea Cap</option>
						    <option value="22">Winter Melon Tea Cap</option>
						    <option value="23">Mango Green Tea</option>
						    <option value="24">Taro Slush</option>
						    <option value="25">Longan Jujube Tea</option>
				</select>
			</div>
		<!-- </div> -->

     </div>
   </div> 
	
	<br><br>

	
 
  <div class="form-group" style="padding-top: 30px;">
		<ul class="actions">
			<input type="submit" value="Rate" class = "button special"/>
		</ul> 
  </div>
</form>
<br><br><br>
    <hr style="margin-top: 100px;">
    </div>
			</div>

			
	</body>
</html>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$link = mysqli_connect("localhost", "root", "", "first_db");

	//$username = mysqli_real_escape_string($link, $_POST['username']);
	$uid = mysqli_query($link, "SELECT userID FROM users WHERE username='$user'");
	$dr = mysqli_fetch_assoc($uid);
	$userid = (int)$dr['userID'];

	$i_info = (int)$_POST['i_info'];

	$did = (int)$_POST['insert'];  // Storing Selected Value In Variable
	//echo '<script type="text/javascript"> alert("'.$selected_val1.'")</script>';
	if( isset ( $i_info ) ) { 
		$result = mysqli_query($link, "select drinkName from drinks where drinkID = '$did' "); 
		$row = mysqli_fetch_array($result);
		$dn = $row['drinkName'];
		//Print '<script>alert("info:"+"'.$did.'"+"info:"+"'.$dn.'"+"info:"+"'.$userid.'"+"info:"+"'.$i_info.'");</script>'; 
		$query = mysqli_query($link, "INSERT INTO ratings (drinkID, drinkName, userID, ratings) VALUES ('$did', '$dn','$userid','$i_info')"); 
	}
}
?>