<?php
session_start();
include('../connexion.php');
$id=$_SESSION['user'];
$stet=$con->prepare("select voitures.* , reservations.* from voitures join reservations on voitures.matricule=reservations.voiture_vin and reservations.client_cin='$id'  and voitures.matricule in (select voiture_vin from reservations where client_cin='$id')  ");
$stet->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/css/Bootstrap.css">
    <link rel="stylesheet" href="../styles/carrantel.css">
    <script src='../styles/js/Bootstrap.js'></script>
    <title>Document</title>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container padding-bottom-3x mb-2">
    <div class="row">
        <div class="col-lg-4">
            <aside class="user-info-wrapper">
                <div class="user-cover" style="background-image: url(../admin/images/BMW.jpg);">
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        <a class="edit-avatar" href="#"></a><img src="profile/<?=$_SESSION['photo']?>" alt="User"></div>
                    <div class="user-data">
                        <h4><?= $_SESSION['nom_complet']?></h4>
                    </div>
                </div>
            </aside>
            <nav class="list-group">
                <a class="list-group-item" href="profile.php"><i class="fa fa-user"></i>Profile</a>
                <a class="list-group-item" ><i class="fa fa-map"></i><?=$_SESSION['adresse'] ?></a>
            </nav>
        </div>
        <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
            <!-- Wishlist Table-->
            <div class="table-responsive wishlist-table margin-bottom-none">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Cars Rental</th>
                            <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="profile.php">Back</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($table=$stet->fetch(PDO::FETCH_ASSOC)){

                        ?>
                        <tr>
                            <td>
                                <div class="product-item d-flex " style="">
                                    <img  class="col-5 "style="width:250px;" src="../admin/images/<?=$table['photo']?>" alt="Product">
                                    <div class="col-1 ml-2 pl-2 product-info  ">

                                       
                                    </div>
                                    <div class="col-4 ms-2 product-info">
                                        <div class="align-items-center text-lg text-medium text-muted ml-2 "><img width="25px" src="../icon/car.png" alt="">&nbsp;  <b class="text-danger">La marque : </b><?=$table['marque']?></div>
                                        <div class="text-lg text-medium text-muted ml-2  mt-2"><img width="25px" src="../icon/dollar.png" alt="">&nbsp;  <b class="text-danger">prix par jour : </b><?=$table['prix_par_jour']?></div>  
                                        <div class="align-items-center text-lg text-medium text-muted ml-2 "><img width="25px" src="../icon/dollar.png" alt="">&nbsp;  <b class="text-danger">Pttc: </b><?=$table['montant_total']?></div>
                                       <div class="text-lg text-medium text-muted  ml-2 mt-2"><img width="25px" src="../icon/gasoline.png" alt="">&nbsp;  <b class="text-danger">type de carburant : </b><?=$table['type_de_carburant']?></div>
                                        
                                    </div>
                                    <div class="col-6 ms-2 product-info">
                                        <div class="align-items-center text-lg text-medium text-muted ml-2 "><img width="25px" src="../icon/vitesse.png" alt="">&nbsp;  <b class="text-success">Vitesse </b><?=$table['vitesse']?></div>
                                        <div class="align-items-center text-lg text-medium text-muted ml-2 "><img width="25px" src="../icon/calendar.png" alt="">&nbsp;  <b class="text-success">Le date de location : </b><?=$table['date_de_location']?></div>
                                        <div class="text-lg text-medium text-muted  ml-2 mt-2"><img width="25px" src="../icon/calendar.png" alt="">&nbsp;  <b class="text-success">la date de retour : </b><?=$table['date_de_retour']?></div>
                                        <div class="align-items-center text-lg text-medium text-muted ml-2 "><img width="25px" src="../icon/calendar.png" alt="">&nbsp;  <b class="text-success">Le nombre de jour : </b><?=$table['nbr_joures']?></div>

                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><a class="remove-from-cart" href="#" data-toggle="tooltip" title="" data-original-title="Remove item"><i class="icon-cross"></i></a></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <hr class="mb-4">
          
        </div>
    </div>
</div>

    
</body>
</html>