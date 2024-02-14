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
    .body ul,ul p{
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
<?php include'header.php' ?>
<body>
    <div class="body">
  <div class="logo">
    <img src="img/logo.png" alt="Signature Perfumes Logo">
  </div>
  <h1>Return Policy</h1>
  <p>
    At Signature Perfumes, we value your satisfaction with our products. If you need to return or exchange a perfume, please review our policy below:
  </p>
  <h2>Eligibility for Returns</h2>
  <ul>
    <li>You may initiate a return or exchange within 14 days of receiving your order.</li>
    <li>The perfume must be in its original, unopened, and unused condition, with all packaging and labels intact.</li>
  </ul>
  <h2>Process for Returns</h2>
  <ul>
    <li>Contact our customer support team within the 14-day period to initiate the return or exchange process.</li>
    <li>Provide your order details, including the order number and the reason for the return or exchange.</li>
    <li>Our customer support team will guide you through the return process and provide you with a return authorization number (RAN).</li>
  </ol>
  <h2>Return Shipping</h2>
  <ul>
    <li>Customers are responsible for the return shipping costs unless the return is due to an error on our part (e.g., wrong item shipped, damaged item).</li>
    <li>We recommend using a trackable shipping method to ensure the safe return of the product.</li>
  </ul>
  <h2>Refunds and Exchanges</h2>
  <ul>
    <li>Once we receive the returned item and verify its condition, we will process the refund or exchange.</li>
    <li>Refunds will be issued to the original payment method used during the purchase.</li>
    <li>Exchanges will be processed based on the availability of the desired item. If the requested item is not available, we will issue a refund.</li>
  </ul>
  <h2>Non-Returnable Items</h2>
  <p>For safety and hygiene reasons, we cannot accept returns or exchanges on opened or used perfume bottles.</p>
  <h2>Damaged or Incorrect Items</h2>
  <p>If you receive a damaged or incorrect item, please contact our customer support team immediately. We will arrange for a replacement or refund, including any associated shipping costs.</p>
  <h2>Gift Returns</h2>
  <p>If you received a perfume as a gift and would like to return or exchange it, please contact our customer support team for assistance. We will provide a refund to the original purchaser or arrange for an exchange.</p>
  <p>Please note that our return policy is subject to change without prior notice. It is your responsibility to review the policy before making a purchase.</p>
  <p>If you have any questions or require further assistance regarding our return policy, please reach out to our customer support team via phone or email. We are here to assist you and ensure your shopping experience with Signature Perfumes is delightful.</p>
  <div class="logo">
    <img src="img/logo.png" alt="Signature Perfumes Logo">
  </div>
</div>
</body>
<?php include'footer.php' ?>
</html>