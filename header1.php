<?php 
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
            <a href="index1.php" class="logo"><img src='img/logo.png' height=80px width=60px></a>
            <nav class="navbar">
                <a href="index1.php">home</a>
                <a href="about1.php">About Us</a>
                <a href="shop1.php">Shop</a>
                <a href="contact1.php">Contact Us</a>
            </nav>
            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>
            <div class="user-box">
                    <a href="login.php"><button type="submit" class="logout-btn" name="login-btn">Log-In</button></a>
                    <a href="register.php"><button type="submit" class="logout-btn" name="register-btn">Register</button></a>
            </div>
        </div>
    </header>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>