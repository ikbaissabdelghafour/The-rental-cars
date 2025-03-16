
<?php 
include("connexion.php");
ini_set('session.gc_maxlifetime', 86400);  // 24 hours
ini_set('session.cookie_lifetime', 86400);  // 24 hours
session_start();
if(isset( $_POST['date_de_location']) && isset($_POST['date_de_retour']) ){
    if( $_POST['date_de_location'] < $_POST['date_de_retour']){
        $_SESSION['date_de_location']=$_POST['date_de_location'];
        $_SESSION['date_de_retour']=$_POST['date_de_retour'];
        if(isset($_POST['rechercher'])){
            header("location:clients/filter.php");
        }
    }
    else{
        echo"err";
    }
    }
if(isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['email']) && isset($_POST['message']) ){
$req2="insert into reviews(first_name,last_name,email,message) values (?,?,?,?)";
$ste=$con->prepare($req2);
$ste->execute([$_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['message']]);
header("location:index.php?me=abdo&message=sub");
}
$reviews="SELECT * FROM reviews ORDER BY date_coment desc limit 5";
$mess=$con->prepare($reviews);
$mess->execute();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="Tooplate">

        <title>Home page</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

        <link href="clients/css/bootstrap.min.css" rel="stylesheet">

        <link href="clients/css/bootstrap-icons.css" rel="stylesheet">
        <link rel="shortcut icon" type="x-icon" href="icon/car-rental.png">

        <link href="clients/css/owl.carousel.min.css" rel="stylesheet">

        <link href="clients/css/tooplate-moso-interior.css" rel="stylesheet">
    </head>
    
    <body>
                <?php include('header.php')?>

        <nav class="navbar navbar-expand-lg bg-light p-0 shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <?php include("logosvg.php") ?>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">Home</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_2">About</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link  " href="#section_3" id="navbarLightDropdownMenuLink" role="button"  aria-expanded="false">Cars</a>

                            
                        </li>
<?php  if(empty($_SESSION['user'])){
    ?>
                        <li class="nav-item">
                            <a class="nav-link " href="clients/signup.php">Sign up</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="login.php">Login</a>
                        </li>
    <?php
}

else{
    ?>
    <li class="nav-item">
    <a onclick="return confirm('Are you sure ?')"class="nav-link " href="clients/log out.php">log out</a>
    </li>
    <li class="d-flex align-items-center">
    <a href="clients/profile.php">    <img width="125px" height="50" style="border-radius:50%; width:50px; position:relative; left:50px; " src="clients/profile/<?=$_SESSION['photo'] ?>" alt=""></a>
    </li>
    
    <?php
}
?>
               </ul>
        </div>
            </div>
        </nav>

        <main>

            <section class="hero-section hero-slide d-flex justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 text-center mx-auto">
                            <div class="hero-section-text">
