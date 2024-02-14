<?php 
    include 'connection.php';

    if(isset($_POST['submit-btn'])){
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $number=mysqli_real_escape_string($conn,$_POST['number']);
        $message=mysqli_real_escape_string($conn,$_POST['message']);

        if (!preg_match("/^[a-zA-Z-' ]*$/",$name) || strlen($name)<=0) {
            echo'<script>alert("Only letters and white space allowed for name")</script>';
            // $message[]= "Only letters and white space allowed";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo'<script>alert("Invalid email format")</script>';
            // $message[] = "Invalid email format";
        }
        elseif(!(preg_match('/^[6-9]\d{9}$/', $number)) || !(strlen($number)==10)){
            echo'<script>alert("Invalid Mobile number format")</script>';
            // $message[] = "Invalid Mobile number format";
        }else{
            mysqli_query($conn, "INSERT INTO `message`(`user_id`,`name`,`email`,`number`,`message`) VALUES('0','$name','$email','$number','$message')")or die('query failed');
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
    <title>Contact Us</title>
</head>
<body>
    <?php include 'header1.php';?>
    <div class="banner" style="background-image:radial-gradient(blue,black);">
        <div class="detail" style="text-align:center;">
            <h1>Contact Us</h1>
            <p>Signature Perfumes - Fragrance of Royalty</p>
            </div>
    </div>
    <!-- ---------contact----------- -->
    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/feature1.jpg" height="100" width="100" alt="Feature1 image">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="img/feature3.png" height="100" width="100" alt="Feature1 image">
            <h6>Happy Customer</h6>
        </div>
    
        <div class="fe-box">
            <img src="img/feature2.jpg" height="100" width="100" alt="Feature1 image">
            <h6>Premium Products</h6>
         </div>
        <div class="fe-box">
            <img src="img/feature4.jpg" height="100" width="100" alt="Feature1 image">
            <h6>24x7 Support</h6>
        </div>
       
        <div class="fe-box">
            <img src="img/feature5.jpg" height="100" width="100" alt="Feature1 image">
            <h6>Save Money</h6>
        </div>
    </section>
    <!-- --------------------form------------------ -->
    <div class="form-container" style="border-top:1px solid white;border-bottom:1px solid white;">
        <div class="form" style=";width:80%;align-items:center;text-align:center;">
        <form method="POST">
            <div class="input-field">
                <label style="color:white;">Your Name</label><br>
                <input type="text" name="name" style="border-color:gray;color:white;width:85%;align-items:center;text-align:center;">
            </div>
            <div class="input-field">
                <label style="color:white;">Your Email</label><br>
                <input type="email" name="email" style="border-color:gray;color:white;width:85%;align-items:center;text-align:center;">
            </div>
            <div class="input-field">
                <label style="color:white;">Number</label><br>
                <input type="text" name="number" style="border-color:gray;color:white;width:85%;align-items:center;text-align:center;">
            </div>
            <div class="input-field">
                <label style="color:white;">Your message</label><br>
                <textarea name="message" style="border-color:gray;color:white;width:85%;height:200px;align-items:center;text-align:center;"></textarea>
            </div>
            <button type="submit" name="submit-btn" style="color:white;width:80%;background-color:blue;border:none;padding:.6rem 0;text-transform: uppercase;cursor:pointer;align-items:center;">send message</button>
        </form>
        </div>
    </div>
    <!-- -----------------------our contact------------------- -->
    <div class="address">
        <h1 class="title">Our Contact</h1>
        <div class="row">
            <div class="box">
                <i class="bi bi-map-fill"></i>
                <div>
                    <h4>address</h4>
                    <p>1093 Marigold Lane,Coral Way,<br>Miami,Florida,33169</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-telephone-fill"></i>
                <div>
                    <h4>Phone Number</h4>
                    <p>9908765432</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-envelope-fill"></i>
                <div>
                    <h4>email</h4>
                    <p>support@signatureperfumes.com</p>
                </div>
            </div>
        </div>
    </div>
    
    <?php //include 'footer.php';?>
<script src="script.js" type="text/javascript"></script>
</body>
</html>