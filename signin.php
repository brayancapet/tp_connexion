<?php
session_start();
if(isset($_GET['deco'])){
  $_SESSION['auth'] = false;
  $_SESSION['user'] = [];
}


if($_SERVER['REQUEST_METHOD'] == "GET"){

  if(isset($_GET['connexion_email']) && !empty($_GET['connexion_email']) && isset($_GET['connexion_password']) && !empty($_GET['connexion_password']) ){

    for($i = 0; $i < count($_SESSION['tableau_utilisateur']); $i++){

      $error_message = "";

      if($_SESSION['tableau_utilisateur'][$i]['email'] == $_GET['connexion_email']){

       if(password_verify($_GET['connexion_password'], $_SESSION['tableau_utilisateur'][$i]['password'])){

        $_SESSION['user'][0] = $_SESSION['tableau_utilisateur'][$i];
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

<form method="get">
  <div class="mb-3">
    <?php
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