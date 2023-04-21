<?php

namespace Source\Models;

use Source\Core\Connect;

class Category
{
    private $id;
    private $category;

    /**
     * @param $id
     * @param $category
     * 
     */
    public function __construct($id = null, $category = null)
    {
        $this->id = $id;
        $this->category = $category;
    }

    public function selectAll()
    {
        $query = "SELECT * FROM categories";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }
}