<?php
session_start();
$bdd = new PDO('mysql:host=localhost:3325;dbname=gestion_medicale;', 'root', 'root');
if (isset($_POST['envoi'])) {
    if (!empty($_POST['fn']) and !empty($_POST['ln']) and !empty($_POST['mb']) and !empty($_POST['cin']) and !empty($_POST['vle']) and !empty($_POST['rg']) and !empty($_POST['ad']) and !empty($_POST['mdp'])) {
        $fn = htmlspecialchars($_POST['fn']);
        $ln = htmlspecialchars($_POST['ln']);
        $mb = htmlspecialchars($_POST['mb']);
        $cin = htmlspecialchars($_POST['cin']);
        $vle = htmlspecialchars($_POST['vle']);
        $rg = htmlspecialchars($_POST['rg']);
        $ad = htmlspecialchars($_POST['ad']);
        $mdp = sha1($_POST['mdp']);
        $insertuser = $bdd->prepare('INSERT INTO docteurmed(fn, ln, mb, cin, vle, rg, ad, mdp)VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $insertuser->execute(array($fn, $ln, $mb, $cin, $vle, $rg, $ad, $mdp));
        $recupuser = $bdd->prepare('SELECT * FROM docteurmed WHERE fn = ? and ln = ? and mb = ? and cin = ? and vle = ? and rg = ? and ad = ? and mdp = ?');
        $recupuser->execute(array($fn, $ln, $mb, $cin, $vle, $rg, $ad, $mdp));
        if ($recupuser->rowCount() > 0) {
            $_SESSION['fn'] = $fn;
            $_SESSION['ln'] = $ln;
            $_SESSION['mb'] = $mb;
            $_SESSION['cin'] = $cin;
            $_SESSION['vle'] = $vle;
            $_SESSION['rg'] = $rg;
            $_SESSION['ad'] = $ad;
            $_SESSION['mdp'] = $mdp;
            header('Location: d_login.php');

        }

    }else {
        echo 'veuillez complétez tout les champs';
    }
}

