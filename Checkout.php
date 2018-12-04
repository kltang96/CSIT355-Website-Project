<?php
	session_start();
	$customerID = $_SESSION["customerID"] = "user1";

	//connect to database
	$servername = "localhost";
	$dbname = "drinkDatabase";
	$username = "super"; 
	$password = "";
    try {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	// set the PDO error mode to exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	//echo "Connected successfully";
    }
    catch(PDOException $e) {
    	echo "Connection failed: " . $e->getMessage();
    }

	//calculate total price of order, and convert each price to money format
	$totalPrice = 0;
	foreach ($_SESSION["order"] as $item) {
		$totalPrice += $item[3];
		$item[3] = "$" . number_format($item[3], 2);
	}
	$totalPriceMoney = "$" . number_format($totalPrice, 2);
	//define functions
	function insertOrderToDB() {
		$date = date('Ymd');
		$GLOBALS['conn']->query("INSERT INTO `orders`(`customerID`, `cost`, `status`, `orderdate`, `fulfilldate`, `request`) 
			VALUES ('" . $GLOBALS['customerID'] . "', " . $GLOBALS['totalPrice'] . 
			", 'pending', '$date', null, '')");

	}
	function writeOrder() {
		$orderID = $GLOBALS['conn']->query("SELECT MAX(orderID) FROM `orders` WHERE customerID='" . $GLOBALS['customerID'] . "'");
		foreach ($orderID as $row) { //this legit the only way to get a single cell value PDO sucks
			foreach ($row as $col) {
				$orderID = $col;
			}
		}
		$filename = "orders/order_$orderID.txt";
		@$fp = fopen($filename, 'w');
		foreach ($_SESSION["order"] as $item) {
			for($i = 0; $i < $item.length-1; $i++) {
				fwrite($fp, $item[$i] . ',');
			}
			fwrite($fp, $item[$item.length] . '\n');
		}

	}
	
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="bootstrap-4.1.3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="Orders.css">

</head>
<body>
    <h1> Checkout </h1>
    <div class="container ">
		<form action="Orders.php" method="post">
		<p>Payment info: 
		<input type="text" placeholder="receives no payment information, as per project instructions" name="payment" size="100%" disabled>
		</p>
		<p>
		<input type="submit" value="Submit Order">
		</p>
		</form>
        <?php
			if(!empty($_SESSION["order"])) {
				insertOrderToDB();
				writeOrder();
			}
			//clear cart and order;
			$_SESSION["cart_array"] = [];
			$_SESSION["order"] = [];
		?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
