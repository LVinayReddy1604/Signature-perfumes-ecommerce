<?php 
    include 'connection.php';
    session_start();
    $user_id=$_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:index1.php');
    }
    if(isset($_POST['logout-btn'])){
        session_destroy();
        header('location:login.php');
    }

    if(isset($_POST['newsletter'])){
        $email=$_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo'<script>alert("Invalid email format")</script>';
            // $message[] = "Invalid email format";
        }else{
        $existance=mysqli_query($conn,"SELECT * FROM `newsletter` WHERE email='$email'")or die('query failed');
        if(mysqli_num_rows($existance)>0){
            echo'<script>alert("Mail Already Subscribed")</script>';
            // $message[]='Mail Already exists';
        }else{
            mysqli_query($conn,"INSERT INTO `newsletter` (`user_id`,`email`) VALUES('$user_id','$email')")or die('query failed');
            echo'<script>alert("Successfully Subscribed to Newsletter")</script>';
            // $message[]='Successfully Subscribed to Newsletter';
        }}
    }

?>
<style type="text/css">
    <?php include 'main.css'; ?>
</style>
<script>
    <?php include 'script2.js';?>
    <?php include 'script.js';?>
</script>
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
    <!-- ----------------------------home slider------------------------ -->
    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
                <img src="img/hero.jpg">
                <div class="slider-caption">
                    <span>Test The Quality</span>
                    <h1>Premium France<br>Perfumes</h1>
                    <p>"Perfume is a story in odour, sometimes poetry in memory." </p>
                    <a href="shop.php" class="btn">shop</a>
                </div>
            </div>
        </div>
        <div class="controls">
            
        </div>
    </div>
   <!-- HOme image slider end -->
   <!-- features start -->
   <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/feature1.jpg" height="100" width="100" alt="Feature1 image">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="img/feature3.png" height="100" width="100" alt="Feature1 image">
            <h6>Happy Customer</h6>
        </div>
    
        <div class="fe-box">
            <img src="img/feature2.jpg" height="100" width="100" alt="Feature1 image">
            <h6>Premium Products</h6>
         </div>
        <div class="fe-box">
            <img src="img/feature4.jpg" height="100" width="100" alt="Feature1 image">
            <h6>24x7 Support</h6>
        </div>
       
        <div class="fe-box">
            <img src="img/feature5.jpg" height="100" width="100" alt="Feature1 image">
            <h6>Save Money</h6>
        </div>
    </section>
    <!-- ------------------------------------story ---------------------------------->
    <div class="story">
        <div class="row">
            <div class="box">
                <span>Our Story</span>
                <h1>Production of Natural Perfumes With Ultimate Fragrance since 1990</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore, fugiat voluptates voluptas facilis delectus, qui aperiam veritatis voluptatibus asperiores tempora est neque magnam adipisci vel officiis ducimus iusto nesciunt libero?</p>
                <a href="about.php" class="btn">About Us</a>
            </div>
            <div class="box">
                <img src="img/story.png">
            </div>
        </div>
    </div>
    
    <section id="testim" class="testim">
            <div class="wrap">

                <span id="right-arrow" class="arrow right fa fa-chevron-right"></span>
                <span id="left-arrow" class="arrow left fa fa-chevron-left "></span>
                <ul id="testim-dots" class="dots">
                    <li class="dot active"></li><!--
                    --><li class="dot"></li><!--
                    --><li class="dot"></li><!--
                    --><li class="dot"></li><!--
                    --><li class="dot"></li>
                </ul>
                <div id="testim-content" class="cont">
                    
                    <div class="active">
                        <div class="img"><img src="img/test1.jpg" alt=""></div>
                        <h2>Lorem P. Ipsum</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                    </div>

                    <div>
                        <div class="img"><img src="img/test2.jpg" alt=""></div>
                        <h2>Mr. Lorem Ipsum</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                    </div>

                    <div>
                        <div class="img"><img src="img/test3.jpg" alt=""></div>
                        <h2>Lorem Ipsum</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                    </div>

                    <div>
                        <div class="img"><img src="img/test4.jpg" alt=""></div>
                        <h2>Lorem De Ipsum</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                    </div>

                    <div>
                        <div class="img"><img src="img/test5.jpg" alt=""></div>
                        <h2>Ms. Lorem R. Ipsum</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                    </div>

                </div>

            </div>
    </section>
    <div class="newsletter">
        <h1 class="title">Join To Our Newsletter</h1>
        <p>Get 15% off your next order. Be the first to learn about promotions special events, new arrivals and more.</p>
        <form method="POST">
            <input type="email" name="email" required placeholder="Your Email Address.... ">
            <button name="newsletter">Subscribe Now</button>
        </form>
    </div>
    <div class="clients">
        <h3 class="title">Our Clients</h3>
    </div>
        <div class="client">
            <div class="box">
                <img src="img/client-1.webp" height="250px" width="250px">
            </div>
            <div class="box">
                <img src="img/client-2.jpg" height="250px" width="250px">
            </div>
            <div class="box">
                <img src="img/client-3.webp" height="250px" width="250px">
            </div>
            <div class="box">
                <img src="img/client-4.jpg" height="250px" width="250px">
            </div>
            
        </div>
    
