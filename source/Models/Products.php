<?php

namespace Source\Models;

use FontLib\Table\Type\name;
use Source\Core\Connect;

class Products
{
    private $id;
    private $name;
    private $price;
    private $idCategory;
    private $photo;
    private $message;
    private $type;
    private $update_at;

    public function __construct(
        $id = NULL,
        $name = null,
        $price = null,
        $idCategory = null,
        $photo = NULL
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->idCategory = $idCategory;
        $this->photo = $photo;
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
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function setphoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of photo
     */ 
    public function getphoto()
    {
        return $this->photo;
    }
 
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
     * Set the value of idCategory
     *
     * @return  self
     */ 
    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;

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

    public function insertProduct(){
        $query = "INSERT INTO products(name, price, idCategory, photo, type, update_at) VALUES (:name, :price, :idCategory,:photo,'', '2023-01-19 05:15:54')";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name" , $this->name);
        $stmt->bindParam(":price" , $this->price);
        $stmt->bindParam(":idCategory" , $this->idCategory);
        $stmt->bindParam(":photo" , $this->photo);

        $stmt->execute();

        $this->message = "Produto Inserido com Sucesso!";

        return true;
        
    }

    public function selectAll ()
    {
        $query = "SELECT name, price, idCategory FROM products";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function findByCategory($idCategory)
    {
        $query = "SELECT * FROM products WHERE idCategory = :idCategory";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idCategory",$idCategory);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function getArray() : array
    {
        return ["product" => [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "idCategory" => $this->getIdCategory(),
            "photo" => $this->getphoto()
        ]];
    }

    public function findById()
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            $product = $stmt->fetch();
            $this->name = $product->name;
            $this->price = $product->price;
            return true;
        }
    }

    public function findByidUser(int $idUser)
    {
        $query = "SELECT * 
                  FROM products 
                  JOIN cart ON products.id = cart.idProduct 
                  JOIN categories ON products.idCategory = categories.id
                  WHERE cart.idUser = :idUser";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $idUser);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }

    }

    public function update(){
        $query = "UPDATE products SET name = :name, price = :price, idCategory = :idCategory, photo = :photo, type = '' WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);

        $stmt->bindParam(":id",$this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":idCategory", $this->idCategory);
        $stmt->bindParam(":photo", $this->photo);

        $this->message = "Produto Atualizado com Sucesso!";

        $stmt->execute();
    }

}