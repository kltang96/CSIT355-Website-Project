<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <label>Firstname</label>
  	  <input type="text" name="Fname" value="<?php echo $Fname; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Lastname</label>
  	  <input type="text" name="Lname" value="<?php echo $Lname; ?>">
  	</div>
  	<div class="input-group">
  	  <label>DOB</label>
  	  <input type="date" name="DOB" value="<?php echo $DOB; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Phonenumber</label>
  	  <input type="number" name="phonenumber" value="<?php echo $Phonenumber; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Address</label>
  	  <input type="text" name="address" value="<?php echo $address; ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>
