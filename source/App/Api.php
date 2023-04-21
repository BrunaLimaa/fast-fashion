<?php

namespace Source\App;

use Source\Models\Products;
use Source\Models\User;

class Api
{

    private $user;
    private $product;


    public function __construct()
    {
         header('Content-Type: application/json; charset=UTF-8');
        $headers = getallheaders();
        $this->user = new User();
        $this->product = new Products();
    }

    public function getUser()
    {
        if($this->user->getId() != null){
            echo json_encode($this->user->getArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }

    public function updateUser(array $data): void{

        if($this->user->getId() != null){
            
            $this->user->setName($data["name"]);
            $this->user->setDocument($data["document"]);
            $this->user->setEmail($data["email"]);
            $this->user->update();

            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Usuário alterado com sucesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;

        }

    }



    public function createUser(array $data): void {
        if($this->user->findByEmail($data["email"])){
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Por favor, informe Email e Senha!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;

        }
        
        $this->user->setName($data["name"]);
        $this->user->setEmail($data["email"]);
        $this->user->setPassword($data["password"]);
        $this->user->setType($data["type"]);
        $this->user->insert();

        $response = [
            "code" => 200,
            "type" => "success",
            "message" => "Usuário inserido com sucesso!"
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;

    }

    public function createProduct(array $data): void {
        if($this->product->findByName($data["name"])){
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Por favor, informe Email e Senha!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $this->product->setName($data["name"]);
        $this->product->setPrice($data["price"]);
        $this->product->setIdCategory($data["idCategory"]);
        $this->product->setphoto(url("https://i.ibb.co/H2BKBz1/logo-Shein.png"));
        $this->product->insertProduct();

        $response = [
            "code" => 200,
            "type" => "success",
            "message" => "Produto inserido com sucesso!"
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;


    }

    public function getProducts(array $data){
        if(!empty($data["idProduct"])){
            $product = new Products($data["idProduct"]);

            if(!$product->findById()){
                $response = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Produto não encontrado..."
                ];
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }

            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Produto encontrado...",
                "message" => [
                    "id" => $product->getId(),
                    "name" => $product->getName(),
                    "price" => $product->getPrice()
                ]
            ];

            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        }
    }


    public function getProduct(){

        $headers = getallheaders();
        $product = new Products();

        if(!$product->findByidUser($this->user->getId())){
            $response = [
                "code" => "404",
                "type" => "bad_request",
                "message" => "Usuário não possui produtos no carrinho"
            ];

            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            return;
        }

        $response = [
            "code" => 200,
            "type" => "success",
            "message" => "Produto encontrado...",
            "product" => $product->findByidUser($this->user->getId())
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }
    
    public function getAllProducts(){

        $key = "apiFastFashion";
        $headers = getallheaders();

        if ($headers["Key"] == $key) {
            $products = new Products();
            echo json_encode($products->selectAll(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe a chave de acesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
    }
}

    public function getUsers()
    {
        $key = "apiFastFashion";
        $headers = getallheaders();

        if ($headers["Key"] == $key) {
            $users = new User();
            echo json_encode($users->selectAll(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe a chave de acesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function insertUser()
    {
        $headers = getallheaders();

        if (!empty($headers)) {
            $user = new User(
                NULL,
                $headers["Email"],
                $headers["Name"],
                $headers["Password"]

            );

            $user->insert();
            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Usuário cadastrado com sucesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe todos os dados do usuário!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }
}
