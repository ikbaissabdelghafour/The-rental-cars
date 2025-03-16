<?php
include("../connexion.php");
session_start();
$user=$_SESSION['user'];
$req1="SELECT * FROM clients  where username='$user'";
$stet1=$con->prepare($req1);
$stet1->execute();
$table1=$stet1->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['signout'])){
  session_destroy();
  header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../styles/profile.css">
    <script src="../js/bootstrap.js"></script>
    <title>Document</title>
</head>
<body >
    <div class="container p-5">
        <div class="main-body">
        
              <!-- Breadcrumb -->
              <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../index.php ">Home</a></li>
                </ol>
              </nav>
              <!-- /Breadcrumb -->
        
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <img src="profile/<?=$table1['photo'] ?>" alt="Admin" class="rounded-circle p-1 bg-primary" width="150" height="150">
                        <div class="mt-3">
                          <h4><?=$table1['nom_complet']?> </h4>
                          <p class="text-secondary mb-1"></p>
                          <p class="text-muted font-size-sm"><?=$table1['adresse']?> </p>
                          <p class="text-muted font-size-sm"><a href="change_password.php" class="btn btn-primary col-12">Changer password</a> </p>
                          <p class="text-muted font-size-sm"><a href="carrentl.php" class="btn btn-success col-10">Cars rental</a> </p>
                       
                        </div>
                        <form  orm action="" method="post">
                          <button type="submit" name="signout" class="btn btn-danger" > sign out</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                           
                <div class="col-md-8">
                  <div class="card mb-3">
                    <div class="card-body">
                      <h2 class="text-center mb-2">Votre informations personnel</h2>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Username</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?=$table1['username']?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?=$table1['nom_complet']?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?=$table1['mail']?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?=$table1['adresse']?>                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Tele</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?=$table1['tele']?>                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-12">
                          <a class="btn btn-info " target="__blank" href="edite_profile.php">Edit</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  
    
               
                  
    
                </div>
              </div>
    
            </div>
        </div>
</body>
</html>