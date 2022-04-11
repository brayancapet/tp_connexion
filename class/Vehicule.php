<?php 
abstract class Vehicule {
    private $id;
    private $couleur;
    private $marque;
    private $modele;
    private $cylindre;
    private $puissance;
    private $nb_roue;
    private $immat;
    private $type;
    private $proprietaire;

    public function __construct($valeurs = array())
    {
        foreach ($valeurs as $key => $value) {
            $method = "set".ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Get the value of couleur
     */ 
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set the value of couleur
     *
     * @return  self
     */ 
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get the value of marque
     */ 
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set the value of marque
     *
     * @return  self
     */ 
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get the value of cylindre
     */ 
    public function getCylindre()
    {
        return $this->cylindre;
    }

    /**
     * Set the value of cylindre
     *
     * @return  self
     */ 
    public function setCylindre($cylindre)
    {
        $this->cylindre = $cylindre;

        return $this;
    }

    /**
     * Get the value of puissance
     */ 
    public function getPuissance()
    {
        return $this->puissance;
    }

    /**
     * Set the value of puissance
     *
     * @return  self
     */ 
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;

        return $this;
    }

    /**
     * Get the value of nb_roue
     */ 
    public function getNb_roue()
    {
        return $this->nb_roue;
    }

    /**
     * Set the value of nb_roue
     *
     * @return  self
     */ 
    public function setNb_roue($nb_roue)
    {
        $this->nb_roue = $nb_roue;

        return $this;
    }

    /**
     * Get the value of immat
     */ 
    public function getImmat()
    {
        return $this->immat;
    }

    /**
     * Set the value of immat
     *
     * @return  self
     */ 
    public function setImmat($immat)
    {
        $this->immat = $immat;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of modele
     */ 
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set the value of modele
     *
     * @return  self
     */ 
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    public function demarrer() {
        echo "Vroom Vroom<br>";
    }

    public function accelerer() {
        echo "VROOOOOOOOOM<br>";
    }
}
?>