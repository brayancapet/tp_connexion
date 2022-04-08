<?php
include('includes/connexion_bdd.php');
require_once('./class/User.php');
require_once('./class/UserDao.php');
include('autoload.php');
session_start();

$bdd = connectDB();
$userDao = new UserDao($bdd);
$tab = $userDao->getAll();
$user = unserialize($_SESSION['user']);

// Si déco est set alors je suis pas connecté et personne ne l'est
if(isset($_GET['deco'])){
    $_SESSION['auth'] = false;
    $_SESSION['user'] = [];
}

// Si je ne suis pas connecté, redirection vers l'interface de connexion
if($_SESSION['auth'] == false){
    header('Location: ./signin.php');
}

// si jamais la requete est POST
if($_SERVER['REQUEST_METHOD'] == "POST"){

  // si le champ email est envoyé et rempli, ainsi que le pour le mot de passe
  if(isset($_POST['email']) && !empty($_POST['email']) &&isset($_POST['password']) && !empty($_POST['password']) ){
  
    // Si le format de l'email est valide
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  
      // Email validée
      $mailValid = true;
        
        // Si l'email saisi dans la form correspond à celui de l'utilisateur connecté 
        if($_POST['email'] == $user->getEmail()){
           
          

        } else {

          // Loop sur mes utilisateurs
          for($i = 0; $i < count($tab); $i++){

            // Si le mail est identique à celui d'un autrre utilisateur
            if($_POST['email'] == $tab[$i]->getEmail()){
    
              // mail non valide, déjà utilisé
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
  
      // Si l'adresse mail est valide
      if($mailValid == true){
  
        // Si mdp et confirmer mdp correspondent
        if($_POST['password'] === $_POST['confirm_password']){

          $mot2passe = password_hash($_POST['password'], PASSWORD_DEFAULT);
          
          // On met à jour l'objet User
          $user->setEmail($_POST['email']);
          $user->setPseudo($_POST['pseudo']);
          $user->setPassword($mot2passe);

          // On stock les nouvelles infos dans la session user
          $_SESSION['user'] = serialize($user);

          // On update l'utilisateur
          $userDao->update($user);

          // On redirige vers index.php
          header('Location: ./index.php'); 


    
        } else {

          $error_message = "Veuillez entrer des mdp correspondants";

        }
  
      }
  
    } else {

      $error_message = "Veuillez remplir les champs";

  }
  
} 

$titre = "Mon profil";
include('./includes/header.php');

?>

<body>
    <?php
    include('./includes/nav.php');
    echo "Bienvenue " . $user->getPseudo() . " !" . "<br>";

    echo "Modifier votre profil :";
    if(isset($error_message) && !empty($error_message)){
      echo "<div class='alert alert-danger' role='alert'>
      $error_message
    </div>";
    }
    ?>
    
    <!-- Form, modification de mon profil -->
    <form method="POST">
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" value="<?php echo $user->getPseudo(); ?>" name="pseudo">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" value="<?php echo $user->getEmail(); ?>" name="email">
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