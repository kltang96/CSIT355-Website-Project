<?php 
session_start(); 

if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {

?>

<!DOCTYPE> 

<html>
	<head>
		<title>Admin Panel</title> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
            .list-group-item-action{
                text-align: center;
            }
        </style>
	</head>


<body> 

	    <h2 style="text-align:center; margin-top:30px; margin-bottom:30px;">Admin Panel</h2>
		
    	    <center>	
            <ul class="nav nav-tabs" style="padding-left: 90px;">
              <li class="nav-item">
                <a class="nav-link " href="index.php?insert_product">Insert New Prodcut</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?view_products">View All Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?insert_cat">Insert New Category</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="index.php?view_cats">View All Categories</a>
              </li>
                <li class="nav-item">
                <a class="nav-link " href="index.php?view_customers">View Customers</a>
              </li>
                <li class="nav-item">
                <a class="nav-link " href="index.php?view_orders">View Orders</a>
              </li>
                <li class="nav-item">
                <a class="nav-link " href="logout.php">logout</a>
              </li>
            </ul>
    		</center>

		<?php 
		if(isset($_GET['insert_product'])){
		
		include("insert_product.php"); 
		
		}
		if(isset($_GET['view_products'])){
		
		include("view_products.php"); 
		
		}
		if(isset($_GET['edit_pro'])){
		
		include("edit_pro.php"); 
		
		}
		if(isset($_GET['insert_cat'])){
		
		include("insert_cat.php"); 
		
		}
		
		if(isset($_GET['view_cats'])){
		
		include("view_cats.php"); 
		
		}
		
		if(isset($_GET['edit_cat'])){
		
		include("edit_cat.php"); 
		
		}
		
		if(isset($_GET['insert_brand'])){
		
		include("insert_brand.php"); 
		
		}
		
		if(isset($_GET['view_brands'])){
		
		include("view_brands.php"); 
		
		}
		if(isset($_GET['edit_brand'])){
		
		include("edit_brand.php"); 
		
		}
		if(isset($_GET['view_customers'])){
		
		include("view_customers.php"); 
		
		}
		
		?>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

<?php } ?>