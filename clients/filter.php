<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/css/Bootstrap.css">
    <link rel="stylesheet" href="../styles/home_client.css">
    <link rel="stylesheet" href="../styles/nav_progress.css">
    <script src='../styles/js/Bootstrap.js'></script>
    <title>filter</title>
</head>

<?php
ini_set('session.gc_maxlifetime', 86400);  // 24 hours
ini_set('session.cookie_lifetime', 86400);  // 24 hours
session_start();
include("../connexion.php");
if(isset($_SESSION['date_de_location']) && isset($_SESSION['date_de_retour']) ){

$filter="
SELECT * 
FROM voitures 
WHERE quantite > 0
union
SELECT * 
FROM voitures 
WHERE matricule IN (
    SELECT voiture_vin 
    FROM reservations 
    WHERE NOT (
        (date_de_location BETWEEN :date_de_location  AND :date_de_retour )
        OR
        (date_de_retour BETWEEN :date_de_location  AND :date_de_retour )
        OR
        (date_de_location <= :date_de_location  AND date_de_retour >= :date_de_retour )
    )
);
";
$stetment= $con->prepare($filter);
    $stetment->execute(["date_de_location"=> $_SESSION['date_de_location'] ,"date_de_retour"=>$_SESSION['date_de_retour']]);
}

$date_loc=new DateTime($_SESSION['date_de_location']);
$date_ret=new DateTime($_SESSION['date_de_retour']);
$diffrence= $date_loc->diff($date_ret)->days;
$_SESSION['days']=$diffrence;


include("../header.php");
?>
    <div class="head">
        <nav style="border-bottom:green solid 5px;">
            <div class="a">
                <p><img src="../icon/check.png" alt=""><span><b>Reservation date</b></span> <a href="../index.php">Modifier<img src="../icon/pen.png" alt=""></a></p>
            </div>
            <div class="b">
                <div><img src="../icon/next.png" alt=""><b> Rental date:</b>    <span class="span"><?= $_SESSION['date_de_location']?></span></div>
                <div><img src="../icon/back.png" alt=""><b> Return date : </b>  <span class="span"><?= $_SESSION['date_de_retour']?></span></div>
                <div><img src="../icon/day.png" alt=""><b> Number of days: </b> <span class="span"><?= $diffrence?></span >&nbsp; Days</div>
            </div>
        </nav>
        <nav style="border-bottom:orange solid 5px;">
            <div class="a">
                <p><img src="../icon/circle.png" alt=""><span><b>Vehicule</b></span> </p>
            </div>
            <br>

        </nav>
        <nav>
            <div class="a">
                <p><img src="../icon/circle.png" alt=""><span><b>Options</b></span> </p>
            </div>
         
        </nav>
        <nav>
            <div class="a">
                <p><img src="../icon/circle.png" alt=""><span><b>Payment</b></span> </p>
            </div>
     
        </nav>
    </div>


<div class="container my-4">
    
    <div class="row">
        
            <?php
            while ($table =$stetment->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <img src="../admin/images/<?=$table['photo']?>" class="card-img-top" alt="<?=$table['marque']?> <?=$table['modele']?>">
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
                       <?php if(isset( $_SESSION['user'])){?>
                        <h5> <a class="btn btn-primary" href="options.php?matricule=<?= htmlspecialchars($table['matricule'])?>"> reserver</a></h5>
                        <?php
            }
            else{
                ?>
                <h5> <a class="btn btn-primary" href="../login.php?matricule=<?= htmlspecialchars($table['matricule'])?>&user=false "> reserver</a></h5>
                
                <?php
            }
                       ?>
                    </div>
                </div>
            </div>
            <?php    
            }
            ?>
        </div>
    </div>
</body>
</html>