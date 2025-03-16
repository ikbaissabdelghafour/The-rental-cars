<?php
include("../connexion.php");
ini_set('session.gc_maxlifetime', 86400);  // 24 hours
ini_set('session.cookie_lifetime', 86400);  // 24 hours
session_start();
$nom=$_SESSION['name'];
$username=$_SESSION['username'];
// ^------------ reviews
$stet=$con->prepare('select * from reviews');
$stet->execute();
// ^------------ total boking
$date_day=date('Y-m-d');
$book=$con->prepare("SELECT count(*) as book
FROM reservations
WHERE MONTH(date_de_retour) = MONTH(CURDATE())
AND YEAR(date_de_retour) = YEAR(CURDATE())");
$book->execute();
$booking=$book->fetch(PDO::FETCH_ASSOC);
// ^------------ total boking
$bookday=$con->prepare("SELECT count(*) as book
FROM reservations
WHERE DATE(date_de_reservation) = CURDATE()");
$bookday->execute();
$bookingday=$bookday->fetch(PDO::FETCH_ASSOC);
// ^------------ Numbre de Client
$nbrclient=$con->prepare('select count(*) as nbrclients  from clients');
$nbrclient->execute();
$nbrclients=$nbrclient->fetch(PDO::FETCH_ASSOC);
// ^------------ chiffre d'affaire
$total=$con->prepare('SELECT sum(montant_total) as total  from  reservations WHERE MONTH(date_de_reservation) = MONTH(CURDATE()) AND YEAR(date_de_reservation) = YEAR(CURDATE()) ');
$total->execute();
$totals=$total->fetch(PDO::FETCH_ASSOC);
// ^------------------  
$bookin=isset($booking['book'])?$booking['book']:0;
$bookinday=isset($bookingday['book'])?$bookingday['book']:0;
$nbrcli=isset($nbrclients['nbrclients'])?$nbrclients['nbrclients']:0;
$money=isset($totals['total'])?$totals['total']:0;
// ^------------------  
$allreserv=$con->prepare('select count(Réservations_id) as allreserve  from reservations');
$allreserv->execute();
$allres=$allreserv->fetch(PDO::FETCH_ASSOC);
$allrer=isset($allres['allreserve'])?$allres['allreserve']:0;
// ^------------------  
$quntite=$con->prepare('select sum(quantite) as quantite  from voitures');
$quntite->execute();
$quantites=$quntite->fetch(PDO::FETCH_ASSOC);
$cars=$quantites['quantite'];



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    </head>
    <body>

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
            <img src="../icon/image/<?= $_SESSION['photo'] ?>" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="profile.php">
                <i class="ti-settings text-primary" ></i> Settings </a>
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
      <div class="container-fluid page-body-wrapper">
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
          <i class="icon-eye"></i>
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
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <?= $_SESSION['name']?></h3>                
            </div>
            </div>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                  <div class="card-people mt-auto">
                    <img style="height:300px;" src="../icon/agence.jpg" alt="people">
                    <div class="weather-info">
                      <div class="d-flex">
                        <div class="ms-2">
                          
                          </div>
                          </div>
                    </div>
                  </div>
                </div>
                </div>
                <div class="col-md-6 grid-margin transparent">
                  <div class="row">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                      <div class="card-body">
                        <p class="mb-4">Today’s Bookings</p>
                        <p class="fs-30 mb-2"><?=$bookinday?></p>
                        <p> For todays</p>
                        </div>
                        </div>
                        </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                        <p class="mb-4">Total Bookings</p>
                        <p class="fs-30 mb-2"> <?= $bookin?></p>
                        <p> For this month.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="card-body">
                        <p class="mb-4">Chiffre d'affaires.</p>
                        <p class="fs-30 mb-2"><?=round($money,2)?>&nbsp; <B>MAD</B></p>
                        <p> For this month.</p>
                        </div>
                        </div>
                  </div>
                  <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Number of Clients</p>
                        <g class="fs-30 mb-2 h1"><b><?= htmlspecialchars($nbrclients['nbrclients'])?> </b> </g>
                        <p> For this month.</p>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title">Order Details</p>
                    <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                    <div class="d-flex flex-wrap mb-5">
                      <div class="me-5 mt-3">
                        <p class="text-muted">Order value</p>
                        <h3 class="text-primary fs-30 font-weight-medium"><?=round($allrer)?></h3>
                        </div>
                      <div class="me-5 mt-3">
                        <p class="text-muted">Quantite Cars</p>
                        <h3 class="text-primary fs-30 font-weight-medium"><?=htmlspecialchars($cars)?></h3>
                        </div>
                      <div class="me-5 mt-3">
                        <p class="text-muted">Users</p>
                        <h3 class="text-primary fs-30 font-weight-medium"><?= round($nbrcli)?></h3>
                        </div>
                    
                          </div>
                          </div>
                </div>
                </div>
              <div class="col-md-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title">Notifications</p>
                    <ul class="icon-data-list">
                  <?php
                  while($review=$stet->fetch(PDO::FETCH_ASSOC)){

                  
                  ?>
                      <li>
                      <div class="d-flex">
                          <img src="assets/images/faces/face4.jpg" alt="user">
                          <div>
                            <small><?= $review['email']?></small>
                            <p class="text-info mb-1"> <?= $review['first_name']?>&nbsp; <?= $review['last_name']?> </p>
                            <p class="mb-0"><?= $review['message']?></p>
                          </div>
                          </div>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                  </div>
                </div>
              </div>
              </div>
             
              <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i></span>
    </div>
    </footer>
    </div>
      </div>
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="assets/js/dataTables.select.min.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>