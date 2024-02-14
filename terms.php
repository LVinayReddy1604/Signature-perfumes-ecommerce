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
  <title>Terms of Use | Signature Perfumes</title>
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
        padding-left:40px;
        padding-bottom:10px;
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
<?php include'header.php'?>
<body>
    <div class="body">
  <div class="logo">
    <img src="img/logo.png" alt="Signature Perfumes Logo">
  </div>
  <h1>Terms of Use</h1>
  <p style="padding-left:20px;">
    Welcome to Signature Perfumes! By accessing and using our website, you agree to comply with the following terms and conditions:
  </p>
  <h2>Intellectual Property</h2>
  <p>
    The content, logos, images, and trademarks displayed on our website are the property of Signature Perfumes and protected by applicable intellectual property laws. You are prohibited from using or reproducing any of these materials without our prior written consent.
  </p>
  <h2>Website Use</h2>
  <p>
    You agree to use our website for lawful purposes only. You must not engage in any activity that may disrupt or interfere with the proper functioning of the website or compromise its security.
  </p>
  <h2>Product Information</h2>
  <p>
    We strive to provide accurate and up-to-date information about our products. However, we do not warrant or guarantee the accuracy, completeness, or reliability of any product descriptions, pricing, or other information displayed on our website. It is your responsibility to verify the information before making a purchase.
  </p>
  <h2>Third-Party Links</h2>
  <p>
    Our website may contain links to third-party websites or services that are not owned or controlled by Signature Perfumes. We are not responsible for the content, privacy policies, or practices of such third-party websites. We encourage you to review the terms and conditions and privacy policies of any third-party websites you visit.
  </p>
  <h2>Disclaimer of Liability</h2>
  <p>
    Signature Perfumes shall not be liable for any direct, indirect, incidental, consequential, or punitive damages arising out of your access to or use of our website. We do not guarantee the availability, accuracy, or reliability of the website and its content.
  </p>
  <h2>Modification of Terms</h2>
  <p>
    We reserve the right to modify or update these terms of use at any time without prior notice. It is your responsibility to review the terms periodically. By continuing to use our website after any modifications, you accept and agree to abide by the updated terms.
  </p>
  <p>
    If you have any questions or concerns regarding our terms of use, please contact us via phone or email.
  </p>
  <div class="logo">
    <img src="img/logo.png" alt="Signature Perfumes Logo">
  </div>
</div>
</body>
<?php include'footer.php'?>
</html>