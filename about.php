<?php 
    include 'connection.php';
    session_start();
    $user_id=$_SESSION['user_id'];

    if(!isset($user_id)){
        header('location: login.php');
    }
    if(isset($_POST['logout-btn'])){
        session_destroy();
        header('location: login.php');
    }
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
    <title>User-Dashboard</title>
</head>
<body>
    <?php include 'header.php';?>
    <div class="banner" style="background-image:radial-gradient(blue,black);">
        <div class="detail" style="text-align:center;">
            <h1>About Us</h1>
            <p>Signature Perfumes - Fragrance of Royalty</p>
            </div>
    </div>
    <!-- ---------About Us----------- -->
    <div class="about-us">
        <div class="row">
            <div class="box" style="width:50%;">
                <div class="title">
                    <span>ABOUT </span>
                    <h1>Signature Perfumes</h1>
                </div>
                <p style="line-height:1.5;color:#00e5ff;font-size:16px;">At Signature Perfumes, the art of perfumery is crafted into a science of everlasting memories through their fragrances. Signature Perfumes stands strong as a corporate entity with a vast portfolio of over 300 of the finest and most captivating fragrances. The brand has a strong retail presence with over 240+ exclusive retail outlets across the GCC and the world. Signature Perfumes also has a presence on the international front; currently exporting to 45+ countries across the globe and with an exclusive presence through select 30 global Duty-Free locations and International Airlines.</p>
                <br>
                <p style="line-height:1.5;color:#00e5ff;font-size:16px;">In India, Signature Perfumes is available at 3000 Points Of Sale across a mix of channels which comprises of Modern Trade, E-commerce, General Trade, Multi Brand Outlets, and Owned Retail. Signature Perfumes are now available at select stores in Shoppers Stop, DaburNewU, Parcos, Olfactive, Jade Blue, Wellness Forever amongst others. In e-commerce, Signature Perfumes is present across approximately 40 sites where Signature Perfumes is one of the biggest single-brand perfumery house</p>
            </div>
            <div class="img-box" style="width:50%;">
                <img src="img/about.webp" style="width:100%;border-radius:10px;">
            </div>
        </div>
    </div>
    <div class="about-us">
        <div class="row">
        <div class="img-box" style="width:50%;">
                <img src="img/abput2.webp" style="width:100%;border-radius:10px;">
            </div>
            <div class="box" style="width:50%;">
                <div class="title">
                    <span>HISTORY </span>
                    <h1>Signature Perfumes</h1>
                </div>
                <p style="line-height:1.5;color:#00e5ff;font-size:16px;">Signature Perfumes, a name that tells a story of heritage, enterprise and passion. The story of a man, Haji Ajmal Ali, who founded a perfume empire that’s one of the most respected names today.</p>
                <br>
                <p style="line-height:1.5;color:#00e5ff;font-size:16px;">Our origins can be traced back to a little village Hojai in Assam, India, when he ventured into the jungles with nothing more than a dream. A rice farmer by trade, Haji Ajmal Ali was searching for precious Oudh from the Agarwood tree to change his family’s fortunes and the face of perfumery. With Oudh procured by his effort his meagre savings, he made the momentous move to Mumbai, the city of dreams, in the 50’s.</p>
                <br>
                <p>The illustrious legacy of Haji Ajmal Ali is now carried forward by his second and third generation with the same passion and precision. The secret to Signature Perfume’s expansion is quite simple. It believes in enthralling its customers by catering to their aspirations in the most sought-after manner.</p>
            </div>
            
        </div>
    </div>
   
    <div class="mission">
        <h2>Mission Of Signature Perfumes</h2>
        <p>We exist to enrich our customer's lifestyle through</p>
        <div><ul class="points">
            <li>-><span></span> Encouraging creativity, innovation & continual improvement.</li>
            <li>-><span></span>Adopting practices that are ethical and socially as well as environmentally responsible.</li>
            <li>-><span></span>Attracting and retaining the best talent.</li>
            <li>-><span></span>Meaningful relationships with employees & associates, built on trust & respect.</li>
            <li>-><span></span>Maximizing stakeholders interest.</li>
        </ul></div>
    </div>
    <div class="mission">
        <h2>Brand Essence/Values Of Ajmal</h2>
        <div><ul class="points">
            <li>-><span></span>Excellence.</li>
            <li>-><span></span>Innovation.</li>
            <li>-><span></span>Partnership.</li>
            <li>-><span></span>Integrity.</li>
            <li>-><span></span>Open Communication.</li>
        </ul></div>
    </div>
    <!-- ----------About Us End -------------- -->
    <?php include 'footer.php';?>
<script src="script.js" type="text/javascript"></script>
</body>
</html>