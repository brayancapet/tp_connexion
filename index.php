<?php
session_start();


if(!isset($_SESSION['auth'])){
    $_SESSION['auth'] = false;
}

if(isset($_GET['deco'])){
    $_SESSION['auth'] = false;
    $_SESSION['user'] = [];
}

if($_SESSION['auth'] == false){
    header('Location: ./signin.php');
}

if(isset($_SESSION['tableau_utilisateur'])){
    $tab = $_SESSION['tableau_utilisateur'];
} else {
    $tab = [
    ];

    $_SESSION['tableau_utilisateur'] = $tab;
}

$titre = "Accueil";
include('./includes/header.php');

?>

<body>
    <?php
    include('./includes/nav.php');
    echo "Bienvenue " . $_SESSION['user'][0]['pseudo'] . " !";
    
    include('./includes/footer.php');