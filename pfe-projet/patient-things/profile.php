<?php 
session_start();
$carte = $_SESSION['cin']; 
include('dbconnexion.php');
$getpatient = $bdd->prepare('SELECT * FROM patientmed where cin = :carte' );
$getpatient->bindParam('carte' , $carte);
$getpatient->execute();
$get=$getpatient->fetch(PDO::FETCH_ASSOC);
?>