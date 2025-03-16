<?php
include('connexion.php');
session_start();

function authenticate($con, $table, $username_field, $password_field, $username, $password) {
    $query = "SELECT * FROM $table WHERE $username_field = :username";
    $stmt = $con->prepare($query);
    $stmt->execute(['username' => trim($username)]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user[$password_field])) {
        return $user;
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin = authenticate($con, 'admin', 'username', 'password', $username, $password);
    if ($admin) {
        $_SESSION['username'] = $admin['username'];
        $_SESSION['name'] = $admin['nom_complet'];
        $_SESSION['photo'] = $admin['photo'];
        
        header('Location: admin/dashbord.php');
        exit();
    } else {
        $client = authenticate($con, 'clients', 'mail', 'password', $username, $password);
        if ($client) {
            $_SESSION['user'] = $client['username'];
            $_SESSION['mail']=$client['mail'];
            $_SESSION['photo']=$client['photo'];
            $_SESSION['nom_complet']=$client['nom_complet'];
            $_SESSION['adresse']=$client['adresse'];
            $_SESSION['tele']=$client['tele'];
            if (isset($_GET['user']) && isset($_GET['matricule'])) {
                $matricule = $_GET['matricule'];
                $redirectUrl = ($_GET['user'] === 'false') ? "clients/options.php?matricule=$matricule" : "index.php?me=$id";
                header("Location: $redirectUrl");
                exit();
                }
                else{
                header("Location:index.php");
                
            }
        } else {
            header('Location: login.php?message=err');
        }
    }
}
?>

<!-- ----------------------------------------------- code HTML --------------------------------------------------------  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Bootstrap.css">
    <script src='js/Bootstrap.js'></script>
    <link rel="stylesheet" href="styles/loginadmin.css">
</head>
<body>
    <div class="wrapper">
        <div class="logo">
    <a href="index.php">
    <img src="icon/carabdo.png" alt="">       

    </a>
    </div>
        <div class="text-center mt-4 name">
            <b>Login</b>
        </div>
        <form method="post" class="p-3 mt-3">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" required name="username" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input required name="password" type="password" id="pwd" placeholder="Password">
            </div>
            <div class="text-center">
                <a href="clients/signup.php"> Sign-Up</a>
            </div>
            <button class="btn mt-3">Login</button>
        </form>
    </div>
</body>
</html>
