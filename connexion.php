<?php
$host='localhost';
$user='root';
$db='location_des_voitures';
$password='';
try{
    $con=new PDO("mysql:host=$host; dbname=$db",$user,$password);
    // echo('connection is success');
}
catch(PDOException $e){
    die('connection is fail<br>'. $e->getMessage() );
}




?>