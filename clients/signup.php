<?php
include('../connexion.php');

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['tele']) && isset($_POST['confirme_password']) && isset($_POST['nom_complet']) && isset($_POST['mail']) && isset($_POST['adresse'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirme_password = trim($_POST['confirme_password']);
    $nom_complet = trim($_POST['nom_complet']);
    $mail = trim($_POST['mail']);
    $adresse = trim($_POST['adresse']);
    $tele = trim($_POST['tele']);

    if ($password === $confirme_password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $req = 'INSERT INTO clients (username, password, nom_complet, mail, adresse, tele) VALUES (:username, :password, :nom_complet, :mail, :adresse, :tele)';
        $stet = $con->prepare($req);
        try {
            $stet->execute([
                'username' => $username,
                'password' => $hash,
                'nom_complet' => $nom_complet,
                'mail' => $mail,
                'adresse' => $adresse,
                'tele' => $tele
            ]);
            header('Location: ../login.php');
        } catch (PDOException $e) {
            echo '<script> alert("User already exists")</script>';
        }
    } else {
        echo "<script>alert('Passwords do not match')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../styles/css/Bootstrap.css">
    <style>
        .container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
}

.signup-form {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
}

span.text-danger {
    display: none;
    color: red;
    font-size: 14px;
}

span.text-danger.active {
    display: block;
}

    </style>
</head>
<body>
    <div class="container">
        <form name='formule' action="" method="post" class="signup-form">
            <center> <div><a href="../index.php"><?php include('../logosvg.php');?></a></div>
        <h2>Sign Up</h2>
    <div class="form-group">
                <input required name="username" type="text" placeholder="Username">
                <span id='username' class='text-danger'>Username already exists</span>
            </div>
            <div class="form-group">
                <input required name="nom_complet" type="text" placeholder="Votre nom complet">
                <span id='nom_complet' class='text-danger'>Please enter your full name</span>
            </div>
        <div class="form-group">
            <input required name="mail" type="email" placeholder="Email">
        <span id='mail' class='text-danger'>Please enter a valid email</span>
    </div>
<div class="form-group">
                <input required name="tele" type="text" placeholder="Telephone">
                <span id='tele' class='text-danger'>Please enter a valid telephone number</span>
            </div>
        <div class="form-group">
            <input required name="password" type="password" placeholder="Password">
        <span id='password' class='text-danger'>Please enter a password</span>
    </div>
<div class="form-group">
    <input required name="confirme_password" type="password" placeholder="Confirm Password">
<span id='confirme_password' class='text-danger'>Passwords do not match</span>
</div>
<div class="form-group">
    <input required name="adresse" type="text" placeholder="Adresse">
<span id='adresse' class='text-danger'>Please enter your address</span>
</div>
<div class="form-group">
    <input name="submit" type="submit" value="Submit" class="btn btn-primary">
</div>
<div>
    
    <a href="../login.php">Log in</a>
</div>
</center>
        </form>
    </div>
    <script src='signup.js'></script>
</body>
</html>
