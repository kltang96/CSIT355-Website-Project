<!DOCTYPE>

<?php 

include("db.php");

?>
<html>
	<head>
		<title>Inserting Product</title> 
		
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
	</head>
	
<body>
    <div class="container">
    <h2 align="center"style="
    margin-top: 10px;
">Insert Product</h2>        
	<form action="insert_product.php" method="post" enctype="multipart/form-data"> 
		
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td><p class="float-right"><b>Product Title:</b></p></td>
              <td><input type="text" name="product_title" size="60" required/></td>
            </tr>
            <tr>
              <td><p class="float-right"><b>Product Category:</b></p></td>
              <td><select name="product_cat" >
        					<option>Select a Category</option>
        					<?php 
        							$get_cats = "select * from categories";
        	
        							$run_cats = mysqli_query($con, $get_cats);
        	
        							while ($row_cats=mysqli_fetch_array($run_cats)){
        	
        							$cat_id = $row_cats['cat_id']; 
        							$cat_title = $row_cats['cat_title'];
        	
        							echo "<option value='$cat_id'>$cat_title</option>";}
        					?>	
        			</select>
        		</td>
            </tr>
            <tr>
        		<td align="right"><b>Product Image:</b></td>
        		<td><input type="file" name="product_image" /></td>
        	</tr>
        	<tr>
        		<td align="right"><b>Product Price:</b></td>
        		<td><input type="text" name="product_price" required/></td>
        	</tr>
        	<tr>
        		<td align="right"><b>Product Description:</b></td>
        		<td><textarea name="product_desc" cols="20" rows="10"></textarea></td>
        	</tr>
        	<tr>
        		<td align="right"><b>Product Keywords:</b></td>
        		<td><input type="text" name="product_keywords" size="50" required/></td>
        	</tr>
        			
        	<tr align="center">
        		<td colspan="7"><input type="submit" name="insert_post" value="Insert Product Now"/></td>
        	</tr>
          </tbody>
        </table>

	
	</form>
    </div>

</body> 
</html>
<?php 

	if(isset($_POST['insert_post'])){
	
		//getting the text data from the fields
		$product_title = $_POST['product_title'];
		$product_cat= $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];
	
		//getting the image from the field
		$target_dir= '../product_images/';
		$product_image = $_FILES['product_image']['name'];
		$target_file= $target_dir.basename($product_image);
		$product_image_tmp = $_FILES['product_image']['tmp_name'];
		
		move_uploaded_file($product_image_tmp,$target_file);
		
		 if (!get_magic_quotes_gpc()) {
        $title = addslashes($product_title);
        $cat = addslashes($product_cat);
	    $desc = addslashes($product_desc);
        $price = floatval($product_price);
        $picture =addslashes($target_file);
        $keywords = addslashes($product_keywords);
                            }
	
		 $insert_product = "insert into products (product_cat,product_title,product_price,product_desc,product_image,product_keywords) values ('$cat','$title','$price','$desc','$picture','$keywords')";
		 
		 $insert_pro = mysqli_query($con, $insert_product);
		 
		 if($insert_pro){
		 
		 echo "<script>alert('Product Has been inserted!')</script>";
		 echo "<script>window.open('index.php?insert_product','_self')</script>";
		 
		 }
	}








?>



