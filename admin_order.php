<?php 

    include 'connection.php';
    session_start();
    $admin_id=$_SESSION['admin_name'];

    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }

    //delete orders from database
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
       mysqli_query($conn,"DELETE FROM `order` WHERE id='$delete_id'") or die('query failed');
        $message[]='Order Removed Successfully';
        header('location:admin_order.php');
    }

    //updating order 
    if(isset($_POST['update_order'])){
        $order_id=$_POST['order_id'];
        $update_payment=$_POST['update_payment'];
        mysqli_query($conn,"UPDATE `order` SET payment_status='$update_payment' WHERE id='$order_id'")or die('query failed');
        $message[]='Order Updated Successfully';
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
    <title>Admin Panel</title>
    
</head>
<body>
    <?php
        include 'admin_header.php';
    ?>
    <?php
        if(isset($message)){
            foreach ($message as $message){
                echo'
                <div class="message">
                <span>'.$message.'</span>
                <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>
                ';
            }    
        }
    ?>
    <section class="order-container" style="background-color:white;">
        <h1 class="title">Total orders</h1>
        <div class="box-container" style="align-items:left;">
            <?php
                $select_orders=mysqli_query($conn,"SELECT * FROM `order`")or die('query failed');
                if(mysqli_num_rows($select_orders)>0){
                    while($fetch_orders=mysqli_fetch_assoc($select_orders)){
            ?>
                        <div class="box">
                            <p>User Name:<span><?php echo $fetch_orders['name'];?></span></p>
                            <p>User-ID:<span><?php echo $fetch_orders['user_id'];?></span></p>
                            <p>Placed on:<span><?php echo $fetch_orders['placed_on'];?></span></p>
                            <p>Number:<span><?php echo $fetch_orders['number'];?></span></p>
                            
                            <p>email:<span><?php echo $fetch_orders['email'];?></span></p>
                            <p>Total Price : <span>₹<?php echo $fetch_orders['total_price'];?></span></p>
                            <p>method:<span><?php echo $fetch_orders['method'];?></span></p>
                            <p>address:<span><?php echo $fetch_orders['address'];?></span></p>
                            <p>total nos products:<span><?php echo $fetch_orders['total_products'];?></span></p>
                            <form method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id'];?>">
                                <select name="update_payment" style="border-radius:10px; padding:15px;">
                                    <option disabled selected><?php echo $fetch_orders['payment_status'];?></option>
                                    <option value="pending">Pending</option>
                                    <option value="complete">Completed</option>
                                </select><br>
                                <input type="submit" name="update_order" value="update payment" class="btn" style="background-color:white; color:var(--blue);width:100%; border-radius:20px;text-transform:capitalize"><br>
                                <a href="admin_order.php?delete=<?php echo $fetch_orders['id'];?>;" onclick="return confirm('delete this order?');" class="delete">delete</a>
                            </form>
                        </div>
                        <?php
                                }
                            }else{
                                echo '
                                    <div class="empty">
                                        <p>No Order are Placed</p>
                                    </div>
                                ';
                            }
                        ?>

        </div>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>