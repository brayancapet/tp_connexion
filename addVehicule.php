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
// Gestion des erreurs de formulaires
$error = false;

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
    // Alors je suis redirigé vers la page de connexion
    header('Location: ./signin.php');

}

$current_user = unserialize($_SESSION['user']);
// Traitement de l'ajout du véhicule
if (isset($_POST["id_marque"])) {
    if (!empty($_POST["id_marque"]) && !empty($_POST["couleur"]) 
    && !empty($_POST["puissance"]) && !empty($_POST["cylindre"]) 
    && !empty($_POST["nb_roue"]) && !empty($_POST["immat"]) 
    && !empty($_POST["type"]) && !empty($_POST["modele"])) {
        $vehiculeDao->addVehicule($_POST);
        header("Location: ./index.php");
        
        
        
    } else {
        $error = true;
    }
}

$titre = "Ajouter un véhicule";
include('./includes/header.php');
include('./includes/nav.php');


?>


        <div class="container w-50 m-auto">
            <h1 class="m-auto">Ajout d'un véhicule</h1> 

            <form action="#" method="post">
                <?php 
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                    Veuillez remplir tous les champs
                    </div>
                <?php
                }
                ?>
                <div class="mb-3">
                    <label for="id_marque" class="form-label">Marque</label>
                    <select class="form-select" aria-label="Marque du véhicule" name="id_marque" id="id_marque">
                      <option selected>Séléctionner une marque</option>
                      
                      <?php
                      $query= 'SELECT * FROM marque';
                      $stmt= $bdd->query($query);
                      $tableau = $stmt->fetchAll(); 
                      

                       for($i = 0; $i < count($tableau); $i++){
                      ?>

                        <option value="<?=$tableau[$i]["id_marque"]?>"><?=$tableau[$i]["marque"]?></option>

                      <?php
                        }
                      ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="modele" class="form-label">Modele</label>
                    <input type="text" name="modele" class="form-control" id="modele">
                </div>
                <div class="mb-3">
                    <label for="couleur" class="form-label">Couleur</label>
                    <input type="text" name="couleur" class="form-control" id="couleur">
                </div>
                <div class="mb-3">
                    <label for="cylindre" class="form-label">Cylindre</label>
                    <input type="text" name="cylindre" class="form-control" id="cylindre">
                </div>
                <div class="mb-3">
                    <label for="puissance" class="form-label">Puissance</label>
                    <input type="text" name="puissance" class="form-control" id="puissance">
                </div>
                <div class="mb-3">
                    <label for="nb_roue" class="form-label">Roues</label>
                    <input type="number" name="nb_roue" class="form-control" id="nb_roue">
                </div>
                <div class="mb-3">
                    <label for="immat" class="form-label">Immatriculation</label>
                    <input type="text" name="immat" class="form-control" id="immat">
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type de véhicule</label>
                    <select class="form-select" name="type">
                        <option value="voiture">Voiture</option>
                        <option value="moto">Moto</option>
                        <option value="bateau">Bateau</option>
                        <option value="avion">Avion</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="hidden" name="id_user"  id="id_user" value="<?=$current_user->getId_user()?>">
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
          

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>