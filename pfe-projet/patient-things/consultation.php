<?php

// $bdd = new PDO('mysql:host=localhost:3325;dbname=gestion_medicale;', 'root', 'root');
// include('profile.php'); 
// $patient_id=$get['id_patient'];
// $consul = $bdd->prepare('SELECT * FROM dossiermed INNER JOIN patientmed ON dossiermed.id_pat=patientmed.id_patient INNER JOIN docteurmed ON dossiermed.id_doct=docteurmed.id_docteur  where dossiermed.id_pat = :patient_id' );
// $consul->bindParam('patient_id' , $patient_id);
// $consul->execute();
// $get_consultation=$consul->fetch(PDO::FETCH_ASSOC);
// echo $get_consultation['consultation']; 
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="consultation.css">
    <title>Patient-consultations</title>
</head>

<body>
<div class="access1"></div>
    <div class="access2"></div>
    <div class="access"></div>
<?php
    $bdd = new PDO('mysql:host=localhost:3325;dbname=gestion_medicale;', 'root', 'root');
    include('profile.php'); 
    $patient_id=$get['id_patient'];
    $consul = $bdd->prepare('SELECT * FROM dossiermed INNER JOIN patientmed ON dossiermed.id_pat=patientmed.id_patient INNER JOIN docteurmed ON dossiermed.id_doct=docteurmed.id_docteur  where dossiermed.id_pat = :patient_id' );
    $consul->bindParam('patient_id' , $patient_id);
    $consul->execute();
    ?>
    <?php while($get_consultation=$consul->fetch(PDO::FETCH_ASSOC)){ 
        echo "
        <div class='card'>
          <div class='card-header'>
            Consultation
          </div>
          <div class='card-body'>
            <div class='card-infos'>
                <img src='../imgs/user-profile.jpeg' alt='' />
                <h5 class='card-title'>Docteur : $get_consultation[fn] $get_consultation[ln]</h5>
            </div>
                <p class='card-text'>$get_consultation[consultation]</p>
            <form method='post'></form>
          </div>
          <div class='card-footer'>$get_consultation[Dates]</div>
        </div>";
    }
    
?>
</body>
</html>