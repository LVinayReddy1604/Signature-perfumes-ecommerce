<?php 
    error_reporting(0);
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

    
    //update product
    if(isset($_POST['update_product'])){
        $update_id=$_POST['update_id'];
        $update_name=$_POST['update_name'];
        $update_price=$_POST['update_price'];
        $update_detail=$_POST['update_detail'];
        $update_image=$_FILES['update_image']['name'];
        $update_image_tmp_name=$_FILES['update_image']['tmp_name'];
        $update_image_folder='image/'.$update_image;

        $pattern = '/^\d+(\.\d{2})?$/';
        if (!preg_match("/^[a-zA-Z-' ]*$/",$update_name)) {
            echo'<script>alert("Only letters and white space allowed for product name")</script>';
        }if(!preg_match($pattern, $update_price)){
            echo'<script>alert("Invalid Price format")</script>';
        }else{
        
            $update_query=mysqli_query($conn, "UPDATE `products` SET `id`='$update_id', `name`='$update_name',`price`='$update_price', `product_detail`='$update_detail',`image`='$update_image' WHERE id='$update_id'") or die('query failed');
            if($update_query){
                move_uploaded_file($update_image_tmp_name , $update_image_folder);
            }
            header('location:admin_product.php');
        }
    }
    

    //adding products to DB
    if(isset($_POST['add_product'])){
        $product_name=mysqli_real_escape_string($conn, $_POST['name']);
        $product_price=mysqli_real_escape_string($conn, $_POST['price']);
        $product_detail=mysqli_real_escape_string($conn, $_POST['detail']);
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'image/'.$image;

        $pattern = '/^\d+(\.\d{2})?$/';
        if (!preg_match("/^[a-zA-Z-' ]*$/",$product_name)) {
            $message[]='Product Added Successfully';
            // $message[]='Only letters and white space allowed for product name';
            // echo'<script>alert("Only letters and white space allowed for product name")</script>';
        }if(!preg_match($pattern, $product_price)){
            $message[]='Product Added Successfully';
            // $message[]='Invalid Price format';
            // echo'<script>alert("Invalid Price format")</script>';
        }else{
            $select_product_name=mysqli_query($conn, "SELECT `name` FROM `products` WHERE `name`='$product_name'") or die('Query Failed');

            if(mysqli_num_rows($select_product_name)>0){
                $message[]='Product name already exists';
            }else{
                if($image_size > 2000000){
                    $message[]='image size is too large';
                }else{
                    $insert_product=mysqli_query($conn, "INSERT INTO `products`(`name`,`price`,`product_detail`,`image`) VALUES ('$product_name','$product_price','$product_detail','$image')") or die('query failed');
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[]='Product Added Successfully';
                }
                
            }
            header('location:admin_product.php');
        }
    }

    //delete products from database
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
        $select_delete_image=mysqli_query($conn, "SELECT image FROM `products` WHERE id='$delete_id'")or die('query failed');
        $fetch_delete_image=mysqli_fetch_assoc($select_delete_image);
        unlink('image/'.$fetch_delete_image['image']);

        $pro=mysqli_query($conn,"SELECT * FROM `products` WHERE id='$delete_id'")or die('query failed');
        if(mysqli_num_rows($pro)>0){
           mysqli_query($conn,"DELETE FROM `products` WHERE id='$delete_id'") or die('query failed');
        }
        $car=mysqli_query($conn,"SELECT * FROM `cart` WHERE pid='$delete_id'")or die('query failed');
        if(mysqli_num_rows($car)>0){
            mysqli_query($conn,"DELETE FROM `cart` WHERE pid='$delete_id'") or die('query failed');
        }
        $wish=mysqli_query($conn,"SELECT * FROM `wishlist` WHERE pid='$delete_id'")or die('query failed');
        if(mysqli_num_rows($wish)>0){
            mysqli_query($conn,"DELETE FROM `whishlist` WHERE pid='$delete_id'") or die('query failed');
        }
        header('location:admin_product.php');
    }

    if(isset($_POST['Cancel_btn'])){
        header('location:admin_product.php');
    }

    if(isset($_post['option-btn'])){
        echo"<script>document.querySelector('.update-container').style.display='none'</script>";
        header('location:admin_redirect.php');
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
    <script type="text/javascript" src="script.js"></script>
    <title>Admin Panel</title>
    <style>
        
.add-container{
    width:80%;
    margin-top:5rem;
    height:auto;
    margin-left:5rem;
    margin-top:5rem;
    margin-bottom:5rem;
    align-items:center;
    background-color:#f8f8f8e2;
    position:relative;
    border:2px solid black;
    border-radius:20px;
    padding:20px;
}
.add-container form{
    width:80%;
    margin:1rem auto;
    background:rgb(225 225 225/80%);
    box-shadow:var(--box-shadow);
    padding:2rem;
    position:relative;
    border-radius:5px;
}
.add-container form label{
    text-transform:uppercase;
    width:40%;
}
.add-container form input{
    width:45%;
}
.add-container form textarea{
    width:45%;
    height:200px;
}
.add-container form button{
    width:40%;
    background:var(--blue);
    border:none;
}
.show-products,
.message-container,
.order-container{
    position:relative;
    background:var(--blue);
    margin-top:0rem;
}

.show-products .box-container{
    grid-template-columns:repeat(auto-fit,minmax(20rem,1fr));
}
.box-container .box{
    line-height:2;
}  
.box-container .box h4{
    text-transform:capitalize;
}
.box-container .box img{
    width:100%;
    margin-bottom:1rem;
}
.edit,.delete{
    color:black;
    background:var(--blue);
    padding:.5rem 1.5rem;
    text-transform:capitalize;
    line-height: 2;
}

.update-container{
    top:0;
    left:0;
    right:0;
    height:130%;
    width:100%;
    overflow-y:auto;
    background:white;
    z-index:90;
    padding:2rem;
    align-items:center;
    justify-content:center;
    display:none;
    
}
.update-container form{
    box-shadow:var(--box-shadow);
    width:50%;
    background:#fff;
    padding:1rem;
    margin:2rem auto;
    text-align:center;
    padding-bottom:200px;
}
.update-container .edit, 
.update-container .btn{
    width:40%;
    cursor:pointer;
}
.update-container form img{
    width:60%;
}
    </style>
</head>
<body>
    <?php
        include 'admin_header.php';
    ?>
    <?php
        if(isset($message)){
            foreach($message as $message){
                echo'
                <div class="message">
                <span>'.$message.'</span>
                <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>
                ';
            }
        }
    ?>
    <section class="add-container" style="width:80%;">
        <form method="POST" enctype="multipart/form-data" action="">
            <div class="input-field">
                <label>Product name</label>
                <input type="text" name="name" placeholder="Enter Name Here" required>
            </div>
            <div class="input-field">
                <label>Product price</label>
                <input type="text" name="price" placeholder="Enter Price Here" required>
            </div>
            <div class="input-field">
                <label>Product detail</label>
                <textarea name="detail" placeholder="Enter Details Here" required></textarea>
            </div>
            <div class="input-field">
                <label>Product image</label>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            </div>
            <input type="submit" name="add_product" value="Upload" class="btn">
        </form>
    </section>
    <section class="show-products">
        <div class="box-container">
            <?php
                $select_products=mysqli_query($conn,"SELECT * FROM `products`")or die('query failed');
                if(mysqli_num_rows($select_products)>0){
                    while($fetch_products=mysqli_fetch_assoc($select_products)){
            ?>
            <div class="box">
                <img src="image/<?php echo $fetch_products['image'];?>" alt="<?php echo $fetch_products['image']?>">
                <p>price : ₹<?php echo $fetch_products['price'];?></p>
                <h4><?php echo $fetch_products['name']; ?></h4>
                <details style="cursor:pointer;"><?php echo $fetch_products['product_detail'];?></details>
                <a href="admin_product.php?edit=<?php echo $fetch_products['id']; ?>" class="edit"">edit</a>
                <a href="admin_product.php?delete=<?php echo $fetch_products['id']; ?>" class="delete" onclick="return confirm('want to delete this product');">delete</a>

            </div>
            <?php
                    }
                }else{
                    echo'
                        <div class="empty">
                            <p>no products added yet!</p>
                        </div>
                    ';
                }
                
            ?>
    </section>

    <section class="update-container" style="height:130%;">
        <?php
            if(isset($_GET['edit'])){
                $edit_id=$_GET['edit'];
                $edit_query=mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$edit_id'") or die('query failed');
                if(mysqli_num_rows($edit_query)>0){
                    while ($fetch_edit = mysqli_fetch_assoc($edit_query)){
        ?>
                        <form method="POST" enctype="multipart/form-data" style="height:130%;">
                            <img src="image/<?php echo $fetch_edit['image']; ?>">
                            <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                            <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?>">
                            <input type="number" name="update_price" min="0" value="<?php echo $fetch_edit['price']; ?>">
                            <textarea name="update_detail"><?php echo $fetch_edit['product_detail'];?></textarea>
                            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                            <input type="submit" name="update_product" value="update" class="edit">
                            <a href="admin_product.php"><input type="reset" name="Cancel_btn" value="cancel" class="option-btn btn" id="close-form" onclick="closeform()"></a>
                            
                        </form>
        <?php
                    }
                }
                echo"<script>document.querySelector('.update-container').style.display='block'</script>";
                
            }

        ?>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>