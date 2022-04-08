<?php
class User {
    private $id;
    private $email;
    private $pseudo;
    private $password;

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
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     * 
     * @return self
     */
    public function setId($id)
    {
        return $this->id = $id;
        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     * 
     * @return self
     */
    public function setEmail($email)
    {
        return $this->email = $email;

        return $this;
    }

    /**
     * Get the value of pseudo
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     * 
     * @return self
     */
    public function setPseudo($pseudo)
    {
        return $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     * 
     * @return self
     */
    public function setPassword($password)
    {
        return $this->password = $password;

        return $this;
    }
    
}