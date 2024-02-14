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
?>
<!DOCTYPE html>
<html>
<head>
  <title>Return Policy | Signature Perfumes</title>
  <style>
    body{
        background-image:radial-gradient(blue,black);
    }
    .body {
      font-family: Arial, sans-serif;
      margin: 20px;
      margin-top:200px;
      text-align:justify;
    }
    .body li,h2{
        color:white;
        padding-bottom:10px;
    }
    .body h1 {
      text-align: center;
      color:white;
    }
    .body p{
        padding:20px;
    }
    .body p {
      color:white;
      line-height: 1.5;
      padding-bottom:10px;
    }
    .body .logo {
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<?php include'header.php' ?>
<body>
    <div class="body">
    <div class="logo">
    <img src="img/logo.png" alt="Signature Perfumes Logo">
  </div>
  <h1>Copyrights Reserved</h1>
  <p>
    All content and materials available on this website, including but not limited to text, graphics, logos, images, and software, are the property of Signature Perfumes and are protected by applicable intellectual property laws. Any unauthorized use, reproduction, or distribution of these materials is strictly prohibited.
  </p><br>
  <p>
    Signature Perfumes retains all rights, title, and interest in and to the website and its content, including any intellectual property rights associated with it. You may not modify, copy, reproduce, republish, upload, post, transmit, or distribute any portion of the website without our prior written consent.
  </p><br>
  <p>
    The use of any trademarks, service marks, or logos displayed on the website without our written permission is also prohibited. All trademarks, service marks, and logos are the property of their respective owners.
  </p><br>
  <p>
    If you believe that any content on our website infringes upon your intellectual property rights, please contact us immediately with the relevant details, and we will take appropriate action to address the issue.
  </p><br>
  <p>
    If you have any questions or concerns regarding our copyrights reserved page, please contact us via phone or email.
  </p><br>
  <div class="logo">
    <img src="img/logo.png" alt="Signature Perfumes Logo">
  </div>
    </div>
</body>
<?php include'footer.php' ?>
</html>