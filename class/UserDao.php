<?php
class UserDao {
    private $_db;

    public function __construct($db)
    {
        $this->set_db($db);
    }

    /**
     * Set the value of _db
     * 
     * @return self
     */
    public function set_db($_db)
    {
        $this->_db = $_db;

        return $this;
    }

    /**
     * Fonction servant à ajouter un utilisateurs dans la bdd
     * 
     * @param User $user
     */
    public function add(User $user)
    {
        $q = $this->_db->prepare('INSERT INTO user (email, pseudo, password) VALUES (:email, :pseudo, :password)');
        
        $q->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $q->bindValue(':pseudo', $user->getPseudo(), PDO::PARAM_STR);
        $q->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);

        $q->execute();
    }

    /**
     * Fonction servant à mettre à jour un utilisateur
     * 
     * @param User $user
     * @return void
     */
    public function update(User $user)
    {
        $q = $this->_db->prepare('UPDATE user 
        SET email = :email, pseudo = :pseudo, password = :password
        WHERE id = :id');
        $q->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $q->bindValue(':pseudo', $user->getPseudo(), PDO::PARAM_STR);
        $q->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $q->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $q->execute();
    }

    /**
     * Fonction servant à supprimer un utilisateur
     * 
     * @param Int $id_user
     * @return void
     */
    public function delete(Int $id_user) {
        $this->_db->exec('DELETE FROM user WHERE id = '.$id_user);
    }

    /**
     * Fonction servant à récupérer tous les utilisateurs de la table user
     * 
     * @return User[] Un tableau indexé contenants des objets user
     */
    public function getAll() {
        $q = $this->_db->query('SELECT * FROM user');

        return $q->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    /**
     * Fonction servant à récupérer un utilisateur en particulier
     * 
     * @param int $id_user
     * @return User
     */
    public function get($id_user) {
        $id_user = (int) $id_user;
        $q = $this->_db->query('SELECT * FROM user WHERE id ='.$id_user);

        return $q->fetchObject(User::class);
    }
}
?>