<?php
    include 'connection.php';
    session_start();

    if (isset($_POST['submit-btn'])){
        $filter_email=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email=mysqli_real_escape_string($conn, $filter_email);
        
        $filter_password=filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password=mysqli_real_escape_string($conn, $filter_password);
        
        $select_user=mysqli_query($conn, "SELECT * FROM `users` WHERE email='$filter_email'") or die('query failed');

        if(mysqli_num_rows($select_user)>0){
           $row=mysqli_fetch_assoc($select_user);
           if($row['user_type']=='admin'){
                if($row['email']==$email && $row['password']==$password){
                    $_SESSION['admin_name'] = $row['name'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['id'];
                    $message[]='Login Successful';
                    echo'<script type="text/javascript">
                            window.setTimeout(function() {
                                window.location.href="admin_panel.php";
                                }, 3000);
                        </script>';
                    // sleep(3);
                    // header('location:admin_panel.php');
                }else{
                    $message[]='Wrong Password';
                }
           }else if($row['user_type']=='user'){
                if($row['email']==$email && $row['password']==$password){
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];
                    $message[]='Login Successful';
                    echo'<script type="text/javascript">
                            window.setTimeout(function() {
                                window.location.href="index.php";
                                }, 3000);
                        </script>';
                }else{
                    $message[]='Wrong Password';
                }
            }
        }else{
            $message[]='Email Does not exist';
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
    <title>Login Page</title>
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
            <h1>Login Now</h1>
            <div class="input-field">
                <label>Your Email:</label><br>
                <input type="email" name="email" placeholder="Enter your E-mail here" required="required">
            </div>
            <div class="input-field">
                <label>Password:</label><br>
                <input type="password" name="password" placeholder="Enter your password here"required="required">
            </div>
            <input type="submit" name="submit-btn" value="login now" class="btn">
            <p> Do not have an account?<a href="register.php" style="text-decoration:underline;">Register Here</a></p>
        </form>
    </section>
</body>
</html>