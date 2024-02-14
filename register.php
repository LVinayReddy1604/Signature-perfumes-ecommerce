<?php
    include 'connection.php';
    if (isset($_POST['submit-btn']) || isset($_POST['name']) || isset($_POST['email']) || isset($_POST['password']) || isset($_POST['cpassword'])){
        $filter_name=filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $name=mysqli_real_escape_string($conn, $filter_name);

        $filter_email=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email=mysqli_real_escape_string($conn, $filter_email);
        
        $filter_password=filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password=mysqli_real_escape_string($conn, $filter_password);
         
        $filter_cpassword=filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
        $cpassword=mysqli_real_escape_string($conn, $filter_cpassword);

       
        
        $select_user=mysqli_query($conn, "SELECT * FROM `users` WHERE email='$filter_email'") or die('query failed');

            // Validate password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
            
            if(isset($_POST['admin_confirm']) && strlen($_POST['admin_confirm'])>0){
                if (!preg_match("/^[a-zA-Z-' ]*$/",$name) || strlen($name) <= 1) {
                    $message[] = "Only letters and white space allowed are allowed in Name";
                    //echo'<script>alert("Only letters and white space allowed");</script>';
                }if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $message[] = "".$email." is not a valid email";
                }if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                    $message[]='Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                    // echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                }if($password!=$cpassword){
                    // echo'<script>alert("Wrong Password");</script>';
                    $message[]='Passwords Do Not Match';
                }if(mysqli_num_rows($select_user)>0){
                    $message[]='User Already Exists';
                }elseif($_POST['admin_confirm']!="ADMIN@1234"){
                    $message[]='Invalid Admin Code'; 
                }elseif($_POST['admin_confirm']=="ADMIN@1234"){
                    mysqli_query($conn, "insert into `users`(`name`,`email`,`password`,`user_type`) values ('$name','$email','$password','admin')") or die('Query Failed');
                    // echo'<script>alert("Admin Registration Successful");</script>';
                    $message[]='Admin Registration Successful';
                }
            }else{
                if(!preg_match("/^[a-zA-Z-' ]*$/",$name) || strlen($name) <= 1) {
                    $message[] = "Only letters and white space allowed in Name";
                    //echo'<script>alert("Only letters and white space allowed");</script>';
                }if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $message[] = "".$email." is not a valid email";
                }if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                    $message[]='Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                    // echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                }if($password!=$cpassword){
                    // echo'<script>alert("Wrong Password");</script>';
                    $message[]='Passwords Do Not Match';
                }elseif(mysqli_num_rows($select_user)>0){
                    $message[]='User Already Exists';
                }else{
                    mysqli_query($conn, "insert into `users`(`name`,`email`,`password`) values ('$name','$email','$password')") or die('Query Failed');
                    // echo'<script>alert("Registration Successful");</script>';
                    $message[]='Registration Successful';
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
    <!--box icon link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Register Page</title>
</head>
<body>
    <section class="form-container">
    <?php   
        if(isset($message)){
            foreach($message as $message){
                echo'
                    <div class="message">
                    <span>'. $message .'</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>
                ';
            }
        }
    ?>
        <form method="POST">
            <h1>Register Now</h1>
            <input type="text" name="name" placeholder="Enter your name here" required="required">
            <input type="email" name="email" placeholder="Enter your E-mail here" required="required">
            <input type="password" name="password" placeholder="Enter your password here"required="required">
            <input type="password" name="cpassword" placeholder="Confirm your password" required="required">
            <input type="password" name="admin_confirm" placeholder="(OPTIONAL FOR NORMAL USER) Enter text for admin confirm">
            <input type="submit" name="submit-btn" value="register now" class="btn">
            <p> Already have an account?<a style="text-decoration:underline;" href="login.php">Login Here</a></p>
        </form>
    </section>
</body>
</html>