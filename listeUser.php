<?php
session_start();
if(isset($_GET['deco'])){
    $_SESSION['auth'] = false;
    $_SESSION['user'] = [];
}

$titre = "Liste utilisateurs";
include('./includes/header.php');

include('./includes/nav.php');

if(isset($_POST['supprimer'])){

    $supprimer = $_POST['supprimer'];
   
    for($i = 0; $i < count($_SESSION['tableau_utilisateur']); $i++){

        if($supprimer == $_SESSION['tableau_utilisateur'][$i]['email']){

            array_splice($_SESSION['tableau_utilisateur'], $i, 1);

        }

    }


}

?>

<body>
    <h1>Liste de vos utilisateurs</h1>

    <?php
        // var_dump($_SESSION['tableau_utilisateur']);
    ?>

    <form method="post">
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


        for($i = 0; $i < count($_SESSION['tableau_utilisateur']); $i++){

           

            echo "<tr>
            <td>{$_SESSION['tableau_utilisateur'][$i]['email']}</td>
            <td>{$_SESSION['tableau_utilisateur'][$i]['pseudo']}</td>
            <td><button class='btn btn-danger' name='supprimer' type='submit' value='{$_SESSION['tableau_utilisateur'][$i]['email']}' >Supprimer</button></td>
          </tr>";

        }

    ?>

  </tbody>
</table>

    </form>

<?php
include('./includes/footer.php');
    