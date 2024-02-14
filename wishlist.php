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

    //adding product to cart
    if(isset($_POST['add-to-cart'])){
        $product_id=$_POST['product_id'];
        $product_name=$_POST['product_name'];
        $product_price=$_POST['product_price'];
        $product_image=$_POST['product_image'];
        $product_quantity=1;

        $cart_num=mysqli_query($conn,"SELECT * FROM `cart` WHERE id='$product_id' AND user_id='$user_id'")or die('query failed');

       if(mysqli_num_rows($cart_num)>0){
            $message[]='product already exists in cart';
        }else{
            mysqli_query($conn,"INSERT INTO `cart`(`user_id`,`pid`,`name`,`price`,`quantity`,`image`)values('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
            $message[]='product successfully added in your cart';
        }
    }

    //delete product from wishlist
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
        
        mysqli_query($conn,"DELETE FROM `wishlist` WHERE pid='$delete_id' AND `user_id`='$user_id'") or die('query failed');
        header('location:wishlist.php');
    }

    //delete product from wishlist
    if(isset($_GET['delete_all'])){
        
        mysqli_query($conn,"DELETE FROM `wishlist` WHERE user_id='$user_id'") or die('query failed');
        header('location:wishlist.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <title>Wishlist</title>
</head>
<body>
    <?php include 'header.php';?>
    <div class="banner" style="background-image:radial-gradient(blue,black);">
        <div class="detail" style="text-align:center;">
            <h1>My Wishlist</h1>
            <p>Signature Perfumes - Fragrance of Royalty</p>
            </div>
    </div>
    <!-- ---------wishlist----------- -->
    <section class="shop">
        <h1 class="title"> Product Added in Wishlist</h1>

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
        <div class="box-container" >
            <?php
                $grand_total=0;
                $select_wishlist = mysqli_query($conn,"SELECT * FROM `wishlist` WHERE `user_id`='$user_id'") or die('query failed');
                if(mysqli_num_rows($select_wishlist)>0){
                    while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
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
                <a href="view_page.php?pid=<?php echo $fetch_wishlist['pid']; ?>"><img style=" width:100%;
    height:250px;"src="image/<?php echo $fetch_wishlist['image']; ?>"></a>
                <div class="price" style="position:relative;">₹<?php echo $fetch_wishlist['price']; ?></div>
                <div class="name"><?php echo $fetch_wishlist['name']; ?></div>
                <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price']; ?>">  
                <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">
                <div class="icon" >
                    <a href="view_page.php?pid=<?php echo $fetch_wishlist['pid']; ?>" class="bi bi-eye-fill"></a>
                    <a href="wishlist.php?delete=<?php echo $fetch_wishlist['pid']; ?>" class="bi bi-x" onclick="return confirm('do you want to delete this product from your wishlist')"></a>
                    <button type="submit" name="add-to-cart" class="bi bi-cart"></button>
                </div>
            </form>
            <?php
                $grand_total+=$fetch_wishlist['price'];
                    }
                }else{
                    echo '<p class="empty">no products added yet!</p>';
                }
            ?>
        </div>
        <div class="wishlist_total">
                <p>total amount payable:<span>₹<?php echo $grand_total; ?> /-</span></p>
                <a href="shop.php" class="dlt">continue shopping</a>
                <a href="wishlist.php?delete_all" class="dlt <?php echo ($grand_total)?'':'disabled'?>" onclick="return confirm('do you want to delete all items in your wishlist')">delete all</a>
        </div>
    </section>
    <?php include 'footer.php';?>
<script src="script.js" type="text/javascript"></script>
</body>
</html>