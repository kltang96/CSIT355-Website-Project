<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--Bootstrap and custom css libraries-->
<link rel="stylesheet" type="text/css" href ="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="Admin_Insert_Delete_product.css">
  <title>Product Entry Results</title>
</head>
<body>
<h1 align="center">Product Entry Results</h1>
<?php
  // create short variable names
  $name=$_POST['name'];
  $type=$_POST['type'];
  $description=$_POST['description'];
  $price=$_POST['price'];

  $target_dir = "/home/tejadaa4/public_html/TestFolder/images/";
  $target_file = $target_dir . basename($_FILES["picture"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if (!$name || !$type || !$description || !$price  || !move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
     echo "You have not entered all the required details.<br />"
          ."Please go back and try again.";
     exit;
  } 

  if (!get_magic_quotes_gpc()) {
    $name = addslashes($name);
    $type = addslashes($type);
	$description = addslashes($description);
    $price = floatval($price);
    $picture =addslashes($target_file);
  }

  @ $db = new mysqli('localhost', 'tejadaa4_Admin', 'Tejada__96', 'tejadaa4_DrinkDatabase');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

    $query="INSERT INTO PRODUCTS (NAME,DESCRIPTION,PICTURE,PRICE, TYPE) VALUES('$name','$description','$picture','$price', '$type')";
    $result= $db->query($query); //'$Picture
  

  if ($result) {
      echo  $db->affected_rows." Product inserted into database.";
  } else {
  	  echo "An error has occurred.  The item was not added.";
  }

  $db->close();
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
