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

    if(isset($_POST['submit-btn'])){
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $number=mysqli_real_escape_string($conn,$_POST['number']);
        $message=mysqli_real_escape_string($conn,$_POST['message']);

        $select_message=mysqli_query($conn, "SELECT * FROM `message` WHERE message = '$message' AND `user_id`='$user_id'")or die('query failed');
        if(mysqli_num_rows($select_message)>0){
            echo'<script>alert("Message Alredy Sent");</script>';
            
        }else{
            mysqli_query($conn, "INSERT INTO `message`(`user_id`,`name`,`email`,`number`,`message`) VALUES('$user_id','$name','$email','$number','$message')")or die('query failed');
            echo'<script>alert("message sent successfully");</script>';
            
        }
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
    <title>Orders</title>
</head>
<body>
    <?php include 'header.php';?>
    <div class="banner" style="background-image:radial-gradient(blue,black);">
        <div class="detail" style="text-align:center;">
            <h1>Orders</h1>
            <p>Signature Perfumes - Fragrance of Royalty</p>
            </div>
    </div>
    <!-- ---------orders----------- -->
    <div class="order-section">
        <div class="box-container">
            <?php
                $select_orders=mysqli_query($conn,"SELECT * FROM `order` WHERE `user_id`='$user_id'")or die('query failed');
                if(mysqli_num_rows($select_orders)>0){
                    while($fetch_orders=mysqli_fetch_assoc($select_orders)){
            ?>
            <div class="box" style="text-align:left;">
                <p>Placed on:<span><?php echo $fetch_orders['placed_on'];?></span></p>
                <p>Name:<span><?php echo $fetch_orders['name'];?></span></p>
                <p>Number:<span><?php echo $fetch_orders['number'];?></span></p>
                <p>Email:<span><?php echo $fetch_orders['email'];?></span></p>
                <p>Address:<span><?php echo $fetch_orders['address'];?></span></p>
                <p>Payment Method:<span><?php echo $fetch_orders['method'];?></span></p>
                <p>Your Orders:<span><?php echo $fetch_orders['total_products'];?></span></p>
                <p>Total price:₹<span><?php echo $fetch_orders['total_price'];?></span></p>
                <p>payment status:<span><?php echo $fetch_orders['payment_status'];?></span></p>
                
            </div>
            <?php   
                    }
                }else{
                    echo '
                            <div class="empty">
                                <p> Mo orders placed yet</p>
                            </div>
                        ';
                }
            ?>
        </div>
    </div>
    
    <?php include 'footer.php';?>
<script src="script.js" type="text/javascript"></script>
</body>
</html>