<!DOCTYPE php>
<?php
session_start();
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.php -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <a class="navbar-brand brand-logo me-5" href="dashbord.php"><?php include('../logosvg.php') ?></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>

    <ul class="navbar-nav navbar-nav-right">
      
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
          <img src="../icon/image/<?= $_SESSION['photo']?>" alt="profile" />
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="profile.php">
            <i class="ti-settings text-primary"></i> Settings </a>
          <a class="dropdown-item" href="log_out.php">
            <i class="ti-power-off text-primary"></i> Logout </a>
        </div>
      </li>
      <li class="nav-item nav-settings d-none d-lg-flex">
        <a class="nav-link" href="#">
          <i class="icon-ellipsis"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.php -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="dashbord.php">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
        <i class="icon-grid-2 menu-icon"></i>
        <span class="menu-title">Tables</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tables">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="basic-table.php">Basic table</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">Cars</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="page.php">See The Cars</a></li>
          <li class="nav-item"><a class="nav-link" href="ajouter_vehcule.php">Add Car</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>
<?php

    

    include("../connexion.php");
    $req = "select * from voitures";
    $statement = $con->prepare($req);
    $statement->execute();
    $req1 = "select photo from admin";
    $statement1 = $con->prepare($req1);
    $statement1->execute();
    $table1 = $statement1->fetch(PDO::FETCH_ASSOC)
    ?>


    <div class="container my-4 col-12">

        <div class="row">
            <?php
            while ($table = $statement->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <img src="images/<?=$table['photo']?>" class="card-img-top" alt="<?=$table['marque']?> <?=$table['modele']?>">
                    <div class="card-header text-center">
                        <h2 class="h5"><?=$table['marque']?></h2>
                        <h6 class="text-muted"><?=$table['modele']?></h6>
                    </div>
                    <div class="card-body">
                        <p> <b class=""> Type de carrosserie  : </b> <span><?=$table['carossseri_type']?></span></p>
                        <p> <b class=""> Type de carburant  : </b> <span><?=$table['type_de_carburant']?></span></p>
                        <p> <b class=""> Couleur  : </b> <span><?=$table['color']?></span></p>
                        <p> <b class=""> Nombre de portes  : </b> <span><?=$table['porte']?></span></p>
                        <p> <b class=""> Vitesse  : </b> <span><?=$table['vitesse']?></span></p>
                        <p> <b class=""> Quantité  : </b> <span><?=$table['quantite']?></span></p>
                    </div>
                    <div class="card-footer">
                        <h5>Prix par jour  : <strong><?=$table['prix_par_jour']?></strong> MAD</h5>
                        <div>
                            <a onclick="return confirm('Vous voulez supprimer cette voiture ?')" href="supprimer_voiture.php?matricule=<?=$table['matricule']?>"><img src="../icon/delete.png" alt="Supprimer"></a>
                            <a href="Modifer_voiture.php?matricule=<?=$table['matricule']?>"><img src="../icon/pen.png" alt="Modifier"></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php    
            }
            ?>
        </div>
    </div>  <!-- partial:../../partials/_footer.php -->
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
<footer class="footer col-12">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i></span>
  </div>
</footer>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="assets/vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- End custom js for this page-->
  </body>
</php>