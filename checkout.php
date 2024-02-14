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


    if(isset($_POST['order-btn'])){
        $total=mysqli_real_escape_string($conn,$_POST['total']);
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $number=mysqli_real_escape_string($conn,$_POST['number']);
        $method=mysqli_real_escape_string($conn,$_POST['method']);
        $address=mysqli_real_escape_string($conn,'flate no. '.$_POST['flate'].', '.$_POST['street'].', '.$_POST['city'].', '.$_POST['state'].', '.$_POST['country'].', '.$_POST['pin']);
        $placed_on=date('d-M-Y');
        $cart_total=0;
        $cart_product[]='';
        $cart_query=mysqli_query($conn,"SELECT * FROM `cart` WHERE `user_id`='$user_id'")or die('query failed');
        if($total==0){
            echo'<script>alert("Add items to cart and checkout first")</script>';
        }else{
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name) || strlen($name)<=0) {
                // echo'<script>alert("Only letters and white space allowed for name")</script>';
                $message[]= "Only letters and white space are allowed for Name";
            }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // echo'<script>alert("Invalid email format")</script>';
                $message[] = "Invalid email format";
            }elseif(!(preg_match('/^[6-9]\d{9}$/', $number)) || !(strlen($number)==10)){
                // echo'<script>alert("Invalid Mobile number format")</script>';
                $message[] = "Invalid Mobile number format";
            }elseif(!(strlen($_POST['pin'])==6)){
                $message[] = "Invalid Pincode format";
            }elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['city']) || strlen($_POST['city'])<=0) {
                $message[]= "Only letters and white space are allowed for City";
            }elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['state']) || strlen($_POST['state'])<=0) {
                $message[]= "Only letters and white space are allowed for State";
            }elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['country']) || strlen($_POST['country'])<=0) {
                $message[]= "Only letters and white space are allowed for Country";
            }else{

                if(mysqli_num_rows($cart_query)>0){
                    while($cart_item=mysqli_fetch_assoc($cart_query)){
                        $cart_product[]=$cart_item['name'].'('.$cart_item['quantity'].')';
                        $sub_total=($cart_item['price']*$cart_item['quantity']);
                        $cart_total+=$sub_total;
                    }
                }
                $total_products=implode(', ', $cart_product);
                mysqli_query($conn,"INSERT INTO `order` (`user_id`,`name`,`number`,`email`,`method`,`address`,`total_products`,`total_price`,`placed_on`) VALUES('$user_id','$name','$number','$email','$method','$address','$total_products','$cart_total','$placed_on')");
                mysqli_query($conn,"DELETE FROM `cart` WHERE `user_id`='$user_id'");
                $message[]='order placed successfully';
            }
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
    <title>Checkout</title>
</head>
<body>
    <?php include 'header.php';?>
    <div class="banner" style="background-image:radial-gradient(blue,black);">
        <div class="detail" style="text-align:center;">
            <h1>Checkout</h1>
            <p>Signature Perfumes - Fragrance of Royalty</p>
            </div>
    </div>
    <!-- ---------orders----------- -->
    <div class="checkout-form">
        <h1 class="title">Payment Process</h1>
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
        <div class="display-order">
            <div class="box-container">
            <?php
                $select_cart=mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'")or die('query failed');
                $total=0;
                $grand_total=0;
                if(mysqli_num_rows($select_cart)>0){
                    while($fetch_cart=mysqli_fetch_assoc($select_cart)){
                        $total_price=($fetch_cart['price']*$fetch_cart['quantity']);
                        $grand_total=$total+=$total_price;
            ?>
                <div class="box">
                    <img src="img/<?php echo $fetch_cart['image']; ?>">
                    <span><?= $fetch_cart['name'];?> ( <?= $fetch_cart['quantity']; ?> )</span>
                </div>
            
            <?php
                    }
                }
            ?>
            </div>
            <span class="grand-total">Total Amount Payable: ₹<?=$grand_total;?></span>
        </div>
        <form method="POST">
            <input type="hidden" name="total" value="<?php echo $grand_total ?>">
            <div class="input-field">
                <label>Your Name</label>
                <input type="text" name="name" placeholder="Enter Your Name" required>
            </div>
            <div class="input-field">
                <label>Your Number</label>
                <input type="text" name="number" placeholder="Enter Your Number" required>
            </div>
            <div class="input-field">
                <label>Your email</label>
                <input type="text" name="email" placeholder="Enter Your Email" required>
            </div>
            <div class="input-field">
                <label>Select Payment Method</label>
                <select name="method" required>
                    <option selected disabled>Select payment method</option>
                    <option value="cash on delivery">Cash On Delivery(COD)</option>
                    <option value="credit card">Credit Card</option>
                    <option value="debit card">Debit Card</option>
                    <option value="paytm">Paytm</option>
                    <option value="phonpe">Phonepe</option>
                </select>
            </div>
            <div class="input-field">
                <label>Address line 1</label>
                <input type="text" name="flate" placeholder="e.g. Flate no." required>
            </div>
            <div class="input-field">
                <label>Address line 2</label>
                <input type="text" name="street" value="" placeholder="e.g. Street name" required>
            </div>
            <div class="input-field">
                <label>City</label>
                <input type="text" name="city" placeholder="e.g. Bangalore" required>
            </div>
            <div class="input-field">
                <label>State</label>
                <input type="text" name="state" placeholder="e.g. Karnataka" required>
            </div>
            <div class="input-field">
                <label>Country</label>
                <input type="text" name="country" placeholder="e.g. India" required>
            </div>
            <div class="input-field">
                <label>pincode</label>
                <input type="number" name="pin" placeholder="e.g. 560 xxx" required>
            </div>
            <input type="submit" name="order-btn" class="btn" value="order now">
        </form>
    </div>
    
    <?php include 'footer.php';?>
<script src="script.js" type="text/javascript"></script>
</body>
</html>