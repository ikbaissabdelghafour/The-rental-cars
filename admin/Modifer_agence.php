<?php
include("../connexion.php");
$stet=$con->prepare("Select * from agence");
$stet->execute();
$table=$stet->fetch(PDO::FETCH_ASSOC);
if($_SERVER['REQUEST_METHOD']=="POST"){
    $req="UPDATE agence set adresse=?,tele=?,email=?,temp_debut=?,temp_fin=?";
    $stet1=$con->prepare($req);
    $stet1->execute([$_POST['adresse'] , $_POST['tele'],$_POST['email'],$_POST['temp_debut'],$_POST['temp_fin']]);
    header("location:profile.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/css/Bootstrap.css">
    <link rel="stylesheet" href="../styles/modifer_agence.css">
    <script src='../styles/js/Bootstrap.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Document</title>
</head>
<body class="p-5">

<form class="col-8 mt-5 container border-" action="" method="post" >
    <h1 class="text-center m-4 ">Modifer Info agence</h1>
<a href="profile.php" class=" col-12  mb-3 btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back
        </a>								
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tele :</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input name="tele" type="text" class="form-control" value="<?=$table['tele']?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email : </h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input  name="email"type="text" class="form-control" value="<?=$table['email']?>">
                            </div>
                        </div>
            
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address : </h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input name="adresse" type="text" class="form-control" value="<?=$table['adresse']?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">L'ouverture : </h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input name="temp_debut" type="time" class="form-control" value="<?=$table['temp_debut']?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Fermeture : </h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input name="temp_fin" type="time" class="form-control" value="<?=$table['temp_fin']?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <input type="submit" class="btn btn-success px-4 col-12" value="Save Changes">
                            </div>
                        </div>
                        <br>
                    </div>
                    </form>
                </div>

</body>
</html>