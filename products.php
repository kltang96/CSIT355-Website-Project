<div class="container">


<?php
 include("Config.php");
$productid = mysqli_real_escape_string($db,$_POST['productid']);
$query = "SELECT productid FROM PRODUCTS WHERE productid =  '$productid'" ;
 $result = mysqli_query($db,$query);
$rows = array();
while ( $row = mysqli_fetch_array($result)){



  array_push($rows, $row);
}
    
    
    
    
?>    
<div class="col-md-9">

<!--Image, Description, and Short Description-->

<div class="row">

    <div class="col-md-7">
       <img  width="500" class="img-responsive" src="<?php echo display_image($row['picture']); ?>" alt="">

    </div>

    <div class="col-md-5">

        <div class="thumbnail">
         

    <div class="caption-full">
        <h4><?php foreach($row['name'] as $row) {
    echo $row['name'];} ?>
 </h4>
        <hr>
        <h5 class=""><?php foreach( $row['price'] as $row){echo $row['price'];} ?></h5>

    
          
       <?php echo $row['description']; ?>

   
    <form action="">
        <div class="form-group">
            <a href="resources/cart.php?add=<?php echo $row['productid']; ?>" class="btn btn-primary">Buy Now</a>
        </div>
    </form>

    </div>
 
</div>

</div>


</div>


        <hr>



<div class="row">

<div role="tabpanel">

  <!-- Description -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>

  </ul>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">


           
        <p><?php echo $row['description']; ?></p> 

    </div>
    

 </div>

</div>


</div>




</div>

</div>
    <!-- End of Div Container -->

