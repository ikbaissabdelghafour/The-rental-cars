<?php
include('../connexion.php');
$id=$_GET['matricule'];
$stet=$con->prepare("DELETE FROM voitures where matricule ='$id'");
$stet->execute();
header("location:page.php");
?>