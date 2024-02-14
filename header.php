<?php 
    // error_reporting(0);
    include 'connection.php';
    $user_id=$_SESSION['user_id'];

    // if(isset($_POST['logout-btn'])){
    //     session_destroy();
    //     header('location:login.php');
    // }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--box icon link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="slick.css"/>
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>admin header</title>
    <style>
    
</style>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="index.php" class="logo"><img src='img/logo.png' height=80px width=60px></a>
            <nav class="navbar">
                <a href="index.php">home</a>
                <a href="about.php">About Us</a>
                <a href="shop.php">Shop</a>
                <a href="order.php">order</a>
                <a href="contact.php">Contact Us</a>
            </nav>
            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <?php
                    $select_wishlist=mysqli_query($conn,"SELECT * FROM `wishlist` WHERE `user_id`='$user_id'") or die('query failed');
                    $wishlist_num_rows=mysqli_num_rows($select_wishlist);
                ?>
                <a href="wishlist.php"><i class="bi bi-heart"></i><sup><?php echo $wishlist_num_rows ?></sup></a>
                <?php
                    $select_cart=mysqli_query($conn,"SELECT * FROM `cart` WHERE `user_id`='$user_id'") or die('query failed');
                    $cart_num_rows=mysqli_num_rows($select_cart);
                ?>
                <a href="cart.php"><i class="bi bi-cart"></i><sup><?php echo $cart_num_rows ?></sup></a>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>
            <div class="user-box">
                <p>Username: <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>
                <form method="post">
                    <button type="submit" class="logout-btn" name="logout-btn">Log out</button>
                </form>
            </div>
        </div>
    </header>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>