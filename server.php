<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$DOB ="";
$Phonenumber=0;
$address = "";
$Fname = "";
$Lname = "";


$errors = array(); 

// connect to the database
include("Config.php");

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $DOB = mysqli_real_escape_string($db, $_POST['DOB']);
  $Phonenumber = mysqli_real_escape_string($db, $_POST['phonenumber']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $Fname = mysqli_real_escape_string($db, $_POST['Fname']);
  $Lname = mysqli_real_escape_string($db, $_POST['Lname']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  
  if (empty($Phonenumber)) { array_push($errors, "Phonenumber is required"); }
  if (empty($address)) { array_push($errors, "address is required"); }
if (empty($Fname)) { array_push($errors, "first name is needed"); }
if (empty($Lname)) { array_push($errors, "last name is required"); }
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM CUSTOMERS WHERE customerID='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['customerID'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  
  //display header and errors
  
  if (count($errors) == 0) {

  	$query = "INSERT INTO CUSTOMERS (username, email, password, DoB, phone, address, Fname, Lname ) 
  			  VALUES('$username', '$email', '$password_1', '$DOB', '$Phonenumber', '$address', '$Fname', '$Lname' )";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
  else {
  	  $_SESSION['errors'] = "<font color='red'>ERROR: </font><br>"; 
	  foreach($errors as $e) {
		$_SESSION['errors'] .= "$e<br>";
	  }
	  $_SESSION['errors'] .= "	<br>";
  }
}