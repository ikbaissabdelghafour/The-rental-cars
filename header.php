<?php 
// include("../connexion.php");
include("connexion.php");
$req ="select * from agence";
$stet=$con->prepare($req);
$stet->execute();
$agence=$stet->fetch(PDO::FETCH_ASSOC);

?>
<style>

</style>
    <link rel="stylesheet" href="styles/css/Bootstrap.css">
    <link rel="stylesheet" href="styles/home_client.css">
    <script src='styles/js/Bootstrap.js'></script>
	<link rel="shortcut icon" type="x-icon" href="icon/car-rental.png">


<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
<div class="super_container">
	
	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->
		<div class="top_bar pt-3 mb-0 navbar navbar-expand-lg fixed-top">
			<div class="mx-auto">
				<div class="mx-auto row">
					<div class="col-12 d-flex ">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918577/phone.png" alt=""></div><a target="_blank" href="tel:<?= htmlspecialchars($agence['tele'])?>"><?= htmlspecialchars($agence['tele'])?></a></div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918597/mail.png" alt=""></div><a  target="_blank" href="mailto:<?=  htmlspecialchars($agence['email']) ?>"><?=  htmlspecialchars($agence['email']) ?></a></div>
						<div class="top_bar_content m-a uto">
							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
								    <li>
										<a target="_blank" href="https://shorturl.at/RCYk6"><?= htmlspecialchars($agence['adresse'])?><i class="fas fa-chevron-down"></i></a>
									</li>
								</ul>
								   
				</div>
			</div>		
		</div>

		<!-- Header Main -->

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</header>


        