<div class="container mt-5" style="   
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(3px);
            border-radius: 10px;
            padding: 20px;
            box-shadow:0,0,8,black;">

                                <h1 class="hero-title text-white mt-2 mb-4">Choose the right time to rent a car</h1>

        <form method="post" class="bg-blur">
            <div class="row">
                <div class="form-group col-md-6 text-white">
                    <label for="departureDate " class="text-white"><b>Date de départ</b></label>
                    <input required name="date_de_location" min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>" type="date" class="form-control" id="departureDate">
                </div>

                <div class="form-group col-md-6 text-white">
                    <label for="returnDate"><b>Date de retour</b></label>
                    <input required name="date_de_retour" min="<?= date('Y-m-d'); ?>" type="date" class="form-control" id="returnDate">
                </div>
            </div>

            <button name="rechercher" type="submit" class="mt-3 btn btn-primary btn-block">RECHERCHER</button>
        </form>
    </div>

                                <!-- <div class="hero-btn d-flex justify-content-center align-items-center">
                                    <a class="bi-arrow-down hero-btn-link smoothscroll" href="#section_2"></a>
                                </div>  -->
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="about-section section-padding" id="section_2">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-5 col-12">
                            <small class="section-small-title">Our Story</small>

                            <h2 class="mt-2 mb-4"><span class="text-muted">Introducing</span> Car Abdo</h2>

                            <h4 class="text-muted mb-3">Discover top-notch vehicle rentals with Car Abdo</h4>

                        <p> offering a wide selection of luxury and economy models to suit any travel need. Enjoy competitive rates, flexible rental terms, and exceptional customer service for a seamless car rental experience. Drive in style and comfort with Car Abdo.</p>
                        </div>

                        <div class="col-lg-3 col-md-5 col-5 mx-lg-auto">
                            <img src="clients/images/sharing-design-ideas-with-family.jpg" class="about-image about-image-small img-fluid" alt="">
                        </div>

                        <div class="col-lg-4 col-md-7 col-7">
                            <img src="clients/images/living-room-interior-wall-mockup-warm-tones-with-leather-sofa-which-is-kitchen-3d-rendering.jpg" class="about-image img-fluid" alt="">
                        </div>

                    </div>
                </div>
            </section>


            <section id="section_3" class="featured-section section-padding" >
                <div class="container">
                    <div class="row">

                        <div class="col-lg-5 col-12">
                            <div class="custom-block featured-custom-block">
                                <h2 class="mt-2 mb-4">Opening Hours</h2>
                                <h4 class="mt-2 mb-4">All days</h4>
                                <div class="d-flex">
                                    <i class="featured-icon bi-clock me-3"></i>
                                    
                                    <div>
                                        <p class="mb-2">
                                        in the morning.
                                            <strong class="d-inline">
                                            <?= $agence['temp_debut']  ?>
                                            </strong>
                                        </p>
                                        <p class="mb-2">
                                        In the evening.
                                        <strong class="d-inline">
                                            <?= $agence['temp_fin']  ?>
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <section class="shop-section section-padding" id="section_3">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <small class="section-small-title">Car Abdo Cars</small>

                            <h2 class="mt-2 mb-4"><span class="tooplate-red">The best</span> Cars</h2>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="shop-thumb">
                                <div class="shop-image-wrap">
                                        <img src="clients/images/shop/minimal-bathroom-interior-design-with-wooden-furniture.jpg" class="shop-image img-fluid" alt="">

                                    <div class="shop-icons-wrap">
                                   

                                  
                                    </div>

                                </div>

                                <div class="shop-body">
                                    <h4> AMG</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="shop-thumb">
                                <div class="shop-image-wrap">
                                        <img src="clients/images/shop/mock-up-poster-modern-dining-room-interior-design-with-white-empty-wall.jpg" class="shop-image img-fluid" alt="">

                                    <div class="shop-icons-wrap">
                                

                                    </div>

                                </div>

                                <div class="shop-body">
                                    <h4>MERCEDES G63 AMG</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="shop-thumb">
                                <div class="shop-image-wrap">
                                        <img src="clients/images/shop/green-sofa-white-living-room-with-blank-table-mockup.jpg" class="shop-image img-fluid" alt="">

                                    <div class="shop-icons-wrap">
                                

                                    </div>

                                </div>

                                <div class="shop-body">
                                    <h4>Dacia</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="shop-thumb">
                                <div class="shop-image-wrap">
                                        <img src="clients/images/shop/concept-home-cooking-with-female-chef.jpg" class="shop-image img-fluid" alt="">

                                    <div class="shop-icons-wrap">
                                

                                    </div>

                                </div>

                                <div class="shop-body">
                                    <h4>Chef Kitchen</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="shop-thumb">
                                <div class="shop-image-wrap">
                                        <img src="clients/images/shop/childrens-bed-nursery-cot-velvet-childrens-room.jpg" class="shop-image img-fluid" alt="">

                                    <div class="shop-icons-wrap">
                                

                                    </div>

                                </div>

                                <div class="shop-body">
                                    <h4>MERCEDES</h4>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </section>


            <section class="reviews-section section-padding pb-0" id="section_4">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <small class="section-small-title">Happy customers.</small>

                            <h2 class="mt-2 mb-4">Reviews</h2>

                            <div class="owl-carousel reviews-carousel">
                                <?php
                                while($row=$mess->fetch(PDO::FETCH_ASSOC)){
                                    ?>

                                <div class="reviews-thumb">
                                    <div class="reviews-body">
                                        <h4><?=$row['message']?></h4>
                                    </div>

                                    <div class="reviews-bottom reviews-bottom-up d-flex align-items-center">

                                        <div class="d-flex align-items-center justify-content-between flex-wrap w-100 ms-3">
                                            <p class="text-white mb-0">
                                                <strong><?=$row['first_name']?></strong>, <small><?=$row['last_name']?></small>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                    <?PHP
                                }
                                ?>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <p class="d-flex justify-content-center align-items-center mt-lg-5">Write some reviews on <a href="#" class="custom-btn btn ms-3"><i class="bi-facebook me-2"></i>facebook</a></p>
                                </div>

                    </div>
                </div>
            </section>


            <section class="contact-section" id="section_5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f9f9" fill-opacity="1" d="M0,96L40,117.3C80,139,160,181,240,186.7C320,192,400,160,480,149.3C560,139,640,149,720,176C800,203,880,245,960,250.7C1040,256,1120,224,1200,229.3C1280,235,1360,277,1400,298.7L1440,320L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path></svg>
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <small class="section-small-title">Ask anything.</small>

                            <h2 class="mb-4">Say Hello</h2>
                        </div>

                        <div class="col-lg-6 col-12">
                            <form class="custom-form contact-form" action="#" method="post" role="form">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="input-group align-items-center">
                                            <label for="first-name">First Name</label>

                                            <input required type="text" name="first_name" id="first-name" class="form-control" placeholder="Jack" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="input-group align-items-center">
                                            <label for="last-name">Last Name</label>

                                            <input required type="text" name="last_name" id="last-name" class="form-control" placeholder="Doe" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group align-items-center">
                                    <label for="email">Email Address</label>

                                     <input required type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Jackdoe@gmail.com" required>
                                </div>

                                <div class="input-group textarea-group">
                                    <label for="message">Message</label>

                                    <textarea required name="message" rows="6" class="form-control" id="message" placeholder="What can we help you?"></textarea>
                                </div>

                                <div class="col-lg-3 col-md-4 col-6">
                                    <button name='sub' type="submit" class="form-control">Send</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                            <div class="custom-block">

                                <h3 class="text-white mb-2">Store</h3>

                                <p class="text-white mb-2">
                                    <i class="contact-icon bi-geo-alt me-1"></i>
                                    
                                   <a href=":<?=$agence['adresse'] ?>"><?=$agence['adresse'] ?></a> 
                                </p>

                                <h3 class="text-white mt-3 mb-2">Contact Info</h3>

                                <div class="d-flex flex-wrap">
                                    <p class="text-white mb-2 me-4">
                                        <i class="contact-icon bi-telephone me-1"></i>

                                        <a href="tel: 090-080-0760" class="text-white">
                                            <?=$agence['tele'] ?>
                                        </a>
                                    </p>
                                    
                                    <p class="text-white">
                                        <i class="contact-icon bi-envelope me-1"></i>
                                        
                                        <a href="mailto:info@company.com" class="text-white">
                                            <?=$agence['email'] ?>
                                        </a>
                                    </p>
                                </div>

                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.424625047106!2d-7.601319799999999!3d33.5942854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7cd65706e85d7%3A0x327a13462f2a3fc9!2sCentre%20Philips!5e0!3m2!1sen!2sma!4v1717527498519!5m2!1sen!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
            
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#36363e" fill-opacity="1" d="M0,96L40,117.3C80,139,160,181,240,186.7C320,192,400,160,480,149.3C560,139,640,149,720,176C800,203,880,245,960,250.7C1040,256,1120,224,1200,229.3C1280,235,1360,277,1400,298.7L1440,320L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>            
        </main>
        
        <footer class="site-footer section-padding">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-3 col-md-5 col-12 mb-3">
                        <h3><a href="index.html" class="custom-link mb-1"></a></h3>
                        
                        <p class="text-white">Since 1986, Car Abdo has been crafting premium rental car experiences for seamless travels.</p>
                        
                        <p class="text-white"><a  target="_parent">Web Design: Soufian Moukrim</a></p>
                    </div>

                    <div class="col-lg-3 col-md-3 col-12 ms-lg-auto mb-3">
                        <h3 class="text-white mb-3">Store</h3>

                        <p class="text-white mt-2">
                            <i class="bi-geo-alt"></i>
                            Berlin, Germany
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-4 col-12 mb-3">
                        <h3 class="text-white mb-3">Contact Info</h3>

                            <p class="text-white mb-1">
                                <i class="bi-telephone me-1"></i>

                                <a href="tel:" class="text-white">
                                    <?=$agence['tele'] ?>
                                </a>
                            </p>

                            <p class="text-white mb-0">
                                <i class="bi-envelope me-1"></i>

                                <a href="mailto:<?=$agence['email']?>" class="text-white">
                                <?=$agence['email'] ?>
                            </a>
                            </p>
                    </div>

                    <div class="col-lg-6 col-md-7 copyright-text-wrap col-12 d-flex flex-wrap align-items-center mt-4 ms-auto">
                        <p class="copyright-text mb-0 me-4">Copyright © Ikbaissabdo 2024</p>

                        <ul class="social-icon">
                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link social-icon-twitter bi-twitter"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="" class="social-icon-link social-icon-facebook bi-facebook"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link social-icon-instagram bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link social-icon-pinterest bi-pinterest"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="https://wa.me/<?=$agence['tele']?>" class="social-icon-link social-icon-whatsapp bi-whatsapp"></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.backstretch.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
