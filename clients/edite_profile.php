<?php
include("../connexion.php");
session_start();
$id=$_SESSION['user'];
$req1="SELECT * FROM clients where username='$id' ";
$stet1=$con->prepare($req1);
$stet1->execute();
$table1=$stet1->fetch(PDO::FETCH_ASSOC);
if($_SERVER['REQUEST_METHOD']=="POST"){
	$req2="UPDATE  clients set username=?,adresse=?,mail=?,nom_complet=?,photo=?,tele=? where username='$id'";
	$user=trim($_POST['username']);
	$adresse=trim($_POST['adresse']);
	$email=trim($_POST['email']);
	$name=trim($_POST['nom_complet']);
	$tele=trim($_POST['tele']);
	if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ""){
		$photo_name=$_FILES['photo']['name'];
		$photo_tmp=$_FILES['photo']['tmp_name'];
		if(!move_uploaded_file($photo_tmp,"profile/$photo_name")){
			$photo_name=$table1['photo'];
		}
	}
	else{
		$photo_name=$table1['photo'];
	}
	$stet=$con->prepare($req2);
	$stet->execute([$user,$adresse,$email,$name,$photo_name,$tele]);
	header("location:profile.php");

}
$_SESSION['mail']=$table1['mail'];
$_SESSION['photo']=$table1['photo'];
$_SESSION['nom_complet']=$table1['nom_complet'];
$_SESSION['adresse']=$table1['adresse'];
$_SESSION['tele']=$table1['tele'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<script src="../js/bootstrap.js"></script>
	<link rel="stylesheet" href="../styles/edite_profile.css">
</head>
<body>
	
    
<div class="container">
<a  href="profile.php" class=" col-12 mb-5 btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="profile/<?=$table1['photo']?>" alt="Admin" class="rounded-circle p-1 bg-primary" width="150" height="150">
								<!-- <img src="../icon/image/<?=$table1['photo']?>" alt="Admin" class="rounded-circle" width="150"> -->
								
								<div class="mt-3">
									<h4><?=$table1['nom_complet']?> </h4>
									<p class="text-muted font-size-sm"><?=$table1['adresse']?> </p>
								</div>
								<a class=" col-9 btn btn-danger" href="remove_profile.php?id=<?=$id?>">  Remove Profile picture </a>
								<a class=" mt-2 col-9 btn btn-success" href="change_password.php?id=<?=$id?>"> Change Password</a>
								
									<br>
									<br>
								</div>
								
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
						<form class="" action="" method="post" enctype="multipart/form-data">
								
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Username</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input name="username" type="text" class="form-control" value="<?=$table1['username']?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input name="nom_complet" type="text" class="form-control" value="<?=$table1['nom_complet']?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input  name="email"type="text" class="form-control" value="<?=$table1['mail']?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Tele</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input  name="tele"type="text" class="form-control" value="<?=$table1['tele']?>">
								</div>
							</div>
				
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input name="adresse" type="text" class="form-control" value="<?=$table1['adresse']?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Profile picture</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input name="photo" type="file" class="form-control" >
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="Save Changes">
								</div>
							</div>
							<br>
						</div>
						</form>

					</div>
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>



