<?php 
    include 'connection.php';
    session_start();
    $user_id=$_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    }

    if(isset($_POST['logout-btn'])){
        session_destroy();
        header('location:login.php');
    }

    //adding product to wishlist
    if(isset($_POST['add-to-wishlist'])){
        $product_id=$_POST['product_id'];
        $product_name=$_POST['product_name'];
        $product_price=$_POST['product_price'];
        $product_image=$_POST['product_image'];

        $wishlist_number=mysqli_query($conn,"SELECT * FROM `wishlist` WHERE pid='$product_id' AND user_id='$user_id'")or die('query failed');
       

        if(mysqli_num_rows($wishlist_number)>0){
            $message[]='product already exists in wishlist';
        }
        else{
            mysqli_query($conn,"INSERT INTO `wishlist`(`user_id`,`pid`,`name`,`price`,`image`)values('$user_id','$product_id','$product_name','$product_price','$product_image')");
            $message[]='product successfully added in your wishlist';
        }
    }

    //adding product to cart
    if(isset($_POST['add-to-cart'])){
        $product_id=$_POST['product_id'];
        $product_name=$_POST['product_name'];
        $product_price=$_POST['product_price'];
        $product_image=$_POST['product_image'];
        $product_quantity=$_POST['product_quantity'];

        $cart_num=mysqli_query($conn,"SELECT * FROM `cart` WHERE `pid`='$product_id' AND `user_id`='$user_id'")or die('query failed');

       if(mysqli_num_rows($cart_num)>0){
            $message[]='product already exists in cart';
        }else{
            mysqli_query($conn,"INSERT INTO `cart`(`user_id`,`pid`,`name`,`price`,`quantity`,`image`)values('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
            $message[]='product successfully added in your cart';
        }
    }
?>
<style type="text/css">
    <?php include 'main.css'; ?>
</style>
<script>
    <?php include 'script2.js';?>
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
</head>
<body>
    <?php include 'header.php';?>
    <div class="banner" style="background-image:radial-gradient(blue,black);">
        <div class="detail" style="text-align:center;">
            <h1>Our Products</h1>
            <p>Signature Perfumes - Fragrance of Royalty</p>
            </div>
    </div>
    <!-- ---------products----------- -->
    <section class="shop" style="background-image:radial-gradient(blue,black);">
        <!-- <h1 class="title" style="color:white;font-size:50px;">shop best sellers</h1> -->
    
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
        <div class="box-container">
            <?php
                $select_products = mysqli_query($conn,"SELECT * FROM `products`") or die('query failed');
                if(mysqli_num_rows($select_products)>0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form method="post" class="box" style="background:#fff;
     box-shadow:var(--box-shadow);
     padding:2rem;
     margin:1rem;
     text-align:center;
     text-align:center;
     border-radius:10px;
     line-height:2;
     text-transform:uppercase;
     position:relative;">
                <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>"><img style=" width:100%;
    height:250px;"src="image/<?php echo $fetch_products['image']; ?>"></a>
                <div class="price" style="position:relative; margin-left:-30px;">₹<?php echo $fetch_products['price']; ?></div>
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_quantity" value="1" min="0">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                <div class="icon" style=" display:flex;
    padding:0;
    justify-content:center;
    align-items: center;
    background:var(--blue);
    margin:1rem;">
                    <a style=" width:40px;
     height:40px;
     border-radius:50%;
     padding:0;
     display:flex;
     justify-content:center;
     align-items:center;
     color:#000;
     background:#fff;
     margin: .5rem;
     box-shadow: var(--box-shadow);" href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="bi bi-eye-fill"></a>
                    <button style=" width:40px;
     height:40px;
     border-radius:50%;
     padding:0;
     display:flex;
     justify-content:center;
     align-items:center;
     color:#000;
     background:#fff;
     margin: .5rem;
     box-shadow: var(--box-shadow);" type="submit" name="add-to-wishlist" class="bi bi-heart"></button>
                    <button style=" width:40px;
     height:40px;
     border-radius:50%;
     padding:0;
     display:flex;
     justify-content:center;
     align-items:center;
     color:#000;
     background:#fff;
     margin: .5rem;
     box-shadow: var(--box-shadow);" type="submit" name="add-to-cart" class="bi bi-cart"></button>
                </div>
            </form>
            <?php
                    }
                }else{
                    echo '<p class="empty">no products added yet!</p>';
                }
            ?>
        </div>
    </section>
    
    <?php include 'footer.php';?>
<script src="script.js" type="text/javascript"></script>
</body>
</html>