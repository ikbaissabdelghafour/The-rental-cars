<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/css/Bootstrap.css">
    <link rel="stylesheet" href="../styles/home_client.css">
    <link rel="stylesheet" href="../styles/nav_progress.css">
    <script src='../styles/js/Bootstrap.js'></script>
    <title>Options</title>
</head>
<body>
    <?php
    include('../connexion.php');
    ini_set('session.gc_maxlifetime', 86400);  // 24 hours
    ini_set('session.cookie_lifetime', 86400);  // 24 hours
    session_start();
        $date_loc=new DateTime($_SESSION['date_de_location']);
    $date_ret=new DateTime($_SESSION['date_de_retour']);
    $diffrence= $date_loc->diff($date_ret)->days;
    $_SESSION['nbr_jours']=$diffrence;
    include("../header.php");
    if(isset($_GET['matricule'])){
        $matricle=$_GET['matricule'];
        $option=$con->prepare("select * from voitures where matricule='$matricle' ");
        $option->execute();
        $car=$option->fetch(PDO::FETCH_ASSOC);
        $_SESSION['prix_des_jours']=intval($car['prix_par_jour'])*intval($_SESSION['days']);
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['option1'])){
        $o1=79.9;
        $_SESSION['option1']=true;
        
    }
    else{
        $_SESSION['option1']=false;
        $o1=0;
        
    }
    if(isset($_POST['option2'])){
        $_SESSION['option2']=true;
        $o2=99.9;
    }
    else{
        $o2=0;
        $_SESSION['option2']=false;
        
    }
    if(isset($_POST['option3'])){
        $_SESSION['option3']=true;
        $o3=119.9;
    }
    else{
        $_SESSION['option3']=false;
        $o3=0;
        
    }
    if(isset($o1) || isset($o2) || isset($o3)){
        $total_option=$o1+$o2+$o3;
    }
    $_SESSION['total_option']=$total_option;
    header("location:payement.php?matricule=$matricle");
}

?>
    <div class="head">
        <nav style="border-bottom:green solid 5px;">
            <div class="a">
                <p><img src="../icon/check.png" alt=""><span><b>Reservation date</b></span> <a href="../index.php">Modifier<img src="../icon/pen.png" alt=""></a> </p>
            </div>
            <div class="b">
                <div><img src="../icon/next.png" alt=""><b> Rental date:</b>    <span class="span"><?= $_SESSION['date_de_location']?></span></div>
                <div><img src="../icon/back.png" alt=""><b> Return date : </b>  <span class="span"><?= $_SESSION['date_de_retour']?></span></div>
                <div><img src="../icon/day.png" alt=""><b> Number of days: </b> <span class="span"><?= $diffrence?></span> Days</div>
            </div>
        </nav>
        <nav style="border-bottom:green solid 5px;">
            <div class="a">
                <p><img src="../icon/check.png" alt=""><span><b>Vehicule</b></span>  <a href="filter.php">Modifier<img src="../icon/pen.png" alt=""></a> </p>
            </div>
            <br>
            <div class="b">
                <div><img src="../icon/car.png" alt=""> <b>Marque</b><span class="span"> <?=$car['marque'] ?></span></div>
                <div><img src="../icon/gasoline.png" alt=""> <span><?=$car['type_de_carburant'] ?></span><b>/</b><img src="../icon/vitesse.png" alt=""><span class="span">  <?=$car['vitesse'] ?> <span></div>
                <?php    
                    ?>
                <div><img src="../icon/dollar.png" alt=""> <b>Days price. &nbsp; </b> <span><?=$_SESSION['prix_des_jours'] ?> HD </span>  </div>
            </div>
            
        </nav>
        <nav style="border-bottom:orange solid 5px;">
            <div class="a">
                <p><img src="../icon/circle.png" alt=""><span><b>Options</b></span> </p>
            </div>
            <div class="b">
            </div>
        </nav>
        <nav>
            <div class="a">
                <p><img src="../icon/circle.png" alt=""><span><b>Payment</b></span> </p>
            </div>
            
        </nav>
    </div>
    <h1 class=" row col-12 text- justify-content-center">The options</h1>
    <form action=""  method="post">
    <div class="row justify-content-center">
  <div class="container col-10 col align-self-center row">
      <label class="col-sm-4" for="option1">

    <div >
        <div class="card">
            <img style="height:250px;" class="card-img-top" src="../icon/oiejpg.jpg" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">A baby seat</h2>
                    <h4 class="card-title">price <span>79,9 DH</span>  </h4>
                    <p class="card-text">Goy Car vous assure un siège bébé pour les bébé de 0 à 3 ans, totalement conforme aux exigences de sécurité, homologué NF</p>
                    <div class="form-check form-switch">
                        <input type="checkbox" value="option1" class=" form-check-input" name="option1" id="option1">
                    </div>

                </div>
            </div>
        </div>
    </label>
    <label class="col-sm-4" for="option2">
        <div >
            <div class="card">
                <img style="height:250px;" class="card-img-top" src="../icon/wificar.jpeg" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">Wifi</h2>
                    <h4 class="card-title">price <span> 99,9DH</span> </h4>
                    <p class="card-text">Want to relax during your journey or simply need to do research, our Mobile Wifi device can be transported wherever you go for a 100% connected stay.</p>
                    <div class="form-check form-switch">
                        <input type="checkbox" value="option2" class=" form-check-input" name="option2" id="option2">
                    </div>
                    
                </div>
    </div>
</div>
</label>

<label class="col-sm-4" for="option3">
    <div >
        <div class="card">
            <img style="height:250px;" class="card-img-top" src="../icon/carmap.jpg" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">GPS</h2>
                <h4 class="card-title">price <span>119,9DH</span> </h4>
                <p class="card-text">Let yourself be guided by our GPS navigation system. No matter your route, access it easily and make the most of your trip.</p>
                <div class="form-check form-switch">
                    <input type="checkbox" value="option3" class=" form-check-input" name="option3" id="option3">
                </div>
                
            </div>
        </div>
    </div>
</label>
</div>
</form>
<button type="submit" class="btn btn-primary m-5 col-8 "> Pay</button>
</div>


</body>
</html>