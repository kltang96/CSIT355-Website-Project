<?php 
include("functions.php");
include("db.php");
session_start();
$_SESSION['cart_array'] = [];
?>

<!DOCTYPE>
<html>
	<head>
	    
		<title>My Cart</title>
		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">	
	<!--<link rel="stylesheet" href="styles/style.css" media="all" /> -->
	</head>
	
<body>
	
	<!--Main Container starts here-->
		<!--Header starts here-->
		<div class="container-fluid">
		    <h1>Shopping Cart</h1>
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
		    <div class="row">
		        <div class= "col-lg-12 float-right">
			    <?php cart(); ?>
			
    			<div id="shopping_cart"> 
    					
    					<span style="float:right; font-size:17px; padding:5px; line-height:40px;">
    					
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
    			</div>
			</div>
			
			<form action="" method="post" enctype="multipart/form-data">
			<div class="container">
				<table class="table" align="center">
                  <thead>
                    <tr align="center">
                      <th scope="col">Products</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Change quantity</th>
                      <th scope="col">Remove</th>
                      <th scope="col">Total Price</th>
                    </tr>
                  </thead>
                  <tbody>
                		<?php 
                            		    $total = 0;
                            		
                            		    global $con; 
                            		
                            		    //set id to either IP address or email address
                                    	$cid = '';
                                    	if(isset($_SESSION['customer_email'])) {
                                    	    $cid = $_SESSION['customer_email'];
                                    	} else {
                                    	    $cid = getIp();
                                    	}
                            		
                            		    $sel_price = "select * from cart where ip_add='$cid'";
                            		    $run_price = mysqli_query($con, $sel_price); 
                            		    
                            		    //the whole cart
                            		    while($p_price=mysqli_fetch_array($run_price)){
                            			
                            			    $pro_id = $p_price['p_id'];
                    			
                                			$qty = $p_price['qty'];
                            			
                            			    $pro_price = "select * from products where product_id='$pro_id'";
                            			
                            			    $run_pro_price = mysqli_query($con,$pro_price); 
                            			
                            			    //one item in the cart
                            			    $subtotal = 0;
                            			    while ($pp_price = mysqli_fetch_array($run_pro_price)){
                            			
                                			    $product_price = $pp_price['product_price'];
                                			    
                                			    $product_title = $pp_price['product_title'];
                                			
                                			    $product_image = $pp_price['product_image']; 
                                			
                                			    $subtotal = $product_price * $qty; 
                                			    $total += $subtotal; 
                                    			
                                    			$_SESSION['cart_array'][] = [$pro_id, $product_title, $qty, $subtotal];
                                    ?>
                	<!-- the actual cart -->
                    <tr align="center">
                      <td><u><?php echo $product_title; ?></u><br>
                						<img src="../product_images/<?php echo $product_image;?>" width="50" height="50"/></td>
                      <td><?php echo $qty; ?></td>
                      <td><input type="text" size="4" name="qty_<?php echo $pro_id; ?>"/></td>
                      <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>" style="height: 25px; width: 25px; color: #992222";/></td>
                      <td><?php echo "$" . $subtotal; ?></td>
                    </tr>
            <?php } } //wtf you can actually do this??? 
                $_SESSION['total'] = $total;
            ?>
                	<!-- subtotal -->
                    <tr align="center">
                      <td colspan='4'></td>
                      <td><b>Total: <?php echo "$" . $total;?></b></td>
                    </tr>
                    <tr align="center">
                		<td><input class="btn btn-btn-secondary" type="submit" name="return" value="< Return" /></td>
                		<td></td>
                		<td></td>
                		<td><input class="btn btn-btn-secondary" type="submit" name="update_cart" value="Update Cart"/></td>
                		<td><input class="btn btn-success" type="button" value="Checkout" onClick="self.location='checkout.php'"></td>
                	</tr>
                  </tbody>
                </table>
			</div>
			</form>
			
	        <?php 
	        function updatecart(){
		
    		    global $con; 
    		
                //set id to either IP address or email address
            	$cid = '';
            	if(isset($_SESSION['customer_email'])) {
            	    $cid = $_SESSION['customer_email'];
            	} else {
            	    $cid = getIp();
            	}
    		
    		    if(isset($_POST['update_cart'])){
    		        //remove
        			foreach($_POST['remove'] as $remove_id){
        			
            			$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$cid'";
            			
            			$run_delete = mysqli_query($con, $delete_product); 
            			
            			if($run_delete){
            		    	echo "<script>window.open('cart.php','_self')</script>";
        			    }
        			
        			}
        			
        			//update qty
        			$user_cart_query = "select * from cart where ip_add='$cid'";
            		$user_cart = mysqli_query($con, $user_cart_query); 
    				while($item=mysqli_fetch_array($user_cart)) {
    				    $p_id = $item['p_id'];
					    $qty_p_id = "qty_$p_id";
						$qty = $_POST[$qty_p_id];
						//if box is not empty;
						if($qty != '') {
    						$update_qty = "update cart set qty='$qty' WHERE p_id='$p_id' AND ip_add='$cid' ";
    						$run_qty = mysqli_query($con, $update_qty); 
						}
    			    }
    			    echo "<script>window.open('cart.php','_self')</script>";
    		
    		    }
    		    
    		    if(isset($_POST['return'])){
    		        echo "<script>window.open('index.php','_self')</script>";
    		    }
    	    }
            echo @$up_cart = updatecart();
            ?>

				
				</div>
			
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