<script src="https://use.fontawesome.com/1744f3f671.js"></script>

    
    <?php include 'footer.php';?>
    <!-- ----------------------------slick slider link ------------------------ -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="script2.js"></script>  
    <script>
        //for testimonials
        'use strict'
var	testim = document.getElementById("testim"),
		testimDots = Array.prototype.slice.call(document.getElementById("testim-dots").children),
    testimContent = Array.prototype.slice.call(document.getElementById("testim-content").children),
    testimLeftArrow = document.getElementById("left-arrow"),
    testimRightArrow = document.getElementById("right-arrow"),
    testimSpeed = 4500,
    currentSlide = 0,
    currentActive = 0,
    testimTimer,
		touchStartPos,
		touchEndPos,
		touchPosDiff,
		ignoreTouch = 30;
;

window.onload = function() {

    // Testim Script
    function playSlide(slide) {
        for (var k = 0; k < testimDots.length; k++) {
            testimContent[k].classList.remove("active");
            testimContent[k].classList.remove("inactive");
            testimDots[k].classList.remove("active");
        }

        if (slide < 0) {
            slide = currentSlide = testimContent.length-1;
        }

        if (slide > testimContent.length - 1) {
            slide = currentSlide = 0;
        }

        if (currentActive != currentSlide) {
            testimContent[currentActive].classList.add("inactive");            
        }
        testimContent[slide].classList.add("active");
        testimDots[slide].classList.add("active");

        currentActive = currentSlide;
    
        clearTimeout(testimTimer);
        testimTimer = setTimeout(function() {
            playSlide(currentSlide += 1);
        }, testimSpeed)
    }

    testimLeftArrow.addEventListener("click", function() {
        playSlide(currentSlide -= 1);
    })

    testimRightArrow.addEventListener("click", function() {
        playSlide(currentSlide += 1);
    })    

    for (var l = 0; l < testimDots.length; l++) {
        testimDots[l].addEventListener("click", function() {
            playSlide(currentSlide = testimDots.indexOf(this));
        })
    }

    playSlide(currentSlide);

    // keyboard shortcuts
    document.addEventListener("keyup", function(e) {
        switch (e.keyCode) {
            case 37:
                testimLeftArrow.click();
                break;
                
            case 39:
                testimRightArrow.click();
                break;

            case 39:
                testimRightArrow.click();
                break;

            default:
                break;
        }
    })
		
		testim.addEventListener("touchstart", function(e) {
				touchStartPos = e.changedTouches[0].clientX;
		})
	
		testim.addEventListener("touchend", function(e) {
				touchEndPos = e.changedTouches[0].clientX;
			
				touchPosDiff = touchStartPos - touchEndPos;
			
				console.log(touchPosDiff);
				console.log(touchStartPos);	
				console.log(touchEndPos);	

			
				if (touchPosDiff > 0 + ignoreTouch) {
						testimLeftArrow.click();
				} else if (touchPosDiff < 0 - ignoreTouch) {
						testimRightArrow.click();
				} else {
					return;
				}
			
		})
}
    </script>
</body>
</html>