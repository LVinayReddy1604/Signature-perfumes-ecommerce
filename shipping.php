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
  <h1>Shipping Policy</h1>
  <br><br><p style="padding-left:20px;">
    At Signature Perfumes, we strive to provide prompt and reliable shipping services to ensure your order reaches you in a timely manner. Please review our shipping policy guidelines below:
  </p>
  <h2>Order Processing</h2>
  <p>
    We process orders within 1-2 business days after receiving payment and verification. Once your order is processed, it will be shipped out for delivery.
  </p>
  <h2>Shipping Methods</h2>
  <p>
    We offer various shipping methods to accommodate your needs. The available shipping options will be displayed during the checkout process. Please select the option that suits you best.
  </p>
  <h2>Shipping Rates</h2>
  <p>
    Shipping rates are calculated based on the destination, package weight, and shipping method chosen. The shipping cost will be displayed during the checkout process before finalizing your order.
  </p>
  <h2>Delivery Time</h2>
  <p>
    The estimated delivery time depends on the shipping method selected and the destination address. Please note that the estimated delivery time is provided by the shipping carrier and may be subject to unforeseen delays beyond our control.
  </p>
  <h2>Order Tracking</h2>
  <p>
    Once your order is shipped, we will provide you with a tracking number and instructions on how to track your package. You can use the tracking number to monitor the progress of your shipment until it reaches you.
  </p>
  <h2>International Shipping</h2>
  <p>
    We offer international shipping to select countries. Please note that additional customs fees, import duties, and taxes may apply upon arrival in your country. These charges are the responsibility of the recipient and are not included in the product or shipping costs. Please check with your local customs office for more information.
  </p>
  <h2>Shipping Restrictions</h2>
  <p>
    Some items may be subject to shipping restrictions due to international regulations or carrier policies. If we are unable to ship your order due to such restrictions, we will notify you promptly and provide a refund if applicable.
  </p>
  <h2>Customer Support</h2>
  <p>
    If you have any questions or concerns regarding our shipping policy or need assistance with your order, please contact our customer support team. We are here to help!
  </p>
  <div class="logo">
    <img src="img/logo.png" alt="Signature Perfumes Logo">
  </div>
</div>
</body>
<?php include'footer.php'?>
</html>