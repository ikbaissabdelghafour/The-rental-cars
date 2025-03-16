<!DOCTYPE html>
<?php
include('../connexion.php') ;
session_start();
$req=$con->prepare('select * from clients');
$req->execute();
// ^--------------------------
$reserve=$con->prepare('select reservations.*,voitures.* from reservations join voitures on reservations.voiture_vin=voitures.matricule');
$reserve->execute();
// ^--------------------------

$car=$con->prepare('select * from voitures ');
$car->execute();
// ^--------------------------

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
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
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
        <a class="nav-link dropdown-toggle" href="profile.php" data-bs-toggle="dropdown" id="profileDropdown">
          <img src="../icon/image/<?= $_SESSION['photo']?>" alt="profile" />
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="profile.php">
            <i class="ti-settings text-primary"></i> Settings </a>
          <a class="dropdown-item" href="log_out.php">
            <i class="ti-power-off text-primary"></i> Logout </a>
        </div>
      </li>

    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="dashbord.php">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="Allcars.php">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">See All Cars</span>
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
          <li class="nav-item"> <a class="nav-link" href="basic-table.html">Basic table</a></li>
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
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title h1 text-center ">CLIENTS </h4>
                    <p class="card-description">  <code></code>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Photo</th>
                            <th>Username</th>
                            <th>Full name</th>
                            <th>Email</th>
                            <th>adresse</th>
                            <th>Tele</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          while($client=$req->fetch(PDO::FETCH_ASSOC)){
                          ?>
                          <tr>
                            <td><img src="../clients/profile/<?=$client['photo'] ?>" alt=""></td>
                            <td><?=$client['username'] ?></td>
                            <td><?=$client['nom_complet'] ?></td>
                            <td><?=$client['mail'] ?></td>
                            <td><?=$client['adresse'] ?></td>
                            <td><?=$client['tele'] ?></td>
                          </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-center"><b>Reservation</b></h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th class="text-center"> id </th>
                            <th class="text-center"> Username </th>
                            <th class="text-center">quantite </th>
                            <th class="text-center"> matricule</th>
                            <th class="text-center"> Marque</th>
                            <th class="text-center"> date de location </th>
                            <th class="text-center"> date de retour </th>
                            <th class="text-center"> montant Total </th>
                            <th class="text-center"> Nombre de joure </th>
                            <th class="text-center"> date de reservation </th>
                            <th class="text-center"><span class="text-danger">Option1 : </span> A baby seat </th>
                            <th class="text-center"><span class="text-danger">Option2 : </span> Wifi </th>
                            <th class="text-center"><span class="text-danger">Option3 : </span> GPS </th>
                            <th class="text-center">  </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          while($reserves=$reserve->fetch(PDO::FETCH_ASSOC)){
                          ?>
                          <tr>
                           
                            <td class="text-center" ><?=$reserves['Réservations_id'] ?></td>
                            <td class="text-center" ><?=$reserves['client_cin'] ?></td>
                            <td class="text-center" ><?=$reserves['quantite'] ?></td>
                            <td class="text-center" ><?=$reserves['voiture_vin'] ?></td>
                            <td class="text-center" ><?=$reserves['marque'] ?></td>
                            <td class="text-center" ><?=$reserves['date_de_location'] ?></td>
                            <td class="text-center" ><?=$reserves['date_de_retour'] ?></td>
                            <td class="text-center" ><?=$reserves['montant_total'] ?></td>
                            <td class="text-center" ><?=$reserves['nbr_joures'] ?></td>
                            <td class="text-center" ><?=$reserves['date_de_reservation'] ?></td>
                            <td class="text-center" ><?=$reserves['option1'] ?></td>
                            <td class="text-center" ><?=$reserves['option2'] ?></td>
                            <td class="text-center" ><?=$reserves['option3'] ?></td>
                          </tr>
                          <?php
                          }
                          ?>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i></span>
  </div>
</footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
  </body>
</html>