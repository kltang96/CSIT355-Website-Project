<?php 
session_start();

?>
<!DOCTYPE>
<html>
	<head>
		<title>Login Form</title>
<link rel="stylesheet" href="styles/login_style.css" media="all" /> 

	</head>
<body>
<div class="login">
<h2 style="color:white; text-align:center;"><?php echo @$_GET['not_admin']; ?></h2>

<h2 style="color:white; text-align:center;"><?php echo @$_GET['logged_out']; ?></h2>
	
	<h1>Owner Login</h1>
    <form method="post" action="login.php">
    	<input type="text" name="email" placeholder="username" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large" name="login">Login</button>
    </form>
</div>


</body>
</html>
<?php 

include("db.php"); 
	
	if(isset($_POST['login'])){
	
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$pass = mysqli_real_escape_string($con,$_POST['password']);
	    //echo password_hash("tang", PASSWORD_BCRYPT);
	$sel_user = "select * from Owner where userName='$email'";
	
	$run_user = mysqli_query($con, $sel_user); 
	$check_user = mysqli_fetch_assoc($run_user);
		$pass = $check_user['password'];
	
	if(password_verify($_POST['password'], $pass)){
	
	$_SESSION['owner_userName'] = $email;
	
	echo "<script>window.open('index.php?logged_in=You have successfully Logged in!','_self')</script>";
	
	}
	else {
	
	echo "<script>alert('Password or Email is wrong, try again!')</script>";
	
	}
	
	
	}
	
	
	
	
	








?>