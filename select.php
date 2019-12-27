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
		<title>EDIT profile</title>
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
							<h2>Go search for a drink!<br />
							 </h2>
						</header>
						<p>Select information below.</p>

					</section>

    
 <form class="form-horizontal" action="select.php" method="post" role="form" style="padding-top:40px;padding-left: 0px;">
 

<!-- cold/warm-->
	<section id="cold/warm">
	  <fieldset id="group1">
	<label for="tel" class="col-sm-2 control-label"> Cold/Hot </label>

			<div class="4u 12u$(small)">
				<input type="radio" id="cold" name="coldhot" value="cold" checked>
				<label for="cold">COLD</label>
				<input type="radio" id="hot" name="coldhot" value="hot">
				<label for="hot">HOT</label>
			</div>

</fieldset>
</section>

  
  <br>
<!-- sweetness-->     
<section id="sweetness">
  <fieldset id="group2">
 <label for="tel" class="col-sm-2 control-label"> Sweetness </label>
 									
									<div class="6u 12u$(small)">
										<input type="checkbox" id="sweet0" name="sweetness[]" value="0" checked>
										<label for="sweet0">0</label>
										<input type="checkbox" id="sweet20" name="sweetness[]" value="20" checked>
										<label for="sweet20">20</label>
										<input type="checkbox" id="sweet40" name="sweetness[]" value="40" checked>
										<label for="sweet40">40</label>
									</div>
									<div class="6u$ 12u$(small)">
										<input type="checkbox" id="sweet60" name="sweetness[]" value="60" checked>
										<label for="sweet60">60</label>
										<input type="checkbox" id="sweet80" name="sweetness[]" value="80" checked>
										<label for="sweet80">80</label>
										<input type="checkbox" id="sweet100" name="sweetness[]" value="100" checked>
										<label for="sweet100">100</label>
									</div>

  </fieldset>
  </section>

  <br>


<!-- topping -->  
<div class="form-group">
    <div class="row">
      <label for="tel" class="col-sm-2 control-label">What do you want</label>
      								</div>
									<div class="6u 12u$(small)">
										<input type="checkbox" id="boba" name="ingredients[]" value="1">
										<label for="boba">Boba</label>
										<input type="checkbox" id="puddings" name="ingredients[]" value="2" >
										<label for="puddings">Pudding</label>
										<input type="checkbox" id="caramel" name="ingredients[]" value="3" >
										<label for="caramel">caramel</label>
									</div>
									<div class="6u$ 12u$(small)">
										<input type="checkbox" id="coconut" name="ingredients[]" value="4" >
										<label for="coconut">coconut</label>
										<input type="checkbox" id="milk" name="ingredients[]" value="5" >
										<label for="milk">milk</label>
										<input type="checkbox" id="fruit" name="ingredients[]" value="6" >
										<label for="fruit">fruit</label>
									</div>
									<div class="6u$ 12u$(small)">
										<input type="checkbox" id="honey" name="ingredients[]" value="7" >
										<label for="honey">honey</label>
										<input type="checkbox" id="matcha" name="ingredients[]" value="8" >
										<label for="matcha">matcha</label>
										<input type="checkbox" id="red_bean" name="ingredients[]" value="9" >
										<label for="red_bean">red bean</label>
									</div>
									<div class="6u$ 12u$(small)">
										<input type="checkbox" id="taro" name="ingredients[]" value="10" >
										<label for="taro">taro</label>
										<input type="checkbox" id="cream" name="ingredients[]" value="11" >
										<label for="cream">cream</label>
										<input type="checkbox" id="jelly" name="ingredients[]" value="12" >
										<label for="jelly">jelly</label>
									</div>
									<div class="6u$ 12u$(small)">
										<input type="checkbox" id="jujube" name="ingredients[]" value="13" >
										<label for="jujube">jujube</label>
										<input type="checkbox" id="cocoa" name="ingredients[]" value="14" >
										<label for="cocoa">cocoa</label>
										<input type="checkbox" id="chocolate" name="ingredients[]" value="15" >
										<label for="chocolate">chocolate</label>
									</div>

									<br>

       <div class="form-group" style="padding-top: 30px;">
		<ul class="actions">
			<input type="submit" value="Search" class = "button special"/>
		</ul> 
  </div>
  <br><br>
