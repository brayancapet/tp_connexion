<?php 
// Fichier reload de guillaume
function chargerclasse($classe) {
    require_once("./class/".$classe.".php");
}
spl_autoload_register('chargerclasse');
?>