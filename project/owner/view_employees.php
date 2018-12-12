
<table width="795" align="center" bgcolor="pink"> 

	
	<tr align="center">
		<td colspan="6"><h2>View All Employees Here</h2></td>
	</tr>
	
	<tr align="center" bgcolor="skyblue">
		<th>Employee id</th>
		<th>Email</th>
		<th>password</th>
		<th>phone</th>
	</tr>
	<?php 
	include("db.php");
	
	$get_c = "select * from EMPLOYEES";
	
	$run_c = mysqli_query($con, $get_c); 
	
	$i = 0;
	
	while ($row_e=mysqli_fetch_array($run_c)){
		
		$e_id = $row_e['employeeID'];
		$e_email = $row_e['email'];
		$e_password = $row_e['password'];
		$e_phone = $row_e['phone'];
		$i++;
	
	?>
	<tr align="center">
		<td><?php echo $e_id;?></td>
		<td><?php echo $e_email;?></td>
		<td><?php echo $e_password;?></td>
		<td><?php echo $e_phone;?></td>
	
	</tr>
	<?php } ?>




</table>