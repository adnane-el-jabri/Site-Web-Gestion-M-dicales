<?php
    session_start(); 
    $carte = $_SESSION['cin'];
    include('dbconnexion.php');    
    $getpatient = $bdd->prepare('SELECT * FROM docteurmed where cin = :carte' );
    $getpatient->bindParam('carte' , $carte);
    $getpatient->execute();
    $get=$getpatient->fetch(PDO::FETCH_ASSOC);
    $id_docteur = $get['id_docteur'];
?>