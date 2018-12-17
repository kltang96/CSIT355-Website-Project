<table width="80%" align="center" border='1'> 

	
	<tr align="center">
		<td colspan="6"><h2>View all orders here</h2></td>
	</tr>
	
	<tr align="center" bgcolor="grey" >
		<th>OrderID</th>
		<th>CustomerID</th>
		<th>Cost</th>
		<th>Status</th>
		<th>Order date</th>
		<th>Fulfill date</th>
	</tr>
	<?php 
	include("db.php");
	
	$get_order = "select * from orders";
	
	$run_order = mysqli_query($con, $get_order); 
	
	$i = 0;
	
	while ($row_order=mysqli_fetch_array($run_order)){
		
		$orderID = $row_order['orderID'];
		$customerID = $row_order['customerID'];
		$cost = $row_order['cost'];
		$status = $row_order['status'];
		$orderDate = $row_order['orderdate'];
		$fulfillDate = $row_order['fulfilldate'];
	
	?>
	<tr align="center">
		<td><?php echo $orderID;?></td>
		<td><?php echo $customerID; ?></td>
		<td><?php echo "$" . $cost;?></td>
		<td><?php echo $status;?></td>
		<td><?php echo $orderDate;?></td>
		<td><?php echo $fulfillDate;?></td>
		<td><a href="index.php?confirm_order=<?php echo $order_id; ?>">Complete Order</a></td>
	
	</tr>
	<?php } ?>
</table>