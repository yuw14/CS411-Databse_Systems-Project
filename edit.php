<?php
	session_start();
	if($_SESSION['user']){ 
	}
	else{
		header("location:index.php"); 
	}
	$user = $_SESSION['user']; 
	$id_exists = false;
?>
<html >
	<head>
		<title>EDIT profile</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet" href="assets/css/main2.css" />
		
	</head>

	<body id="top" >

		
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

		
			<div id="main">

					
					<section id="one">
						<header class="major">
							<h2>Update your Account information.<br />
							 Let us know more about you!</h2>
						</header>
						<p>You can insert, delete or update your information here. The information includes friends ID, allergies, favorite drinks, favorite ingredients.</p>

					</section>

    
 <form class="form-horizontal" role="form" action="edit.php" method="post" style="padding-top:60px;padding-left: 0px;">
 
  <div class="form-group">
    <div class="row">

	  <label for="update info" class="col-sm-2 control-label">Insert</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="i_info" id="i_info" style="padding-right: 100px" placeholder="info">

	  </div>

	  <br><br>
	  <label for="update info" class="col-sm-2 control-label">Into  </label>

		
			<div class="select-wrapper">
				<select name="insert" id="insert" >
					<option value="0">Select one</option>
					
						    <option value="allergies">allergies</option>
						    <option value="favorite_drinks">favorite drinks</option>
						  
						    <option value="friend">friend</option>
				</select>
			</div>
		

     </div>
   </div> 
	
	<br><br>

	

 
		<div class="form-group">
		  <div class="row">
	  
			<label for="update info" class="col-sm-2 control-label">Delete</label>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="d_info" id="d_info" style="padding-right: 100px" placeholder="info">
			</div>
	  
			<br><br>
			<label for="update info" class="col-sm-2 control-label">From</label>
	  
			
				  <div class="select-wrapper">
					  <select name="delete" id="delete" >
						  <option value="0">Select one</option>
						 
						    <option value="allergies">allergies</option>
						    <option value="favorite_drinks">favorite drinks</option>
						    
						    <option value="friend">friend</option>
						   
					  </select>
				  </div>
			  </div>
	  
		  
		 </div> 
  
  <br><br>
 
  <div class="form-group">
    <div class="row">
      <label for="update info" class="col-sm-2 control-label">Update</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="u1_info" id="u1_info" style="padding-right: 10px" placeholder="previous">
	  </div>
	  <div class="col-sm-7">
		<input type="text" class="form-control" name="u2_info" id="u2_info" style="padding-right: 10px" placeholder="new">
	   </div>
		<br><br>
				<label for="update info" class="col-sm-2 control-label">From</label>
		
				
					<div class="select-wrapper">
						<select name="update" id="update" >
							<option value="0">Select one</option>
							
						    <option value="allergies">allergies</option>
						    <option value="favorite_drinks">favorite drinks</option>
						   
						</select>
					
				</div>

	</div>
  </div>
  
  <br><br>
  <br>
 
  <div class="form-group" style="padding-top: 30px;">
		<ul class="actions">
			<input type="submit" value="Save Changes" class = "button special"/>
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

	
	$uid = mysqli_query($link, "SELECT userID FROM users WHERE username='$user'");
	$dr = mysqli_fetch_assoc($uid);
	$userid = $dr['userID'];

	$i_info = $_POST['i_info'];
	$d_info = $_POST['d_info'];
	$u1_info = $_POST['u1_info'];
	$u2_info = $_POST['u2_info'];
	$selected_val1 = $_POST['insert'];  

	$selected_val2 = $_POST['delete']; 

	$selected_val3 =  $_POST['update'];  

	if( isset ( $i_info ) ) { 
		$result = mysqli_query($link, "select * from ingredients where ingredientName = '$i_info' "); 
		$row = mysqli_fetch_array($result);
		$row2 = (int)$row['ingredientID'];
		
		if ($selected_val1 == "allergies"){
			$query = mysqli_query($link, "INSERT INTO allergies (userID, ingredientID) VALUES ('$userid', '$row2')"); 
		}
		if ($selected_val1 == "favorite_drinks"){
			
			$result = $client->run("MATCH (p:Person), (d:Drink) WHERE p.name = '$user' AND d.name = '$i_info' RETURN EXISTS((p)-[:FD]->(d)) AS flag");
			$flag = $result->firstRecord()->get('flag');
			if(!$flag){
				
				$client->run("MATCH (p:Person), (d:Drink) WHERE p.name = '$user' AND d.name = '$i_info' CREATE (p)-[:FD]->(d)");
			} 
		}
		
		if ($selected_val1 == "friend"){
			$result = $client->run("MATCH (p1:Person), (p2:Person) WHERE p1.name = '$user' AND p2.name = '$i_info' RETURN EXISTS((p1)-[:FriendWith]->(p2) -[:FriendWith]->(p1)) AS flag");
			$flag = $result->firstRecord()->get('flag');
			if(!$flag){
				$client->run("MATCH (p1:Person), (p2:Person) WHERE p1.name = '$user' AND p2.name = '$i_info' CREATE (p1)-[f:FriendWith]->(p2) -[:FriendWith]-> (p1)");
			}
		}
	}

	if( isset ( $d_info ) ) { 
		$result2 = mysqli_query($link, "select * from ingredients where ingredientName = '$d_info' "); 
		$row3 = mysqli_fetch_array($result2);
		$row4 = (int)$row3['ingredientID'];
		if ($selected_val2 == "allergies"){
			$query = mysqli_query($link, "DELETE FROM allergies where ingredientID = '$row4'"); 
		}
		if ($selected_val2 == "favorite_drinks"){
			
			$result = $client->run("MATCH (p:Person), (d:Drink) WHERE p.name = '$user' AND d.name = '$d_info' RETURN EXISTS((p)-[:FD]->(d)) AS flag");
			$flag = $result->firstRecord()->get('flag');
			if($flag){
				$client->run("MATCH (p:Person)-[f:FD]->(d:Drink) WHERE p.name = '$user' AND d.name = '$d_info' DELETE f");
			} 
		}
		if ($selected_val2 == "friend"){
			$result = $client->run("MATCH (p1:Person), (p2:Person) WHERE p1.name = '$user' AND p2.name = '$d_info' RETURN EXISTS((p1)-[:FriendWith]->(p2)-[:FriendWith]->(p1)) AS flag");
			$flag = $result->firstRecord()->get('flag');
			if($flag){
				$client->run("MATCH (p1:Person)-[f1:FriendWith]->(p2:Person)-[f2:FriendWith]->(p1) WHERE p1.name = '$user' AND p2.name = '$d_info' DELETE f1,f2");
			}
		}
	}
	if( isset ( $u1_info ) and  isset ( $u2_info )) { 
		
		$result3 = mysqli_query($link, "select * from ingredients where ingredientName = '$u1_info'"); 
		$result4 = mysqli_query($link, "select * from ingredients where ingredientName = '$u2_info'"); 
		$row5 = mysqli_fetch_array($result3);
		$row6 = (int)$row5['ingredientID'];
		$row7 = mysqli_fetch_array($result4);
		$row8 = (int)$row7['ingredientID'];
		if ($selected_val3 == "allergies"){
			$query = mysqli_query($link, "UPDATE allergies SET ingredientID = '$row8' where userID = '$userid' and ingredientID = '$row6'"); 
		}
		if ($selected_val3 == "favorite_drinks"){
			$query = mysqli_query($link, "UPDATE favorite_drinks SET drinkID = '$row8' where userID = '$userid'  and ingredientID = '$row6'");
		}

}
}
?>