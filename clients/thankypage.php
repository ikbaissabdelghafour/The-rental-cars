<?php

function homepage($url,$delay=5){
    header("refresh:$delay;url=$url");
}
homepage("../index.php");

include('../connexion.php');
include('../header.php');
session_start();
if(isset($_GET['matricule'])){
    $matricle=$_GET['matricule'];
    $option=$con->prepare("select * from voitures where matricule='$matricle' ");
    $option->execute();
    $car=$option->fetch(PDO::FETCH_ASSOC);
}
    ?>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../styles/css/Bootstrap.css">
    <link rel="stylesheet" href="../styles/home_client.css">
    <link rel="stylesheet" href="../styles/nav_progress.css">
    <script src='../styles/js/Bootstrap.js'></script>
	<style>
		@import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
		@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
	</style>
	<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
</head>
<body>
    
<div class="head">
        <nav style="border-bottom:green solid 5px;">
            <div class="a">
                <p><img src="../icon/check.png" alt=""><span><b>Reservation date</b></span> </p>
            </div>
            <div class="b">
                <div><img src="../icon/next.png" alt=""><b> Rental date:</b>    <span class="span"><?= $_SESSION['date_de_location']?></span></div>
                <div><img src="../icon/back.png" alt=""><b> Return date : </b>  <span class="span"><?= $_SESSION['date_de_retour']?></span></div>
                <div><img src="../icon/day.png" alt=""><b> Number of days: </b> <span class="span"><?= $_SESSION['nbr_jours']?></span> Days</div>
            </div>
        </nav>
        <nav style="border-bottom:green solid 5px;">
            <div class="a">
                <p><img src="../icon/check.png" alt=""><span><b>Vehicule</b></span> </p>
            </div>
            <br>
            <div class="b">
                <div><img src="../icon/car.png" alt=""> <b>Marque</b><span class="span"> <?=$car['marque'] ?></span></div>
                <div><img src="../icon/gasoline.png" alt=""> <span><?=$car['type_de_carburant'] ?></span><b>/</b><img src="../icon/vitesse.png" alt=""><span class="span">  <?=$car['vitesse'] ?> <span></div>
                <?php    
                    $_SESSION['prix_des_jours']=intval($car['prix_par_jour'])*intval($_SESSION['days']);
                    ?>
                <div><img src="../icon/dollar.png" alt=""> <b>Days price. &nbsp; </b> <span><?=$_SESSION['prix_des_jours'] ?>  </span> DH</div>
            </div>
            
        </nav>
        <nav style="border-bottom:green solid 5px;">
            <div class="a">
              
                <p><img src="../icon/check.png" alt=""><span><b>Options</b></span>  </p>
            </div>
            <div class="b"> 
              <!-- //^ ------------- option 1 ---------------- -->
              <?php if($_SESSION['option1']==true){
                ?>
                <div><b>A baby seat</b>  <span class="span">  79,9 DH</span></div>
                <?php }
              ?>
              <?php if($_SESSION['option2']==true){
                ?>
                <!-- //^ ------------- option 2 ---------------- -->
                <div><b>Wifi</b>  <span class="span">  99,9 DH</span></div>
                <?php }
              ?>
              <?php if($_SESSION['option3']==true){
                ?>
                <!-- //^ ------------- option 3 ---------------- -->
                <div><b>GPS</b>  <span class="span">  119,9 DH</span></div>
             <?php }
              ?>
              <?php if(isset($_SESSION['total_option']) ){
             ?>
                <div><b>total price of options</b>  <span  style="color:green;"> &nbsp; <?= $_SESSION['total_option']?> DH</span></div>
             <?php }
              ?>
              
            </div>
        </nav>
        <nav style="border-bottom:green solid 5px;">
            <div class="a">
                <p><img src="../icon/check.png" alt=""><span><b>Payment</b></span> </p>
            </div>
            <div class="b">
              <?php
              $pttc=$_SESSION['total_option']+$_SESSION['prix_des_jours'];
              $_SESSION['total']=$pttc;
              ?>
              <div> <img src="../icon/dollar.png" alt=""><b>PTTC</b><span  style="color:green;"> &nbsp; <?= $pttc?> DH</span></div>
              <div class="text-center  justify-content-center"><p><i>payment online</i></p></div>

            </div>
            
        </nav>
    </div>
	<header class="site-header" id="header">
		<h1 class="site-header__title" data-lead-id="site-header-title">THANK YOU!</h1>
	</header>

	<div class="main-content">
		<i class="fa fa-check main-content__checkmark" id="checkmark"></i>
		<p class="main-content__body" data-lead-id="main-content-body">Thanks a bunch for filling that out. It means a lot to us, just like you do! We really appreciate you giving us a moment of your time today. Thanks for being you.</p>
	</div>

	<footer class="site-footer" id="footer">
		<p class="site-footer__fineprint" id="fineprint">Copyright ©2014 | All Rights Reserved</p>
	</footer>
</body>
</html>
<script>
    // Function to perform smooth scroll
    function smoothScroll(targetPosition, duration) {
        const startPosition = window.pageYOffset;
        const distance = targetPosition - startPosition;
        const startTime = performance.now();

        function scrollAnimation(currentTime) {
            const elapsedTime = currentTime - startTime;
            const progress = Math.min(elapsedTime / duration, 1);
            const ease = progress; // Linear easing

            window.scrollTo(0, startPosition + distance * ease);

            if (progress < 1) {
                window.requestAnimationFrame(scrollAnimation);
            }
        }

        window.requestAnimationFrame(scrollAnimation);
    }

    // Wait for 3 seconds then initiate smooth scroll
    setTimeout(function() {
        smoothScroll(document.body.scrollHeight, 1000); // 1000ms = 1 second for smooth scrolling
    }, 2000); // 3000 milliseconds = 3 seconds
</script>
