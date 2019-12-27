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
							<h2>More drinks from your friends' favorite!<br />
							 </h2>
						</header>
						<p>Or try some new drinks!</p>

					</section>



<?php 
	require_once __DIR__ .'/vendor/autoload.php';
	use GraphAware\Neo4j\Client\ClientBuilder;
	
    $config = \GraphAware\Bolt\Configuration::newInstance()
	->withCredentials('lidingl2', 'b.iMdymGhdGYaM.wlkebHGSvwjzWA5F')
	->withTimeout(10)
	->withTLSMode(\GraphAware\Bolt\Configuration::TLSMODE_REQUIRED);
	
	$driver = \GraphAware\Bolt\GraphDatabase::driver('bolt://hobby-efdadablacmmgbkedjegaddl.dbs.graphenedb.com:24787', $config);
	$client = $driver->session();
    

    // find common drinks (trangular structure)
    $parameter = array('name1' => $user);
	$query1 = "Match (n1:Person{name: {name1}}) -[:FD]->(d1:Drink) <-[:FD]- (n2:Person) -[:FriendWith]- (n1) With n1, collect(distinct n2.name) as clt0, collect(distinct d1.idx) as clt Return clt0, clt";
	$result = $client->run($query1,$parameter)->records();
	$array0 = array();
	$array1 = array();
    foreach ($result as $record){
	   $array0 = ($record->get('clt0'));
	   $array1 = ($record->get('clt'));
	   
    }


    //find different drinks
    $query2 = "Match (n1:Person{name: {name1}})-[:FriendWith]-(n2:Person) -[:FD]->(d1:Drink) Where (n2.name in {array0}) and (not (d1.idx in {array1})) With n2, collect(distinct d1.idx) as clt Return clt";
    $parameters = array('name1' => $user, 'array0' => $array0, 'array1' => $array1);
    $result = $client->run($query2,$parameters)->records();
     $recommends = array();
    foreach ($result as $record){
        $temp = ($record->get('clt'));
        foreach ($temp as $value){     
			  array_push($recommends, $value);
			  //print_r($value);
        }
    }
    // print_r($recommends);


	// random recommendation: use sql
	if (count($recommends) == 0) {

		$query3 = "Match (n1:Person{name: {name1}})-[:FD]->(d1:Drink) Return distinct d1.idx as drinkid";
		$parameters = array('name1' => $user, 'array1' => $array1);
		$result3 = $client->run($query3,$parameters)->records();
		$fd_array = array();
		foreach ($result3 as $record) {
			$idx = ($record->get('drinkid'));
			array_push($fd_array, $idx);
		}

		//$fd_array = array(1,2,3); // delete this if the connection works 
		// first register. no favorite drink
		$link =  mysqli_connect("localhost", "root", "", "first_db");
		if (count($fd_array == 0)) {
			$result = mysqli_query($link, "SELECT drinkID FROM drinks ORDER BY RAND() LIMIT 4");
		}
		else {
		
			$result = mysqli_query($link, "SELECT drinkID FROM drinks WHERE drinkID not in (".implode(',', $fd_array).") ORDER BY RAND() LIMIT 4");
		}


		while($row = mysqli_fetch_array($result)){ 
			$did = $row['drinkID'];
			array_push($recommends, $did);
		}
	

	}
?>

<section>
	<div class="row">
<?php 
	$link =  mysqli_connect("localhost", "root", "", "first_db");
	$result = mysqli_query($link, "SELECT DISTINCT drinkName, drinkID FROM drinks WHERE drinkID in (".implode(',', $recommends).") "); 
	while($row = mysqli_fetch_array($result)){ 
			$image_path = "assets/images/thumbs/".$row['drinkID'].".png";	
			$dname = $row['drinkName'];
			$drink_path = "drinks/".$row['drinkID'].".php";	
			
		?>
			<article class="6u 12u$(xsmall) work-item">
				<a href="<?php echo $drink_path ?>" class="image fit thumb"><img src="<?php echo $image_path ?>" alt="" /></a>
				<h2><a href="<?php echo $drink_path ?>"><?php Print "$dname"?></a></h2>
					
			</article>

		<?php }



?>
		</div>
	</div>
</section>

 
	</body>
</html>
