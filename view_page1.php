<?php 
    include 'connection.php';
   

    //adding product to wishlist
    // if(isset($_POST['add-to-wishlist'])){
    //     echo'<script>alert("Login first to add to wishlist")</script>';
    // }

    // //adding product to cart
    // if(isset($_POST['add-to-cart'])){
    //     echo'<script>alert("Login first to add to cart")</script>';
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <title>View-Product</title>
</head>
<body>
    <?php include 'header1.php';?>
    <div class="banner" style="background-image:radial-gradient(blue,black);">
        <div class="detail" style="text-align:center;">
            <h1>Product Details</h1>
            <p>Signature Perfumes - Fragrance of Royalty</p>
            </div>
    </div>
    <!-- ---------product View----------- -->
    <section class="view_page">

        <?php
            if(isset($message)){
                foreach($message as $message){
                    echo'
                        <div class="message">
                            <span>'.$message.'</span>
                            <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                        </div>
                    ';
                }
            }
        ?>
            <?php
                if(isset($_GET['pid'])){
                    $pid=$_GET['pid'];
                    $select_products=mysqli_query($conn,"SELECT * FROM `products` WHERE id='$pid'") or die('query failed');
                    if(mysqli_num_rows($select_products)>0){
                        while($fetch_products=mysqli_fetch_assoc($select_products)){
            ?>
            <form method="post" class="form">
                    <img src="image/<?php echo $fetch_products['image'];?>" style="border:15px solid gray;border-radius:50%;height:500px;width:500px;"/>
                    <div class="detail" style="width=80%;">
                    <div class="price" style="padding-top:20px;font-size:50px;color:white;position:relative;align-items:center;text-align:center;margin-left:-100px;">₹<?php echo $fetch_products['price']; ?></div>
                    <div class="name" style="padding-top:20px;color:white;font-size:50px;position:relative;align-items:center;text-align:center;"><?php echo $fetch_products['name']; ?></div>
                    <div class="details" style="margin-top:20px;color:white;position:relative;align-items:center;text-align:center;"><?php echo $fetch_products['product_detail']; ?></div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                    <!-- <div class="icon" style="margin-top:50px;align-items:center;text-align:center;">
                         <button name="add-to-wishlist" class="bi bi-heart" style="width:10%; border-color:white;color:black;background:white;text-align:center;font-size:20px;"></button>
                        <input type="number" name="product_quantity" value="1" min="0" class="quantity" style="width:30%; border-color:white;color:black;background:white; text-align:center;font-size:20px;">
                        <button type="submit" name="add-to-cart" class="bi bi-cart" style="width:10%; border-color:white;color:black;background:white;text-align:center;font-size:20px;"></button>
                    </div> -->
                </div>
            </form>
            <?php
                        }
                    }
                }
            ?>
    </section>
    <?php //include 'footer1.php';?>
<script src="script.js" type="text/javascript"></script>
</body>
</html>