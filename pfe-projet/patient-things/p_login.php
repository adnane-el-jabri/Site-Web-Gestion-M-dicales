<?php
session_start();
$bdd = new PDO('mysql:host=localhost:3325;dbname=gestion_medicale;', 'root', 'root');
if (isset($_POST['envoi'])) {
    if (!empty($_POST['cin']) and !empty($_POST['mdp'])) {
        $cin = htmlspecialchars($_POST['cin']);
        $mdp = sha1($_POST['mdp']);
        $recupuser = $bdd->prepare('SELECT * FROM patientmed WHERE cin = ? and mdp = ?');
        $recupuser->execute(array($cin, $mdp));
        if ($recupuser->rowCount() > 0) {
            $_SESSION['cin'] = $cin;
            $_SESSION['mdp'] = $mdp;
            header('Location: espace_patient.php');
        } else {
            $error[] = 'incorrect cin or password';
        }

    } else {
        // $error[] = 'veuillez complétez tous les champs';
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="p_login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=BhuTuka+Expanded+One&family=Bree+Serif&family=Catamaran:wght@100&family=Caveat:wght@400;500;600;700&family=Courier+Prime:wght@400;700&family=Dancing+Script:wght@400;500;600;700&family=Dongle:wght@300;400;700&family=Dosis:wght@200&family=Fredoka:wght@300&family=Golos+Text:wght@400;500;600;700;800;900&family=Hubballi&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Karla:ital,wght@1,200&family=Kumbh+Sans:wght@100;200;300;400;500;600;700;800;900&family=Lato:wght@100;300;400;700;900&family=League+Spartan:wght@300&family=Merriweather:ital@1&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Nunito:wght@200&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400&family=Pacifico&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Raleway:wght@100&family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto+Mono:wght@100;200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,500&family=Smooch+Sans:wght@100;200;300;400;500;600;700;800;900&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&family=Tilt+Neon&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="background">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
     </div>
    <form method="post" action="">
        <a class="closeTab" href="../home-page.html">x</a>
        <h2>Se connecter</h1><br>
        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-message">' . $error . '</span>';
            }
        }
        ?>
        <div class="inputs-container">
            <input type="text" placeholder="CIN" name="cin" required>
            <input type="password" placeholder="password" name="mdp" required>
            <input class="submit" type="submit" value="Se connecter" name="envoi">
        </div>
        <div class="second-choice">
            <div class="noAccount">J'ai pas un compte ?</div>
            <a class="to-other" href="patient-insc.html">Inscription</a>
        </div>
    </form>
</body>
</html>