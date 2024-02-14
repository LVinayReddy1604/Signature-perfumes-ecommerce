<?php
if(isset($_POST['logout-btn'])){
    session_destroy();
    header('location:login.php');
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>admin header</title>
    <style>
        header{
    display:block;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    z-index:99;
    transition:.3s;
    background:white;
    padding:5px 0;
    border-bottom: 2px solid var(--blue);
}

.flex{
    max-width:1200px;
    display:flex;
    justify-content: space-between;
    align-items: center;
    position:relative;
    margin:0 auto;
}
.navbar a{
    margin:0 1rem;
    font-size:1rem;
    color:#000;
    text-transform: uppercase;
}
.navbar a:hover,
header .icons i:hover{
    color:var(--blue);
    text-decoration:none;
}
.header .icons{
    display:flex;
}
.header .icons i{
    margin-left: 1.2rem;
    font-size: 1.5rem;
    cursor:pointer;
    color:#000;
}
#menu-btn{
    display:none;
}
.header .user-box{
    position:absolute;
    top:120%;
    right:0rem;
    background:rgba(255, 255, 255, 0.8);
    box-shadow:var(--box-shadow);
    border-radius: .5rem;
    padding:1rem;
    text-align:center;
    width:20rem;
    transform:scale(0);
    transform-origin:top right;
    line-height:2;
}
.logout-btn{
    background:#000;
    color:#fff;
    text-transform: uppercase;
    width:10rem;
    border-radius: 4px;
}
.header .user-box.active{
    transform:scale(1.0);
    transition:.2s linear;
} 
    </style>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="admin_panel.php" class="logo"><img src='img/logo.png' height=100px width=80px></a>
            <nav class="navbar">
                <a href="admin_panel.php">home</a>
                <a href="admin_product.php">products</a>
                <a href="admin_order.php">orders</a>
                <a href="admin_user.php">users</a>
                <a href="admin_message.php">messages</a>
            </nav>
            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>
            <div class="user-box">
                <p>Username: <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>Email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <form method="post">
                    <button type="submit" class="logout-btn" name="logout-btn">Log out</button>
            </div>
        </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>Admin Dashboard</h1>
            <p>Lorem ipsum dolor sit amet consectetur.</p>
        </div>
    </div>
</body>
</html>