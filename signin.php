<?php
include('includes/connexion_bdd.php');
require_once('./class/User.php');
require_once('./class/UserDao.php');
include('autoload.php');
session_start();

$bdd = connectDB();
$userDao = new UserDao($bdd);
$tab = $userDao->getAll();

if(isset($_GET['deco'])){
  $_SESSION['auth'] = false;
  $_SESSION['user'] = [];
}

// Si ma methode est GET
if($_SERVER['REQUEST_METHOD'] == "GET"){

  // Si connexion email est set et rempli et pareil pour password
  if(isset($_GET['connexion_email']) && !empty($_GET['connexion_email']) && isset($_GET['connexion_password']) && !empty($_GET['connexion_password']) ){

    // Loop sur mes utilisateurs
    for($i = 0; $i < count($tab); $i++){

      $error_message = "";

      // Si le mail du form correspond à celui d'un utilisateur
      if($tab[$i]->getEmail() == $_GET['connexion_email']){
        
        // Si le mdp correspond au mdp de l'adresse mail
       if(password_verify($_GET['connexion_password'], $tab[$i]->getPassword())){

        // Je suis connecté et mes infos sont stockés dans un tableau
        $user = new User($tab[$i]);
        

        $_SESSION['user'] = serialize($user);
        $_SESSION['auth'] = true;
        header('Location: ./index.php');

       } else {

        $error_message = "Mot de passe incorrect";
        break;

       }
      
      } else {

        $error_message = "Adresse mail incorrect";

      }

    }

  } else {

    $error_message = "Veuillez remplir les champs.";
    
  }


}

$titre = "Connexion";
include('./includes/header.php');
?>

<body>
    <?php
    include('./includes/nav.php');
    echo "<h1>Se connecter</h1>";
    ?>

<!-- Form connexion -->
<form method="get">
  <div class="mb-3">
    <?php
      // Si un message d'erreur est stocké dans ma variable erreur, alors je l'invoque
      if(isset($error_message) && !empty($error_message)){
        echo "<div class='alert alert-danger' role='alert'>
        $error_message
      </div>";
      }

    ?>
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="connexion_email">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="connexion_password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<h5>Vous n'avez pas de compte? <a href="./signup.php">Inscrivez-vous</a></h5>
    


<?php
    include('./includes/footer.php');