<?php 
include("functions.php");
session_start();
?>

<!DOCTYPE>
    
<html>
	<head>
		<title>Search Results</title>
		
		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<style>
            .card-img-top {
                width:260px;
                height:250px;
            }
            .card{
                margin-left:10px;
                margin-right:10px;
                margin-bottom:10px;
                margin-top:5px;
            }
            .card-body{
                
                width: 260px;
            }
    	</style>
	</head>
	
<body>
	
	<!--Main Container starts here-->
	
		<!--Header starts here-->
		<div class="container-fluid">
		<h1>Search Results</h1>
		</div>
		<!--Header ends here-->
		
		<!--Navigation Bar starts-->
		<div class = "container-fluid sticky-top">
            <div class="navbar navbar-expand-lg navbar-light bg-light">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Products
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="index.php?cat=1">Soda</a>
                      <a class="dropdown-item" href="index.php?cat=2">Coffee</a>
                      <a class="dropdown-item" href="index.php?cat=3">Juice</a>
                      <a class="dropdown-item" href="index.php?cat=4">Sports</a>
                      <a class="dropdown-item" href="index.php?cat=5">Energy</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="my_account.php">My Account</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="cart.php">Shopping Cart</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#">Contact Us</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link " href="logout.php">Log out</a>
                  </li>
                </ul>
              </div>
                <form method="get" action="results.php" enctype="multipart/form-data" class="form-inline float-right" style="margin-bottom: 0px;">
                    <input class="form-control mr-sm-2" type="text"name="user_query" placeholder="Search" aria-label="Search">
                    <button class="btn my-2 my-sm-0" type="submit" name="search" value="Search">Search</button>
                </form>
            </div>
        </div>
		<!--Navigation Bar ends-->
	
		<!--Content wrapper starts-->
			<div class="container-fluid">
			
		 
					
					<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
					
				<!-- info line -->
				<?php 
					if(isset($_SESSION['customer_email'])) {
					    echo "<b>Welcome: </b>" . $_SESSION['customer_email'] . " | " ;
					}
					else {
					    echo "<b>Welcome Guest:</b>";
					}
				?>
				<b style='color:orange;'>Your Shopping Cart - </b>
				Total items: <b><?php total_items();?></b>, Totalprice: <b><?php total_price(); ?></b> 
					
					</span>
			
	
			</div>
	<div class="container-fluid">
    	<div class="row">
        	<?php 
        	
        	if(isset($_GET['search'])){
        	
        	$search_query = $_GET['user_query'];
        	
        	$get_pro = "select * from products where product_keywords like '%$search_query%'";
        
        	$run_pro = mysqli_query($con, $get_pro); 
        	
        	while($row_pro=mysqli_fetch_array($run_pro)){
        	    $pro_desc=$row_pro['product_desc'];
        		$pro_id = $row_pro['product_id'];
        		$pro_cat = $row_pro['product_cat'];
        		$pro_brand = $row_pro['product_brand'];
        		$pro_title = $row_pro['product_title'];
        		$pro_price = $row_pro['product_price'];
        		$pro_image = $row_pro['product_image'];
        	
        		echo "
        			<div class='mt-2 mb-2 mr-3 card d-inline-block'>
                        <img class='card-img-top' src='$pro_image' alt='Card image cap'>
                        <div class='card-body'>
                            <h5 class='card-title'>$pro_title</h5>
                            <p class='card-text'> Price: $ $pro_price </p>
                            <p class='card-text'> $pro_desc </p>
                            <a href='index.php?add_cart=$pro_id' class='btn btn-primary'>Add To Cart</a>
                      </div>
                    </div>
        		";
        	
        	}
        	}
        	?>
    			
    		</div>
	</div>
		<!--Content wrapper ends-->
		
		
		
		<div id="footer">
		
		<h2 style="text-align:center; padding-top:30px;">2018</h2>
		
		</div>
	
	
	
	
	

<!--Main Container ends here-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>