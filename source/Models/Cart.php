<?php

namespace Source\Models;

use FontLib\Table\Type\name;
use Source\Core\Connect;


class Cart {

    private $idCart;
    private $idUser;
    private $idProduct;

    


/**
* Get the value of id
*
* @return  mixed
*/
public function getId()
{
return $this->idCart;
}

/**
* Set the value of id
*
* @param   mixed  $id  
*
* @return  self
*/
public function setId($idCart)
{
$this->idCart = $idCart;
return $this;
}

/**
* Get the value of idUser
*
* @return  mixed
*/
public function getIdUser()
{
return $this->idUser;
}

/**
* Set the value of idUser
*
* @param   mixed  $idUser  
*
* @return  self
*/
public function setIdUser($idUser)
{
$this->idUser = $idUser;
return $this;
}

/**
* Get the value of idProduct
*
* @return  mixed
*/
public function getIdProduct()
{
return $this->idProduct;
}

/**
* Set the value of idProduct
*
* @param   mixed  $idProduct  
*
* @return  self
*/
public function setIdProduct($idProduct)
{
$this->idProduct = $idProduct;
return $this;
}

public function __construct( 

    int $idCart = NULL,
    int $idUser = NULL,
    int $idProduct = NULL
)
{
    $this->idCart = $idCart;
    $this->idUser = $idUser;
    $this->idProduct = $idProduct;
}

public function selectByIdUser($idUser){
    $query = "SELECT * 
    FROM cart 
    JOIN products ON cart.idProduct = products.id
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
 
public function selectAll ()
{
    $query = "SELECT * FROM cart WHERE id = ".$_SESSION["user"]["id"]."";
    $stmt = Connect::getInstance()->prepare($query);
    $stmt->execute();

    if($stmt->rowCount() == 0){
        return false;
    } else {
        return $stmt->fetchAll();
    }
}

public function insert($idUser, $idProduct){
    $query = "INSERT INTO `cart`(idCart, idUser, idProduct) VALUES (NULL, :idUser, :idProduct)";
    $stmt = Connect::getInstance()->prepare($query);
    $stmt->bindParam(":idUser", $_SESSION["user"]["id"]);
    $stmt->bindParam(":idProduct", $idProduct);
    $stmt->execute();
    return true;
    }


   public function deleteProduct($idCart){
    $query = "DELETE FROM cart WHERE idCart = :idCart";
    $stmt = Connect::getInstance()->prepare($query);
    $stmt->bindParam(":idCart", $idCart);
    $stmt->execute();

    return true;

   } 
}