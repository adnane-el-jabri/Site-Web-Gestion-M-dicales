<?php
    include('phpqrcode/phpqrcode/qrlib.php');
    include('profile.php');
    if(!$_SESSION['mdp']){
        header('Location: p_login.php');
    }
    
    $texte = $get['id_patient'] . '|' . $get['rg'] . '|' . $get['vle'];
    $filename = 'test.png';
    QRcode::png($texte,$filename);

    
    
?>  
<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="espace_p.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=BhuTuka+Expanded+One&family=Bree+Serif&family=Catamaran:wght@100&family=Caveat:wght@400;500;600;700&family=Courier+Prime:wght@400;700&family=Dancing+Script:wght@400;500;600;700&family=Dosis:wght@200&family=Fredoka:wght@300&family=Hubballi&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Karla:ital,wght@1,200&family=Kumbh+Sans:wght@100;200;300;400;500;600;700;800;900&family=Lato:wght@100;300;400;700;900&family=League+Spartan:wght@300&family=Merriweather:ital@1&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Nunito:wght@200&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400&family=Pacifico&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Raleway:wght@100&family=Roboto+Mono:wght@100;200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,500&family=Smooch+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../fonts/all.min.css">
    <link rel="stylesheet" href="../fonts/normalize.css">
    <script src="espace_p.js" defer></script>
</head>
<body>
<div class="access"></div>
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
        <a class="dec" href="deconnexion.php">Déconnexion</a>
    </nav>
    <main>
        <div class="main-left">
            <h1>COMMENT SCANNER LE CODE QR DE CE PATIENT</h1>
            <p>Après avoir scanné le code QR du patient, son dossier médical sera ajouté à la liste des consultations du médecin qui a scanné le code. Ensuite, le médecin peut écrire une consultation et elle sera affichée sous forme de carte dans le compte du patient.</p>
            <div class="btns">
                <a class="qrOpen">Code QR</a>
                <a href="consultation.php">Consultation</a>
            </div>
        </div>
        <img class="doctor" src="../imgs/espace_p.png" height="400px" />
    </main>
    <div class="overlay"></div>
    <div id="modal">
        <span class="closeModal">x</span>
        <h2>Scanner le code Qr</h2>
        <img style="position: relative;background-size: 250px; filter: invert(0%);" class="rounded mx-auto d-block" src=<?php echo $filename ?> alt="" width='250px' height='250px'>
        <h3>SCANNING...</h3>
    </div>
</body>

</html>