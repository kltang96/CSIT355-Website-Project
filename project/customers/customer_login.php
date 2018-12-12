<?php 
include_once("functions.php");
include("db.php");
session_start(); 


if(!isset($_SESSION['customer_email'])){
	
	//echo "<script>window.open('login.php?not_customer=You are not a customer!','_self')</script>";
}
else {
    echo "<script>window.open('customer_login.php','_self')</script>";
}
?>
<html>
<head>
    <title>Customer Sign In</title>
		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="container"> 
	<center><h1 style="margin-bottom: 30px;margin-top: 30px;">Exotic Beverages</h1></center>
	
	<form class="mx-auto w-50 " method="post" action="">
          <div class="form-group">
            <label class= for="InputEmail1">Email address</label>
            <input type="text" name ="email"class="form-control" id="InputEmail1" placeholder="Enter email" required="required">
          </div>
          <div class="form-group">
            <label for="InputPassword1">Password</label>
            <input type="password" name="pass" class="form-control" id="InputPassword1" placeholder="Password" required="required">
          </div>
          <center>
              <button type="submit" class="btn btn-primary" name="login">Sign In</button>
              <a class="btn btn-outline-secondary" href="checkout.php?forgot_pass">Forgot Password?</a>
              <a class="btn btn-outline-secondary" href="customer_register.php" style="text-decoration:none;">New? Register Here</a>
          </center>
        </form>
	
	
	<?php 
	if(isset($_POST['login'])){
	
		$c_email = $_POST['email'];
		
		$c_pass = mysqli_real_escape_string($con, $_POST['pass']);
		
		//select hashed password
		$sel_c = "select customer_pass from customers where customer_email='$c_email'";
		$run_c = mysqli_query($con, $sel_c);
		$check_customer = mysqli_fetch_assoc($run_c);
		    $pass = $check_customer['customer_pass'];
		
		if($check_customer==0){
		
		echo "<script>alert('Password or email is incorrect, please try again!')</script>";
		exit();
		}
		$ip = getIp(); 
		
		$sel_cart = "select * from cart where ip_add='$ip'";
		
		$run_cart = mysqli_query($con, $sel_cart); 
		
		$check_cart = mysqli_num_rows($run_cart); 
		
		if($check_customer>0 and password_verify($_POST['pass'],$pass)){
		        //session_register("c_email");
        		$_SESSION['customer_email']=$c_email; 
        		
        		echo "<script>alert('You logged in successfully, Thanks!')</script>";
        		echo "<script>window.open('index.php', '_self')</script>";
		    
		}
		else {
		
		echo "<script>alert('login failed')</script>";
		
		
		}
	}
	
	
	?>
	
	
	

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>