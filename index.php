<?php
include('includes/connexion_bdd.php');
include('autoload.php');
session_start();


// Si session auth n'est pas défini
if(!isset($_SESSION['auth'])){
    // Alors je ne suis pas connecté
    $_SESSION['auth'] = false;
}

// Si deco est défini
if(isset($_GET['deco'])){
    // ALors je ne suis pas connecté et mon tableau user revient vide
    $_SESSION['auth'] = false;
    $_SESSION['user'] = [];
}

// Si auth est faux, 
if($_SESSION['auth'] == false){
    // Alors je suis redirigé vers la page de connexion
    header('Location: ./signin.php');
}

$titre = "Accueil";
include('./includes/header.php');

?>

<body>
    <?php
    include('./includes/nav.php');
    $user = unserialize($_SESSION['user']);
    ?>
    <h1>Bienvenue, <?=$user->getPseudo();?></h1>
    <?php
    include('./includes/footer.php');