</form>

	<section id="two">
		<header class="major">
			<h2>Enjoy your drink!</h2>
		</header>
		<p>Here are the drinks you want based on your preference. You can either take your recipe and make your own drink, or go to the store selling the drink you want.</p>

				<div class="row">
				<?php
				if($_SERVER["REQUEST_METHOD"] == "POST"){
					$link = mysqli_connect("localhost", "root", "", "first_db");
					
					$userid = 1;
					$item_num = 0;
					$i_id1 = -1;$i_id2 = -1;$i_id3 = -1;$i_id4 = -1;$i_id5 = -1;
					$coldhot = mysqli_real_escape_string($link, $_POST['coldhot']);
					$sweetness = $_POST['sweetness'];
					
					$dIDs = [];
					$drinks = mysqli_query($link, "SELECT drinkID FROM drinks");
					while($dr = mysqli_fetch_assoc($drinks)){
						$dIDs[] = $dr['drinkID'];
					}

					if(!empty($_POST['ingredients'])){
						$ingredients = $_POST['ingredients'];
						foreach ($ingredients as $ing){
							$ing_res = mysqli_query($link, "SELECT drinkID FROM toppings WHERE ingredientID='$ing'");
							$dIDsTemp = [];
							while($dr = mysqli_fetch_assoc($ing_res)){
								$dIDsTemp[] = $dr['drinkID'];
							}
							$dIDs = array_intersect($dIDs, $dIDsTemp);
						}


					$alIDs = [];
					$alIn = mysqli_query($link, "SELECT ingredientID FROM allergies natural join users where username='$user' ");
					while($al = mysqli_fetch_assoc($alIn)){
						$alIDs[] = $al['ingredientID'];
					}

					foreach ($alIDs as $alID){
							
							$alDR= mysqli_query($link, "SELECT drinkID FROM toppings WHERE ingredientID='$alID'");
							$alDRTemp = [];
							while($adr = mysqli_fetch_assoc($alDR)){
								$alDRTemp[] = $adr['drinkID'];
								
							}
					
							$dIDs = array_diff($dIDs, $alDRTemp);
					}


						
						mysqli_close ($link );
						
						$mysqli = new mysqli("localhost", "root", "", "first_db");

						if (!$mysqli->query("DROP TABLE IF EXISTS new_table2") || !$mysqli->query("CREATE TABLE new_table2(
											            drinkID int(11), 
											            
											            sum_calories int(11))")) {
						    //echo "Table1 creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}

						if (!$mysqli->query("DROP TABLE IF EXISTS new_table") || !$mysqli->query("CREATE TABLE new_table(
											            drinkID int(11), 
											            drinkName VARCHAR(255), 
											            avg_ratings REAL)")) {
						    //echo "Table1 creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}

						if (!$mysqli->query("DROP PROCEDURE IF EXISTS GetAverage") ||
						    !$mysqli->query("CREATE PROCEDURE GetAverage() BEGIN 
						    						DECLARE done int default 0;
											        DECLARE currdrinkID int(11);
											        DECLARE drinkIDcur CURSOR FOR (select drinkID
																					from drinks 
																					where sweetness in (".implode(',', $sweetness).")
																					and hot_cold='$coldhot'
																					and drinkID in 
																						(".implode(',', $dIDs)."));
											        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=1;

											        OPEN drinkIDcur;
											        REPEAT
											            FETCH drinkIDcur INTO currdrinkID;
											            INSERT INTO new_table
											            (SELECT DISTINCT drinkID, drinkName, AVG(ratings) AS avg_ratings
											             FROM ratings 
											             WHERE drinkID=currdrinkID
											             GROUP BY drinkID);          
											    UNTIL done
											    END REPEAT;
											    CLOSE drinkIDcur;
											    
											    ALTER TABLE new_table ADD Grade VARCHAR(10) NULL;
											    UPDATE new_table
											    SET Grade='A'
											    WHERE avg_ratings>=8;
											    UPDATE new_table
											    SET Grade='B'
											    WHERE (avg_ratings>=6)AND(avg_ratings<8);
											    UPDATE new_table
											    SET Grade='C'
											    WHERE avg_ratings<6;
											    END;")) 
						{
						    //echo "Stored procedure creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}

						if (!$mysqli->query("CALL GetAverage()")) {
						    //echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}


					

						if (!$mysqli->query("DROP PROCEDURE IF EXISTS GetSum") ||
						    !$mysqli->query("CREATE PROCEDURE GetSum() BEGIN
											        DECLARE done int default 0;
											        DECLARE currdrinkID int(11);
											        DECLARE drinkIDcur CURSOR FOR (select drinkID
																					from drinks 
																					where sweetness in (".implode(',', $sweetness).")
																					and hot_cold='$coldhot'
																						and drinkID in 
																						(".implode(',', $dIDs)."));
											        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=1;
	
											        
											        OPEN drinkIDcur;
											        REPEAT
											            FETCH drinkIDcur INTO currdrinkID;
											            INSERT INTO new_table2
											            (SELECT DISTINCT drinkID, SUM(ingredientCalories) AS sum_calories
											            FROM toppings natural join ingredients
											             WHERE drinkID=currdrinkID            
											            GROUP BY drinkID);                  
											    UNTIL done
											    END REPEAT;
											    CLOSE drinkIDcur;
											    
												END;")) 
						{
						    //echo "Stored procedure creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}

						if (!$mysqli->query("CALL GetSum()")) {
						    //echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}


						if (!($result = $mysqli->query("SELECT DISTINCT * FROM new_table natural join new_table2 order by Grade, sum_calories"))) {
						    //echo "SELECT failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}
						

						$mysqli -> close();
						
						$link = mysqli_connect("localhost", "root", "", "first_db");
						if (!$result) { exit();}
						while($row = mysqli_fetch_array($result)){ 
						//while($row = $result->fetch_assoc()){ 
							$image_path = "assets/images/thumbs/".$row['drinkID'].".png";
							$drink_path = "drinks/".$row['drinkID'].".php";			
							$dname = $row['drinkName'];
							$rating = $row['avg_ratings'];
							$grade = $row['Grade'];
							$calories = $row['sum_calories'];
						?>
							<article class="6u 12u$(xsmall) work-item">
								<a href="<?php echo $drink_path ?>" class="image fit thumb"><img src="<?php echo $image_path ?>" alt="" /></a>
								<h2><a href="<?php echo $drink_path ?>"><?php Print "$dname"?></a> <p><?php Print "Rating:   $grade"?></p> </h2>
								</p><?php Print "Calories:   $calories"?></p> 
								
							</article>

						<?php }
						mysqli_close ( $link );

					}else{

					$dIDs = [];
					$drinks = mysqli_query($link, "SELECT drinkID FROM drinks");
					while($dr = mysqli_fetch_assoc($drinks)){
						$dIDs[] = $dr['drinkID'];
					}
		

					$alIDs = [];
					$alIn = mysqli_query($link, "SELECT ingredientID FROM allergies natural join users where username='$user' ");
					while($al = mysqli_fetch_assoc($alIn)){
						$alIDs[] = $al['ingredientID'];
					}

					foreach ($alIDs as $alID){
							// Print '<script>alert("alID!"+"'.$alID.'");</script>'; 
							$alDR= mysqli_query($link, "SELECT drinkID FROM toppings WHERE ingredientID='$alID'");
							$alDRTemp = [];
							while($adr = mysqli_fetch_assoc($alDR)){
								$alDRTemp[] = $adr['drinkID'];
							}
							$dIDs = array_diff($dIDs, $alDRTemp);
					}


						$mysqli = new mysqli("localhost", "root", "", "first_db");

						if (!$mysqli->query("DROP TABLE IF EXISTS new_table2") || !$mysqli->query("CREATE TABLE new_table2(
											            drinkID int(11), 
											            
											            sum_calories int(11))")) {
						    //echo "Table1 creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}

						if (!$mysqli->query("DROP TABLE IF EXISTS new_table") || !$mysqli->query("CREATE TABLE new_table(
											            drinkID int(11), 
											            drinkName VARCHAR(255), 
											            avg_ratings REAL)")) {
						    //echo "Table1 creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}

						if (!$mysqli->query("DROP PROCEDURE IF EXISTS GetAverage") ||
						    !$mysqli->query("CREATE PROCEDURE GetAverage() BEGIN 
						    						DECLARE done int default 0;
											        DECLARE currdrinkID int(11);
											        DECLARE drinkIDcur CURSOR FOR (select drinkID
																					from drinks 
																					where sweetness in (".implode(',', $sweetness).") 
																					and hot_cold='$coldhot'
																					and drinkID in 
																						(".implode(',', $dIDs)."));
											        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=1;

											        OPEN drinkIDcur;
											        REPEAT
											            FETCH drinkIDcur INTO currdrinkID;
											            INSERT INTO new_table
											            (SELECT DISTINCT drinkID, drinkName, AVG(ratings) AS avg_ratings
											             FROM ratings 
											             WHERE drinkID=currdrinkID
											             GROUP BY drinkID);          
											    UNTIL done
											    END REPEAT;
											    CLOSE drinkIDcur;
											    
											    ALTER TABLE new_table ADD Grade VARCHAR(10) NULL;
											    UPDATE new_table
											    SET Grade='A'
											    WHERE avg_ratings>=8;
											    UPDATE new_table
											    SET Grade='B'
											    WHERE (avg_ratings>=6)AND(avg_ratings<8);
											    UPDATE new_table
											    SET Grade='C'
											    WHERE avg_ratings<6;
											    END;")) 
						{
						    //echo "Stored procedure creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}

						if (!$mysqli->query("CALL GetAverage()")) {
						    //echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}


					

						if (!$mysqli->query("DROP PROCEDURE IF EXISTS GetSum") ||
						    !$mysqli->query("CREATE PROCEDURE GetSum() BEGIN
											        DECLARE done int default 0;
											        DECLARE currdrinkID int(11);
											        DECLARE drinkIDcur CURSOR FOR (select drinkID
																					from drinks 
																					where sweetness in (".implode(',', $sweetness).")
																					 and hot_cold='$coldhot' 
																					 and drinkID in 
																						(".implode(',', $dIDs).")
																						);
											        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=1;
	
											        
											        OPEN drinkIDcur;
											        REPEAT
											            FETCH drinkIDcur INTO currdrinkID;
											            INSERT INTO new_table2
											            (SELECT DISTINCT drinkID, SUM(ingredientCalories) AS sum_calories
											            FROM toppings natural join ingredients
											             WHERE drinkID=currdrinkID            
											            GROUP BY drinkID);                  
											    UNTIL done
											    END REPEAT;
											    CLOSE drinkIDcur;
											    
												END;")) 
						{
						    //echo "Stored procedure creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}

						if (!$mysqli->query("CALL GetSum()")) {
						    //echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}


						if (!($result = $mysqli->query("SELECT DISTINCT * FROM new_table natural join new_table2 order by Grade, sum_calories"))) {
						    //echo "SELECT failed: (" . $mysqli->errno . ") " . $mysqli->error;
						}
						

						$mysqli -> close();
						
						$link = mysqli_connect("localhost", "root", "", "first_db");
						if (!$result) { exit();}
						while($row = mysqli_fetch_array($result)){ 
						//while($row = $result->fetch_assoc()){ 
							$image_path = "assets/images/thumbs/".$row['drinkID'].".png";
							$drink_path = "drinks/".$row['drinkID'].".php";			
							$dname = $row['drinkName'];
							$rating = $row['avg_ratings'];
							$grade = $row['Grade'];
							$calories = $row['sum_calories'];
						?>
							<article class="6u 12u$(xsmall) work-item">
								<a href="<?php echo $drink_path ?>" class="image fit thumb"><img src="<?php echo $image_path ?>" alt="" /></a>
								<h2><a href="<?php echo $drink_path ?>"><?php Print "$dname"?></a> <p><?php Print "Rating:   $grade"?></p> </h2>
								</p><?php Print "Calories:   $calories"?></p> 
								
							</article>

						<?php }
						mysqli_close ( $link );

					}
				}
			
			?>

					</section>

    <hr style="margin-top: 100px;">
    </div>
			</div>
 
	</body>
</html>