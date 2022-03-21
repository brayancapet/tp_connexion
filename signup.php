<?php
session_start();
if(isset($_GET['deco'])){
  $_SESSION['auth'] = false;
  $_SESSION['user'] = [];
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

  if(isset($_POST['email']) && !empty($_POST['email']) &&isset($_POST['password']) && !empty($_POST['password']) ){

    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

      $mailValid = true;
      for($i = 0; $i < count($_SESSION['tableau_utilisateur']); $i++){
      
        if(in_array($_POST['email'], $_SESSION['tableau_utilisateur'][$i])){
  
          $mailValid = false;
          $error_message = "Adresse mail déjà utilisée";
          break;
  
        }
  
      }

    } else {

      $mailValid = false;
      $error_message = "Veuillez saisir une adresse mail valide";

    }

    if($mailValid == true){

      if($_POST['password'] === $_POST['confirm_password']){

        $mot2passe = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $_SESSION['tableau_utilisateur'][] = ["email" => $_POST['email'], "password" => $mot2passe , "pseudo" => htmlspecialchars($_POST['pseudo'])];
        header('Location: ./index.php');
  
      } else {
        $error_message = "Veuillez entrer des mdp correspondants";
      }

    }

  }else {
    $error_message = "Veuillez remplir les champs";
  }

} 

$titre = "S'inscrire";
include('./includes/header.php');
?>

<body>
    <?php
    include('./includes/nav.php');
    echo "<h1>Enregistrement</h1>";

    
      if(isset($error_message) && !empty($error_message)){
        echo "<div class='alert alert-danger' role='alert'>
        $error_message
      </div>";
      }

    ?>

<form method="POST">
  <div class="mb-3">
    <label for="pseudo" class="form-label">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" name="pseudo">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="confirm_password" class="form-label">Confirm password</label>
    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    


<?php
    include('./includes/footer.php');