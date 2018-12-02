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

	//operate on databse
	$colNameArray = [['orderID', 'Order ID'], 
					['cost', 'Cost'],
					['status', 'Status'], 
					['orderdate', 'Order date'],
					['fulfilldate',  'Fulfill date'],
					['request', 'Request']];
	$colNameCommaSeparatedString = '';
	foreach($colNameArray as $colName) {
		$colNameCommaSeparatedString = $colNameCommaSeparatedString . $colName[0] . ', ';
	}
	$colNameCommaSeparatedString = substr($colNameCommaSeparatedString, 0, strlen($colNameCommaSeparatedString)-2);
	echo $colNameCommaSeparatedString;
	$customerOrders = $conn->query("SELECT orderID, cost, status, orderdate, fulfilldate, request
		FROM `ORDERS` 
		WHERE customerID='$customerID'");

	//define functions
	function dispOrder() {
		return 'order -----';
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
    <h1> Orders </h1>
    <div class="container ">
        <?php
			foreach ($customerOrders as $row) {
				foreach ($colNameArray as $colName) {
					echo $colName[1] . ': ' . $row[$colName[0]] . '<br>';
				}
				//dispOrder
				echo dispOrder() . '<br><br>';
			}
		?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
