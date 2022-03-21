<?php
session_start();

if(isset($_GET['deco'])){
    $_SESSION['auth'] = false;
    $_SESSION['user'] = [];
}

if($_SESSION['auth'] == false){
    header('Location: ./signin.php');
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['email']) && !empty($_POST['email']) &&isset($_POST['password']) && !empty($_POST['password']) ){
  
      if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  
        $mailValid = true;
        
        
        if($_POST['email'] == $_SESSION['user'][0]['email']){
           
          

        } else {

          for($i = 0; $i < count($_SESSION['tableau_utilisateur']); $i++){

            if(in_array($_POST['email'], $_SESSION['tableau_utilisateur'][$i])){
    
              $mailValid = false;
              $error_message = "Adresse mail déjà utilisée";
              break;
      
            }

          }

        }
  
      } else {
  
        $mailValid = false;
        $error_message = "Veuillez saisir une adresse mail valide";
  
      }
  
      if($mailValid == true){
  
        if($_POST['password'] === $_POST['confirm_password']){
  
          for($i = 0; $i < count($_SESSION['tableau_utilisateur']); $i++){

            if($_SESSION['user'][0]['email'] == $_SESSION['tableau_utilisateur'][$i]['email']){

              // splice $i
              array_splice($_SESSION['tableau_utilisateur'], $i);

            }

          }

          $mot2passe = password_hash($_POST['password'], PASSWORD_DEFAULT);
          $new = [ "pseudo" => $_POST['pseudo'], "email" => $_POST['email'], "password" => $mot2passe];
          $_SESSION['tableau_utilisateur'][] = $new;
          $_SESSION['user'][0] = $new;
          header('Location: ./index.php'); 


    
        } else {
          $error_message = "Veuillez entrer des mdp correspondants";
        }
  
      }
  
    }else {
      $error_message = "Veuillez remplir les champs";
    }
  
} 

$titre = "Mon profil";
include('./includes/header.php');

?>

<body>
    <?php
    include('./includes/nav.php');
    echo "Bienvenue " . $_SESSION['user'][0]['pseudo'] . " !" . "<br>";

    echo "Modifier votre profil :";
    if(isset($error_message) && !empty($error_message)){
      echo "<div class='alert alert-danger' role='alert'>
      $error_message
    </div>";
    }
    ?>
    
    <form method="POST">
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" value="<?php echo $_SESSION['user'][0]['pseudo'] ?>" name="pseudo">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" value="<?php echo $_SESSION['user'][0]['email'] ?>" name="email">
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