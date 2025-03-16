<?php
include('../connexion.php');

$id=$_GET['id'];
$stet=$con->prepare("UPDATE clients set photo='avatar.png' where username='$id'");
$stet->execute();
header("location:edite_profile.php");
?>