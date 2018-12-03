 
 <?php include( "Config.php");
    if(mysqli_connect_errno()){
        echo "Jest problem z podłączeniem się do bazy danych. Skontaktuj się z administratorem.";
        die();
    }
    // loop through results of database query, displaying them in the table
    $result = mysqli_query($db,"SELECT * FROM PRODUCTS");
    ?>
</head>
<body>

    <h1>Products</h1>
    <?php
    echo "<p><b>View All</b>";

    echo "<table border='1' cellpadding='10'>";
                echo "<tr> <th>ID</th> <th>Name</th> <th>Description</th> <th>Price</th> <th>Picture</th> <th>Type</th> <th>Quantity</th> <th>Edit</th> <th>Add to cart</th></tr>";
                while($row = mysqli_fetch_object($result)) {

                // echo out the contents of each row into a table
                echo "<tr>";
                            echo '<td>' . $row->productid . '</td>';
                            echo '<td>' . $row->name . '</td>';
                            echo '<td>' . $row->description . '</td>';
                            echo '<td>' . $row->price . '</td>';
                            echo '<td>' . $row->picture . '</td>';
                            echo '<td>' . $row->type . '</td>';
                            echo '<td>' . $row->quantity . '</td>';
                            echo '<td><a href="edit.php?id=' . $row->id . '">Edit</a></td>';
                            echo '<td><a href="cart.php?id='.$row->id.'">Buy Now</a></td>';
                echo "</tr>";
                }
                // close table>
    echo "</table>";
    ?>
