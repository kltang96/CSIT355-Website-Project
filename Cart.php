<?php
	session_start();
	$customerID = $_SESSION["customerID"] = "user1";
	$cart = $_SESSION["cart"] = [[1, 5],[2, 7]];
	$_SESSION["cartTable"] = $cartTable = [];

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
	
	//define functions
	//populate/update a table with cart item info
	function cartToTable() {
		foreach ($GLOBALS['cart'] as $item) {
			$itemInfo = $GLOBALS['conn']->query("SELECT name, price
				FROM `PRODUCTS` 
				WHERE productID=$item[0]");
				
			foreach ($itemInfo as $row) {
				$cartTable[] = [$item[0], $row["name"], $item[1], $item[1]*$row["price"]];
			}
		}
	}
	function dispCart($cartTable) {
		//table header
		echo '<table border="1"><tr>
				<th>#</th>
				<th>Product ID</th>
				<th>Item name</th>
				<th>Quantity</th>
				<th>Cost</th></tr>';
		//items
		$count = 1;
		if (empty($cartTable)) {
			echo "<tr><td colspan=\"100%\">No items in cart</td></tr>";
		}
		else {
			foreach ($cartTable as $item) {
				echo "<tr><td>$count</td>";
				foreach($item as $col) {
					echo "<td>$col</td>";
				}
				echo "</tr>\n";
				$count++;
			}
		}
		//end
		echo '</table>';
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
    <h1> Carts </h1>
    <div class="container ">
        <?php
			//cartToTable
			cartToTable();
			//dispCart
			dispCart($cartTable);
			echo '<br>';
		?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
