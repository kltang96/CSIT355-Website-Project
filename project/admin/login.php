<?php 
session_start();

?>
<!DOCTYPE>
<html>
	<head>
		<title>Login Form</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!--<link rel="stylesheet" href="styles/login_style.css" media="all" /> -->

	</head>
<body>
<div class="login">
<h2 style="color:white; text-align:center;"><?php echo @$_GET['not_admin']; ?></h2>

<h2 style="color:white; text-align:center;"><?php echo @$_GET['logged_out']; ?></h2>
	<div class="container">
	<center><h1>Admin Login</h1></center>
    <form class="w-50 mx-auto"method="post" action="login.php">
      <div class="form-group">
        <label for="InputEmail1">Email address</label>
        <input type="text" name ="email"class="form-control" id="InputEmail1" placeholder="Enter email" required="required">
      </div>
      <div class="form-group">
        <label for="InputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Password" required="required">
      </div>
      <center><button type="submit" class="btn btn-primary" name="login">Sign In</button></center>
    </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<?php 

include("db.php"); 
	//echo isset($_POST['login']);
	if(isset($_POST['login'])){
	
	$email = mysqli_real_escape_string($con,$_POST['email']);
	
	$Sqlstring=mysqli_real_escape_string($con,$_POST['password']);
	//echo password_hash("admin1", PASSWORD_BCRYPT);
	//$pass= password_hash($Sqlstring, PASSWORD_BCRYPT);
	$sel_user = "select user_pass from admins where user_email='$email'";
	$run_user = mysqli_query($con, $sel_user); 
	$check_user = mysqli_fetch_assoc($run_user);
		$pass = $check_user['user_pass'];
		
    if(password_verify($_POST['password'] ,$pass)) {
        $_SESSION['user_email']=$email; 
        echo "<script>window.open('index.php?logged_in=You have successfully Logged in!','_self')</script>";
    } else 
        echo "<script>alert('Password or Email is wrong, try again!')</script>";
    
	}
	
	
	
	
	
	
	
	








?>