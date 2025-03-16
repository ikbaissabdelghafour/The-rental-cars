<?php
include('../connexion.php'); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Insertion
    $matricule = $_POST['matricule'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $carossseri_type = $_POST['carossseri_type'];
    $type_de_carburant = $_POST['type_de_carburant'];
    $vitesse = $_POST['vitesse'];
    $color = $_POST['color'];
    $prix_par_jour = floatval($_POST['prix_par_jour']);
    $photo = $_FILES['photo']['name']; 
    $tmp = $_FILES['photo']['tmp_name']; 
    $porte = intval($_POST['porte']);
    $quantite = intval($_POST['quantite']);
    $file='images/'.$photo;
    $req="INSERT INTO voitures VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $stet=$con->prepare($req);
    if (!move_uploaded_file($tmp, $file)) {
        echo("<script>alert('Upload failed')</script>");
    }
    try {
        $stet->execute([$matricule, $marque, $modele, $carossseri_type, $type_de_carburant, $vitesse, $color, $prix_par_jour, $photo, $porte, $quantite]);
        $message = 'Car added successfully';
        header("location:dashbord.php");
    } catch (PDOException $e) {
        $message = 'Matricule already exists';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/css/Bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="shortcut icon" type="x-icon" href="../icon/car-rental.png">

    <script src='../styles/js/Bootstrap.js'></script>
    <title>Vehicle Entry Form</title>
</head>
<body>
    <div class="container mt-5">
        <a  href="dashbord.php" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <form class="" action="" method="post" enctype="multipart/form-data">
            <h1 class="mb-5 col-12 text-center" style="font-family: 'Roboto', sans-serif;">Saisir les informations du véhicule</h1>
            <!-- //^------------------------- row --------------------------------- -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="matricule"><b>Matricule</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='matricule' name='matricule' type="text">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="quantite"><b>Quantité</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='quantite' name='quantite' type="number">
                </div>
            </div>
            <!-- //^------------------------- row --------------------------------- -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="marque"><b>La marque</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='marque' name='marque' type="text">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="modele"><b>Modèle</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='modele' name='modele' type="text">
                </div>
            </div>
            <!-- //^------------------------- row --------------------------------- -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="carossseri_type"><b>Type de carrosserie</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='carossseri_type' name='carossseri_type' type="text">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="type_de_carburant"><b>Type de carburant</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='type_de_carburant' name='type_de_carburant' type="text">
                </div>
            </div>
            <!-- //^------------------------- row --------------------------------- -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="vitesse"><b>Vitesse</b> <span class="text-danger">*</span></label>
                    <label for="vitesse">Vitesse</label>
                <select name="vitesse" id="vitesse" class="form-control">
                    <option selected vaule="manuel">Manuel</option>
                    <option  vaule="automatique">automatique</option>
                </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="color"><b>Couleur</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='color' name='color' type="text">
                </div>
            </div>
            <!-- //^------------------------- row --------------------------------- -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="prix_par_jour"><b>Prix par jour</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='prix_par_jour' name='prix_par_jour' type="number" step="0.01">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="porte"><b>Nombre de portes</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='porte' name='porte' type="number" min="2" max="5">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="photo"><b>Photo</b> <span class="text-danger">*</span></label>
                <input class="form-control" required id='photo' name='photo' type="file" accept="image/*" >
            </div>
            <button class="btn btn-primary" type="submit">Ajouter véhicule</button>
        </form>
    </div>
</body>
</html>
