<?php
// Autochargement des classes
require_once("./autoload.php");
// Connexion à la base de données
require_once('./includes/connexion_bdd.php');

require_once('./class/UserDao.php');
require_once('./class/User.php');
require_once('./class/Vehicule.php');
require_once('./class/VehiculeDao.php');

session_start();
$bdd = connectDB();

// Instanciation de VehiculeDao
$vehiculeDao = new VehiculeDao($bdd);

include('./includes/header.php');
include('./includes/nav.php');
?>





<?php
include('./includes/footer.php');