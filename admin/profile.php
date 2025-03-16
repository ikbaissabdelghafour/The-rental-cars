<?php
include("../connexion.php");
ini_set('session.gc_maxlifetime', 86400);  // 24 hours
ini_set('session.cookie_lifetime', 86400);  // 24 hours
session_start();

$req1="SELECT * FROM admin ";
$req2="SELECT * FROM agence ";
$stet1=$con->prepare($req1);
$stet2=$con->prepare($req2);
$stet1->execute();
$stet2->execute();
$table1=$stet1->fetch(PDO::FETCH_ASSOC);
$table2=$stet2->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['signout'])){
  session_destroy();
  header("location:../index.php");
}
$_SESSION['username']=$table1['username'];
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
                  <li class="breadcrumb-item"><a href="dashbord.php ">Home</a></li>
                </ol>
              </nav>
              <!-- /Breadcrumb -->
        
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <img src="../icon/image/<?=$table1['photo']?>" alt="Admin" class="rounded-circle p-1 bg-primary" width="150">
                        <div class="mt-3">
                          <h4><?=$table1['nom_complet']?> </h4>
                          <p class="text-secondary mb-1"></p>
                          <p class="text-muted font-size-sm"><?=$table1['adresse']?> </p>
                       
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
                        <?=$table1['email']?>
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
                        <div class="col-sm-12">
                          <a class="btn btn-info " target="__blank" href="edite_profile.php">Edit</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  
    
                <div class="col-md-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <h2 class="text-center mb-2">informations sur l'agence</h2>
                      </div>
                      <hr >
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?=$table2['email']?>
                      </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?=$table2['tele']?>
                      </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?=$table2['adresse']?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">L'ouverture</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?=$table2['temp_debut']?>
                        </div>
                      </div>
                      
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Fermeture</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?=$table2['temp_fin']?>
                        </div>
                      </div>
                     
                      <hr>
                      <div class="row">
                        <div class="col-sm-12">
                          <a class="btn btn-info " target="__blank" href="Modifer_agence.php ">Edit</a>
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