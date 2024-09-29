<?php
    session_start();
    if(!$_SESSION['mdp']){
        header('Location: d_login.php');
    }
    $carte = $_SESSION['cin'];
    include('dbconnexion.php');    
    $getpatient = $bdd->prepare('SELECT * FROM docteurmed where cin = :carte' );
    $getpatient->bindParam('carte' , $carte);
    $getpatient->execute();
    $get=$getpatient->fetch(PDO::FETCH_ASSOC);
    $id_docteur = $get['id_docteur'];



?>  
<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="p_login.css">
    <link rel="stylesheet" href="espace_p.css">
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="espace_d.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=BhuTuka+Expanded+One&family=Bree+Serif&family=Catamaran:wght@100&family=Caveat:wght@400;500;600;700&family=Courier+Prime:wght@400;700&family=Dancing+Script:wght@400;500;600;700&family=Dongle:wght@300;400;700&family=Dosis:wght@200&family=Fredoka:wght@300&family=Golos+Text:wght@400;500;600;700;800;900&family=Hubballi&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Karla:ital,wght@1,200&family=Kumbh+Sans:wght@100;200;300;400;500;600;700;800;900&family=Lato:wght@100;300;400;700;900&family=League+Spartan:wght@300&family=Merriweather:ital@1&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Nunito:wght@200&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400&family=Pacifico&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Raleway:wght@100&family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto+Mono:wght@100;200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,500&family=Smooch+Sans:wght@100;200;300;400;500;600;700;800;900&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&family=Tilt+Neon&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
<script src="espace-d.js" defer></script>

</head>

<body >
<div class="access"></div>
    <div class="access2"></div>
<header>
        <h1>Gestion medical</h1>
        <span class="toggle">Account</span>
    </header>
    <nav>
        <div class='essential-infos'>
        <img class="profile-pic" src="../imgs/user-profile.jpeg" width='120px' height='120px' alt='' />
            <span class='user-name'><?php echo $get['fn'] . " " . $get['ln']; ?></span>
        </div>
        <div class='others'>
            <span>mobile: <?php echo $get['mb']; ?> </span>
            <span>CIN: <?php echo $get['cin']; ?></span>
            <span>ville: <?php echo $get['vle']; ?></span>
            <span>Region: <?php echo $get['rg']; ?></span>
            <span>Adresse: <?php echo $get['ad']; ?></span>
        </div>
        <a href="deconnexion.php"><button  class='deconnexion'>Déconnexion</button></a>
        
    </nav>
    <form method="post" class="scanner">
        <input type="text" name="text" id="text" readonly="" placeholder="Scanner le code QR" class="form-control" />
    </div>

       <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });

        scanner.addListener('scan', function (content) {
            document.getElementById("text").value = content;
            document.forms[0].submit();
            setTimeout(() => {
                location.reload();
            }, 1000)
        });
    </script>
 <?php 
    $bdd = new PDO('mysql:host=localhost:3325;dbname=gestion_medicale;', 'root', 'root');
    $id_docteur = $get['id_docteur'];
    $select = $bdd->prepare ("SELECT * FROM dossiermed INNER JOIN docteurmed ON dossiermed.id_doct=docteurmed.id_docteur INNER JOIN patientmed ON dossiermed.id_pat=patientmed.id_patient WHERE docteurmed.id_docteur=:id_docteur");
    $select->bindParam('id_docteur', $id_docteur);
    $select->execute();
?>
    <div class="table">
    <div class="table-head row" style="background-color: rgba(255, 255, 255, 0.1);">
        <span>Nom Patient</span>
        <span>Date</span>
        <span>consultation</span>
        <span>Action</span>
    </div>
    <div class="row-container">
    <?php
    
        $ids = array();
        include('dbconnexion.php');  
        while ($fetch=$select->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="row">';
            $dossier = $fetch['id_dossier']; 
            $last = $fetch['ln']; 
            $first = $fetch['fn']; 
            $dat = $fetch['Dates']; 
            echo "<span>". $last . " " . $first . "</span>";
            echo "<span>" . $dat . "</span>";
            $ids[] = $dossier;
            echo "<span><form method='post'><input type='hidden' name='id_dossier' value='" . $dossier . "'/><textarea  class='form-control' name='texte' placeholder='Entrez votre consultation!' id='floatingTextarea'>$fetch[consultation]</textarea><br><button class='env' type='submit' name='envoyer'>envoyer</button></form></span>";
            echo"<span><form method='post'><button class='del' type='submit' name='delete'>Supprimer</button></form></span>";
            echo "</div>";
            }
        echo "</div>";
        echo "</div>";
    
    ?>

    

<?php 

$bdd = new PDO('mysql:host=localhost:3325;dbname=gestion_medicale;', 'root', 'root');
$key = $bdd->prepare ("SET FOREIGN_KEY_CHECKS=0");
$key->execute(); 
if (isset($_POST['text'])) {
    $text = $_POST['text'];
    $variables = explode('|', $text);
    $id_pat= $variables[0];

    $sqlin = $bdd->prepare ("INSERT INTO dossiermed(id_pat,id_doct) values (:id_pat, :id_docteur)");
    $sqlin->bindParam('id_pat' , $id_pat);
    $sqlin->bindParam('id_docteur' , $id_docteur);
    $sqlin->execute();?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
          icon: "success",
          title: "bon travail !",
          text: "  Le dossier a été créer !",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false
         }). then(function(result){
            window.location = "espace_docteur.php";
             })
        </script>  
<?php
}
$del=$bdd->prepare("DELETE FROM dossiermed WHERE dossiermed.id_pat = 0");
$del->execute();?>    
<?php
if(isset($_POST['envoyer'])){
    $texte = $_POST['texte'];
    $dossier = $_POST['id_dossier'];
    $cons = $bdd->prepare("UPDATE dossiermed SET consultation = :texte WHERE id_dossier=:dossier");
    $cons->bindParam('texte', $texte);
    $cons->bindParam('dossier', $dossier); 
    $cons->execute();?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
          icon: "success",
          title: "bon travail !",
          text: "  La consultation a été envoyé au patient !",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false
         }). then(function(result){
            window.location = "espace_docteur.php";
             })
         </script>  
<?php    
}
?>

<?php
if(isset($_POST['delete'])){
    $delet=$bdd->prepare("DELETE FROM dossiermed WHERE id_dossier=:dossier");
    $delet->bindParam('dossier',$dossier);
    $delet->execute();?>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
          icon: "success",
          title: "bon travail !",
          text: "  Le dossier a été supprimer !",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false
         }). then(function(result){
            window.location = "espace_docteur.php";
             })
         </script>    
<?php
}
?>
<?php
$foreign = $bdd->prepare ("SET FOREIGN_KEY_CHECKS=1");
$foreign->execute(); 

?>

</body>

</html>