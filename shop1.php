<?php 
    include 'connection.php';
?>
<style type="text/css">
    <?php include 'main.css'; ?>
</style>
<style>
    <?php include 'script2.js';?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
</head>
<body>
    <?php include 'header1.php';?>
    <div class="banner" style="background-image:radial-gradient(blue,black);">
        <div class="detail" style="text-align:center;">
            <h1>Our Products</h1>
            <p>Signature Perfumes - Fragrance of Royalty</p>
            </div>
    </div>
    <!-- ---------products----------- -->
    <section class="shop" style="background-image:radial-gradient(blue,black);">
        <!-- <h1 class="title" style="color:white;font-size:50px;">shop best sellers</h1> -->
    
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
        <div class="box-container">
            <?php
                $select_products = mysqli_query($conn,"SELECT * FROM `products`") or die('query failed');
                if(mysqli_num_rows($select_products)>0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form method="post" class="box" style="background:#fff;
     box-shadow:var(--box-shadow);
     padding:2rem;
     margin:1rem;
     text-align:center;
     text-align:center;
     border-radius:10px;
     line-height:2;
     text-transform:uppercase;
     position:relative;">
                <a href="view_page1.php?pid=<?php echo $fetch_products['id']; ?>"><img style=" width:100%;
    height:250px;"src="image/<?php echo $fetch_products['image']; ?>"></a>
                <div class="price" style="position:relative; margin-left:-30px;">₹<?php echo $fetch_products['price']; ?></div>
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_quantity" value="1" min="0">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                <div class="icon" style=" display:flex;
    padding:0;
    justify-content:center;
    align-items: center;
    background:var(--blue);
    margin:1rem;">
                    <a style=" width:40px;
     height:40px;
     border-radius:50%;
     padding:0;
     display:flex;
     justify-content:center;
     align-items:center;
     color:#000;
     background:#fff;
     margin: .5rem;
     box-shadow: var(--box-shadow);" href="view_page1.php?pid=<?php echo $fetch_products['id']; ?>" class="bi bi-eye-fill"></a>
                   
                </div>
            </form>
            <?php
                    }
                }else{
                    echo '<p class="empty">no products added yet!</p>';
                }
            ?>
        </div>
    </section>
    
    <!-- ----------About Us End -------------- -->
    <?php //include 'footer1.php';?>
<script src="script.js" type="text/javascript"></script>
</body>
</html>