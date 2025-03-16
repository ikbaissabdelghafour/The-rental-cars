<?php
include('../connexion.php'); 
$id = $_GET['matricule'];
$req = "SELECT * FROM voitures WHERE matricule = '$id'";
$stet = $con->prepare($req);
$stet->execute();
$table = $stet->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricule = $_POST['matricule'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $carossseri_type = $_POST['carossseri_type'];
    $type_de_carburant = $_POST['type_de_carburant'];
    $vitesse = $_POST['vitesse'];
    $color = $_POST['color'];
    $prix_par_jour = floatval($_POST['prix_par_jour']);
    $porte = intval($_POST['porte']);
    $quantite = intval($_POST['quantite']);

    if (isset($_FILES['photo']) && $_FILES['photo']['name'] != "") {
        $photo = $_FILES['photo']['name'];
        $tmp = $_FILES['photo']['tmp_name'];
        if (!move_uploaded_file($tmp, 'images/' . $photo)) {
            echo "<script>alert('Upload failed')</script>";
            $photo = $table['photo'];
        }
    } else {
        $photo = $table['photo'];
    }

    $req = "UPDATE voitures SET matricule=?, marque=?, modele=?, carossseri_type=?, type_de_carburant=?, vitesse=?, color=?, prix_par_jour=?, photo=?, porte=?, quantite=? WHERE matricule=?";
    $stet = $con->prepare($req);
    $stet->execute([$matricule, $marque, $modele, $carossseri_type, $type_de_carburant, $vitesse, $color, $prix_par_jour, $photo, $porte, $quantite, $id]);
    header("location:page.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Bootstrap.css">
    <script src='../js/Bootstrap.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Modifier véhicule</title>
</head>
<body>
    <div class="container mt-5">
        <a href="page.php" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
        <form action="" method="post" enctype="multipart/form-data">
            <h1 class="mb-5 col-12 text-center" style="font-family: 'Roboto', sans-serif;">Modifier les informations du véhicule</h1>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="matricule"><b>Matricule</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='matricule' name='matricule' type="text" value='<?= $table['matricule'] ?>'>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="quantite"><b>Quantité</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='quantite' name='quantite' type="number" value='<?= $table['quantite'] ?>'>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="marque"><b>La marque</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='marque' name='marque' type="text" value='<?= $table['marque'] ?>'>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="modele"><b>Modèle</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='modele' name='modele' type="text" value='<?= $table['modele'] ?>'>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="carossseri_type"><b>Type de carrosserie</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='carossseri_type' name='carossseri_type' type="text" value='<?= $table['carossseri_type'] ?>'>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="type_de_carburant"><b>Type de carburant</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='type_de_carburant' name='type_de_carburant' type="text" value='<?= $table['type_de_carburant'] ?>'>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="vitesse"><b>Vitesse</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='vitesse' name='vitesse' list="speed" value='<?= $table['vitesse'] ?>'>
                    <datalist id="speed">
                        <option value="Manuel">
                        <option value="Automatique">
                    </datalist>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="color"><b>Couleur</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='color' name='color' type="text" value='<?= $table['color'] ?>'>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="prix_par_jour"><b>Prix par jour</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='prix_par_jour' name='prix_par_jour' type="number" step="0.01" value='<?= $table['prix_par_jour'] ?>'>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="porte"><b>Nombre de portes</b> <span class="text-danger">*</span></label>
                    <input class="form-control" required id='porte' name='porte' type="number" value='<?= $table['porte'] ?>'>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="photo"><b>Photo</b> <span class="text-danger">*</span></label>
                <input class="form-control" id='photo' name='photo' type="file" accept="image/*">
                <?php if ($table['photo']): ?>
                    <img src="images/<?= $table['photo'] ?>" alt="Existing Photo" style="max-width: 200px; height: auto;" class="mt-2">
                    <p>Current photo: <?= $table['photo'] ?></p>
                <?php endif; ?>
            </div>

            <button class="btn btn-primary" type="submit">Modifier véhicule</button>
        </form>
    </div>
</body>
</html>
