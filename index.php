<?php
include('includes/connexion_bdd.php');
include('autoload.php');
require_once('./class/UserDao.php');
require_once('./class/User.php');
require_once('./class/Vehicule.php');
require_once('./class/VehiculeDao.php');
session_start();

$bdd = connectDB();

// Instanciation de VehiculeDao
$vehiculeDao = new VehiculeDao($bdd);


// Recupération de mon tableau stocké
$user = unserialize($_SESSION['user']);
$tab = $vehiculeDao->getVehiculeByUser($user->getId_user());




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
    
    ?>
    <h1>Bienvenue, <?=$user->getPseudo();?></h1>
    
    <h2>Voici vos véhicules :</h2>

<table class="table">
    <thead>
        <tr>
        <th scope="col">Marque</th>
        <th scope="col">Modèle</th>
        <th scope="col">Immatriculation</th>
        <th scope="col">Véhicule</th>
        </tr>
    </thead>
    <tbody>

    <?php
    for($i = 0; $i < count($tab); $i++){
        $num_marque = $tab[$i]['id_marque'];
        
    ?>

    <tr>
      <th><?=$vehiculeDao->getMarqueById($num_marque)['marque']?></th>
      <td><?=$tab[$i]['modele']?></td>
      <td><?=$tab[$i]['immat']?></td>
      <td><?=$tab[$i]['type']?></td>
    </tr>

    <?php
    }
    ?>
    
  </tbody>
</table>
    
    
    <?php
    include('./includes/footer.php');