<?php

namespace Source\Models;

use Source\Core\Connect;

class Contact {
    private $id;
    private $name;
    private $email;
    private $message;
    private $idUser;
    private $message1;

    public function __construct(
        int $id = NULL,
         $idUser = NULL,
        string $name = NULL,
        string $email = NULL,
        string $message = NULL
        
    )
    {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
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
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

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
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of message1
     */ 
    public function getMessage1()
    {
        return $this->message1;
    }

    /**
     * Set the value of message1
     *
     * @return  self
     */ 
    public function setMessage1($message1)
    {
        $this->message1 = $message1;

        return $this;
    }

    public function insert() : bool
    {
        $query = "INSERT INTO contact (idUser, name, email, message) VALUES (:idUser, :name, :email, :message)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $_SESSION["user"]["id"]);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":message", $this->message);
        $stmt->execute();
        $this->message1 = "Mensagem enviada com sucesso! Aguarde retorno.";
        return true;
    }

    public function selectbyUser($idUser)
    {
        $query = "SELECT * FROM contact WHERE idUser = :idUser";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $idUser);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
            } else {
            return $stmt->fetchAll();
            }
    }

    public function selectAll ()
    {
        $query = "SELECT * FROM contact";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

} 