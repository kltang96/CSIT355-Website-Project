<?php 
  session_start(); 
/**************************************************************************************************************************************
Starts the session and if statements which directs you to login.php if user attempts to not sign-in then is prompted back to login and must sign in and if the user logs out, user is then directed back to login.php
**************************************************************************************************************************************/

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
    <!------------------------------------------------------------
        called the css file and links it to this file.
      ------------------------------------------------------------>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<!------------------------------------------------------------
        sets up body and div tags
      ------------------------------------------------------------>
<div class="header">
	<h2>Home Page</h2>
</div>
    
<div class="content">
  	<!-- notification message for user if successful -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
            header("location:Directory.html");
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information which displays user's name -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif?>
</div>
		
</body>
</html>