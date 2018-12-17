<?php 
session_start(); 
if(!isset($_SESSION['customer_email'])){
    header("location:customer_login.php");
}
include("functions.php");
?>

<!DOCTYPE>
<html>
	<head>
		<title>My Account</title>
		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .center{
            margin-left: auto;
            margin-right: auto;
        }
    </style>
	</head>
	
<body>
	
	
	
		<!--Header starts here-->
		<div class="container-fluid">
		    <h1>My Account</h1>
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
                    <a class="nav-link" href="cart.php">Shopping Cart</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#">Contact Us</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
		<!--Navigation Bar ends-->
	
		<!--Content wrapper starts-->
		<div class="container-fluid">
			
			<?php cart(); ?>
			<div class="row ">
			 
					<div class="col">
					<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b>" . $_SESSION['customer_email'] ;
					
					}
					?>
					</div>
					
			
			</div>
				<?php 
				if(!isset($_GET['my_orders'])){
					if(!isset($_GET['edit_account'])){
						if(!isset($_GET['change_pass'])){
							if(!isset($_GET['delete_account'])){
							
				echo "
				<div class= 'row'>		
                    <div class='list-group center' style='margin-top: 50px;margin-bottom: 50px;'>
                      <a href='Orders.php' class='list-group-item list-group-item-action'>My Orders</a>
                      <a href='edit_account.php' class='list-group-item list-group-item-action'>Edit Account</a>
                      <a href='change_pass.php' class='list-group-item list-group-item-action'>Change Password</a>
                      <a href='delete_account.php' class='list-group-item list-group-item-action text-danger'>Delete Account</a>
                    </div>
                </div>";
				}
				}
				}
				}
				?>
				
				<?php 
				if(isset($_GET['edit_account'])){
				include("edit_account.php");
				}
				if(isset($_GET['change_pass'])){
				include("change_pass.php");
				}
				if(isset($_GET['delete_account'])){
				include("delete_account.php");
				}
				
				
			?>
				
				</div>
			
			</div>
		</div>
		<!--Content wrapper ends-->
		
		
		
		<div class="fixed-bottom">
		
		<h2 style="text-align:center; padding-top:30px;">2018</h2>
		
		</div>
	
<!--Main Container ends here-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>