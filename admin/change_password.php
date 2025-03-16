<?php
include("../connexion.php");
$id=$_GET['id'];
$stet=$con->prepare("select * from admin");
$stet->execute();
$table=$stet->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['curent_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])){
    if( password_verify($_POST['curent_password'],$table['password'])){

        $hash=password_hash( $_POST['new_password'],PASSWORD_DEFAULT);
        if(password_verify($_POST['confirm_password'],$hash)   ){
            $stet2=$con->prepare("UPDATE admin set password='$hash' where username='$id' ");
            $stet2->execute();
            header("location:edite_profile.php");
        }
        else{
            echo "err";
        }
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Easiest Way to Add Input Masks to Your Forms</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="../styles/password_admin.css">
</head>
<body>
    <div class="registration-form">
        <div class="col-12 container mb-3 text-center">
            
            <a   href="edite_profile.php" class=" text-center btn btn-primary col-5">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <form method="post">
            <h1 class="text-center">Change the password</h1>
            <div class="form-icon text-center" >
                <img src="../icon/image/<?=$table['photo']?>" style="width:120px;" class="rounded-circle p-1 bg-primary" alt="">
            </div>
        
            <div class="form-group">
                <input type="password" class="form-control item" id="password" name="curent_password" placeholder="Enter Curent Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password" name="new_password"  placeholder="Enter New Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password" name="confirm_password" placeholder="Confirm Password">
            </div>
                <button type="submit" class="btn btn-block create-account">Change Password</button>
            </div>
        </form>
     
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
