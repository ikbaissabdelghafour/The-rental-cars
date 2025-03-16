
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reserver.css">
    <link rel="stylesheet" href="../styles/css/Bootstrap.css">
    <link rel="stylesheet" href="../styles/home_client.css">
    <link rel="stylesheet" href="../styles/nav_progress.css">
    <script src='../styles/js/Bootstrap.js'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/nav_progress.css">
    <script src="../style/js/valider.js"></script>
    <link rel="shortcut icon" type="x-icon" href="">

    <?php 
include('../connexion.php');
include('../header.php');

session_start();
if(isset($_GET['matricule'])){
    $matricle=$_GET['matricule'];
    $option=$con->prepare("select * from voitures where matricule='$matricle' ");
    $option->execute();
    $car=$option->fetch(PDO::FETCH_ASSOC);
    // ^------------- DATE DE ROOOOOOOO------------
    $username=$_SESSION['user'];
    $date=$con->prepare("select date_de_retour from reservations where client_cin=? ");
    $date->execute([$username]);
    $RETOUR=$date->fetch(PDO::FETCH_ASSOC);
    if(isset($RETOUR['date_de_retour'])){

      if($RETOUR['date_de_retour']==date('Y-m-d')){
        $quntite=intval($car['quantite'])+1;
      $res=$con->prepare("UPDATE  voitures SET quantite=$quntite  where matricule='$matricle'");
    $res->execute();
  }
}

$pttc=$_SESSION['total_option']+$_SESSION['prix_des_jours'];
$_SESSION['total'] =$pttc;
    if(isset($_POST['card_number']) && isset($_POST['cvv'])  && isset($_POST['date'] )) {
      if( intval($car['quantite'] )>0){
        $quntite=intval($car['quantite'])-1;
        $res=$con->prepare("UPDATE  voitures SET quantite=$quntite where matricule='$matricle' ");
        $res->execute();
        }
      $payement=$con->prepare("insert into payement (username,nbcard,datecard,cvv)  values(?,?,?,?)");
      $payement->execute([$_SESSION['user'],sha1($_POST['card_number']) ,sha1($_POST['date']),sha1($_POST['cvv']) ]);
      $paye=$con->prepare('INSERT INTO reservations (client_cin, voiture_vin, date_de_location, date_de_retour, montant_total, nbr_joures,date_de_reservation,option1,option2,option3) 
      VALUES(?,?,?,?,?,?,?,?,?,?)');
      $option1=   $_SESSION['option1'] ? 79.9 :0;
      $option2=   $_SESSION['option2'] ? 99.9 :0;
      $option3=   $_SESSION['option3'] ? 199.9 :0;
      $paye->execute([$_SESSION['user'],$matricle,$_SESSION['date_de_location'],$_SESSION['date_de_retour'],$_SESSION['total'],$_SESSION['nbr_jours'],date('Y-m-d H:i:s'),$option1,$option2,$option3  ]);
      header("location:thankypage.php?name=$username&matricule=$matricle");
      }
      else{
        
    }

}
?>
    <title>Payment</title>
</head>
<body>

    <div class="head">
        <nav style="border-bottom:green solid 5px;">
            <div class="a">
                <p><img src="../icon/check.png" alt=""><span><b>Reservation date</b></span> <a href="../index.php">Modifier<img src="../icon/pen.png" alt=""></a> </p>
            </div>
            <div class="b">
                <div><img src="../icon/next.png" alt=""><b> Rental date:</b>    <span class="span"><?= $_SESSION['date_de_location']?></span></div>
                <div><img src="../icon/back.png" alt=""><b> Return date : </b>  <span class="span"><?= $_SESSION['date_de_retour']?></span></div>
                <div><img src="../icon/day.png" alt=""><b> Number of days: </b> <span class="span"><?= $_SESSION['nbr_jours']?></span> Days</div>
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
                    $_SESSION['prix_des_jours']=intval($car['prix_par_jour'])*intval($_SESSION['days']);
                    ?>
                <div><img src="../icon/dollar.png" alt=""> <b>Days price. &nbsp; </b> <span><?=$_SESSION['prix_des_jours'] ?>  </span> DH</div>
            </div>
            
        </nav>
        <nav style="border-bottom:green solid 5px;">
            <div class="a">
              
                <p><img src="../icon/check.png" alt=""><span><b>Options</b></span>  <a href="options.php?matricule=<?=$matricle?>">Modifier<img src="../icon/pen.png" alt=""></a> </p>
            </div>
            <div class="b"> 
              <!-- //^ ------------- option 1 ---------------- -->
              <?php if($_SESSION['option1']==true){
                ?>
                <div><b>A baby seat</b>  <span class="span">  79,9 DH</span></div>
                <?php }
              ?>
              <?php if($_SESSION['option2']==true){
                ?>
                <!-- //^ ------------- option 2 ---------------- -->
                <div><b>Wifi</b>  <span class="span">  99,9 DH</span></div>
                <?php }
              ?>
              <?php if($_SESSION['option3']==true){
                ?>
                <!-- //^ ------------- option 3 ---------------- -->
                <div><b>GPS</b>  <span class="span">  119,9 DH</span></div>
             <?php }
              ?>
              <?php if(isset($_SESSION['total_option']) ){
             ?>
                <div><b>total price of options</b>  <span  style="color:green;"> &nbsp; <?= $_SESSION['total_option']?> DH</span></div>
             <?php }
              ?>
              
            </div>
        </nav>
        <nav style="border-bottom:orange solid 5px;">
            <div class="a">
                <p><img src="../icon/circle.png" alt=""><span><b>Payment</b></span> </p>
            </div>
            <div class="b">
              <?php
              $pttc=$_SESSION['total_option']+$_SESSION['prix_des_jours'];
              $_SESSION['total']=$pttc;
              ?>
              <div> <img src="../icon/dollar.png" alt=""><b>PTTC</b><span  style="color:green;"> &nbsp; <?= $pttc?> DH</span></div>
              <div class="text-center  justify-content-center"><p><i>payment online</i></p></div>

            </div>
            
        </nav>
    </div>
    <div class="container d-flex justify-content-center mt-5 mb-5">

            

<div class="row g-3">

  <div class="col-md-12">  
    
    <span>Payment Method</span>
    <div class="card ">

      <div class="accordion" id="accordionExample">
        
        <div class="card">
          <div class="card-header p-0" id="headingTwo">
            <h2 class="mb-0">
            
            </h2>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
              </div>
              </div>
              </div>
              
              <form action="" method="post">
        <div class="card">
          <div class="card-header p-0">
            <h2 class="mb-0">
              <div class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <div class="d-flex align-items-center justify-content-between">

                  <span>Credit card</span>
                  <div class="icons">
                    <img src="https://i.imgur.com/2ISgYja.png" width="30">
                    <img src="https://i.imgur.com/W1vtnOV.png" width="30">
                    <img src="https://i.imgur.com/35tC99g.png" width="30">
                    <img src="https://i.imgur.com/2ISgYja.png" width="30">
                  </div>
                  
                </div>
              </div>
            </h2>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body payment-card-body">
              
              <span class="font-weight-normal card-text">Card Number</span>
              <div class="input">

                <i class="fa fa-credit-card"></i>
                <input required type="text" name="card_number"maxlength="12" class="form-control" placeholder="0000 0000 0000 0000">
                
              </div> 

              <div class="row mt-3 col-12  mb-3">

                <div class="col-md-6">

                  <span class="font-weight-normal card-text">Expiry Date</span>
                  <div class="input">

                    <i class="fa fa-calendar"></i>
                    <input required type="text"maxlength="5" name="date" class="form-control" placeholder="MM/YY">
                    
                  </div> 
                </div>
                <div class="col-md-6">
                  <span class="font-weight-normal card-text">CVC/CVV</span>
                  <div class="input">
                    <i class="fa fa-lock"></i>
                    <input required type="text" maxlength="3" name="cvv" class="form-control" placeholder="000">
                    </div> 
                    </form>
                    </div>
                  <br> <br><button class="ml-3 mt-3 col-12 btn btn-primary" type="submit">RESERVER</button>
              </div>
              <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is secured with ssl certificate</span>
            </div>
          </div>
        </div>
        
      </div>
      
    </div>

  </div>




</div>
    
</body>
</html>