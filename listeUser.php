<?php
include('includes/connexion_bdd.php');
include('autoload.php');
require_once('./class/User.php');
require_once('./class/UserDao.php');

session_start();

// Connexion à ma bdd
$bdd = connectDB();
// Instanciation d'un objet UserDao
$userDao = new UserDao($bdd);
// Recupération de mon tableau stocké
$user = unserialize($_SESSION['user']);

// Si deco est set alors je ne suis pas connecté et mon tableau de l'utilisateur actif est vide puisque aucun utilisateur est connecté, redirection vers connexion
if(isset($_GET['deco'])){
    $_SESSION['auth'] = false;
    $_SESSION['user'] = [];
    header('Location: ./signin.php');
}

// Auth est faux alors je suis redirigé vers la connexion
if($_SESSION['auth'] == false){
  header('Location: ./signin.php');
}

$titre = "Liste utilisateurs";
include('./includes/header.php');

include('./includes/nav.php');



// Traitement du formulaire de suppression
if(isset($_GET['supprimer'])) {

  // Suppression de l'utilisateur
  $userDao->delete($_GET['supprimer']);
  header('Location: ./signin.php');

}
// Récupération du tableau utilisateur à jour
$tab = $userDao->getAll();

?>

<body>
    <h1>Détails de votre compte</h1>

    <form action="#" method="GET">
    <table class="table">
    <thead>
    <tr>
      <th scope="col">Mail</th>
      <th scope="col">Pseudo</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php
            echo "<tr>
            <td>{$user->getEmail()}</td>
            <td>{$user->getPseudo()}</td>
            <td><button class='btn btn-danger' name='supprimer' type='submit' value='{$user->getId_user()}' >Supprimer</button></td>
          </tr>";
    ?>

  </tbody>
</table>

    </form>

<?php
include('./includes/footer.php');
    