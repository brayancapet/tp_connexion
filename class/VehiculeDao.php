<?php 
class VehiculeDao {
    private $_db;

    public function __construct($db)
    {
        $this->set_db($db);
    }

    /**
     * Set the value of _db
     *
     * @return  self
     */ 
    public function set_db($_db)
    {
        $this->_db = $_db;

        return $this;
    }

    // Fonction retournant un vehicule en particulier par son id
    public function getVehicule($id) {
        $query = "SELECT * FROM vehicule WHERE id = ?";
        $stmt = $this->_db->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $donnes = $stmt->fetch(PDO::FETCH_ASSOC);
        switch ($donnes['type']) {
            case 'voiture':
                $vehicule = new Voiture($donnes);
                break;
            case 'moto':
                $vehicule = new Moto($donnes);
                break;
        }  
        return $vehicule;  
    }

    // Fonction retournant un tableau de vehicule pour un utilisateur
    public function getVehiculeByUser($id_user){
        $query = "SELECT * FROM vehicule WHERE id_user = ?";
        $stmt = $this->_db->prepare($query);
        $stmt->bindValue(1, $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $donnes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        switch ($donnes['type']) {
            case 'voiture':
                $vehicule = new Voiture($donnes);
                break;
            case 'moto':
                $vehicule = new Moto($donnes);
                break;
        }
        return $vehicule;
    }
    
    /**
     * Fonction récupérant tous les véhicules de la BDD
     * 
     * @return Array Tableau d'objet Voiture représentant tous les véhicules de la BDD
     */
    public function getAllVehicule() {
        // Tableau des vehicules instanciés à retourner
        $vehicules = [];

        // Requete pour récupérer tous les véhicules de la BDD
        $q = $this->_db->query('SELECT * FROM vehicule');
        // FetchAll du résultat sous forme de tableau associatif
        $donnes = $q->fetchAll(PDO::FETCH_ASSOC);

        // Boucle sur le résultat
        foreach ($donnes as $value) {
            // A chaque passage de boucle, on instancie soit une voiture, soit une moto
            switch ($value['type']) {
                case 'voiture':
                    $vehicule = new Voiture($value);
                    break;
                case 'moto':
                    $vehicule = new Moto($value);
                    break;
            }           
            // On push la nouvelle voiture dans le tableau à retourner
            array_push($vehicules, $vehicule);
        }
        // On retourne le tableau complété
        return $vehicules;
    }

    

    public function addVehicule($tab) {
        $query = "INSERT INTO vehicule (couleur, id_marque, modele, cylindre, puissance, nb_roue, immat, type)
        VALUES(:couleur, :id_marque, :modele, :cylindre, :puissance, :nb_roue, :immat, :type)";

        $stmt = $this->_db->prepare($query);
        $stmt->bindValue(':couleur', $tab["couleur"], PDO::PARAM_STR);
        $stmt->bindValue(':id_marque', $tab["id_marque"], PDO::PARAM_STR);
        $stmt->bindValue(':modele', $tab["modele"], PDO::PARAM_STR);
        $stmt->bindValue(':cylindre', $tab["cylindre"], PDO::PARAM_STR);
        $stmt->bindValue(':puissance', $tab["puissance"], PDO::PARAM_STR);
        $stmt->bindValue(':nb_roue', $tab["nb_roue"], PDO::PARAM_INT);
        $stmt->bindValue(':immat', $tab["immat"], PDO::PARAM_STR);
        $stmt->bindValue(':type', $tab["type"], PDO::PARAM_STR);

        $stmt->execute();
    }
    
    public function updateVehicule($tab) {
        $query = "UPDATE vehicule 
        SET couleur = :couleur, marque = :marque, modele = :modele, cylindre = :cylindre, puissance = :puissance,
        nb_roue = :nb_roue, immat = :immat, type = :type
        WHERE id = :id";
        $stmt = $this->_db->prepare($query);
        $stmt->bindValue(':couleur', $tab["couleur"], PDO::PARAM_STR);
        $stmt->bindValue(':marque', $tab["marque"], PDO::PARAM_STR);
        $stmt->bindValue(':modele', $tab["modele"], PDO::PARAM_STR);
        $stmt->bindValue(':cylindre', $tab["cylindre"], PDO::PARAM_STR);
        $stmt->bindValue(':puissance', $tab["puissance"], PDO::PARAM_STR);
        $stmt->bindValue(':nb_roue', $tab["nb_roue"], PDO::PARAM_INT);
        $stmt->bindValue(':immat', $tab["immat"], PDO::PARAM_STR);
        $stmt->bindValue(':type', $tab["type"], PDO::PARAM_STR);
        $stmt->bindValue(':id', $tab["id"], PDO::PARAM_INT);

        $stmt->execute();
    }

    public function deleteVehicule($id) {
        $query = "DELETE FROM vehicule WHERE id = ?";
        $stmt = $this->_db->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>