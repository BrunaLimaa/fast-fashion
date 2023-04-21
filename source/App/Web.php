<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\User;
use Source\Models\faq;
use Source\Models\Category;
use Source\Models\Contact;
use Source\Models\Products;

class Web
{
    private $view;
    private $categories;

    public function __construct()
    {
        $categories = new Category();
        $this->categories = $categories->selectAll();
        $this->view = new Engine(CONF_VIEW_WEB,'php');
    }

    public function home() : void
    {

        echo $this->view->render("home",["categories" => $this->categories]);
    }

    public function products(?array $data) : void
    {
        if(!empty($data)){
            $product = new Products();
            $products = $product->findByCategory($data["idCategory"]);
        }
        echo $this->view->render(
            "products",[
                "categories" => $this->categories,
                "products" => $products
            ]
        );
    }

    public function about()
    {
        echo $this->view->render("about", ["categories" => $this->categories]); // Engine
    }



   public function register(?array $data) : void
    {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "Informe nome, e-mail e senha para cadastrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "Informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User(
                NULL,
                $data["name"],
                $data["email"],
                $data["password"]
            );

            if($user->findByEmail($data["email"])){
                $json = [
                    "message" => "Email já cadastrado!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }

            if(!$user->insert()){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "message" => $user->getMessage(),
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
            return;
        }

        echo $this->view->render("register",[
            "eventName" => CONF_SITE_NAME,
            "categories" => $this->categories
        ]);
    }

    public function login(?array $data1) : void
    {
        if(!empty($data1)){

            if(in_array("",$data1)){
                $json = [
                    "message" => "Informe e-mail e senha para entrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }
           

            if(!is_email($data1["email"])){
                $json = [
                    "message" => "Por favor, informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User();

            if(!$user->validate($data1["email"],$data1["password"])){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }

            $json = [
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "message" => $user->getMessage(),
                "type" => "success"
            ];
            echo json_encode($json);
            return;
        }

        echo $this->view->render("register",[
        "eventName" => CONF_SITE_NAME,
        "categories" => $this->categories]
    );

    }
    
    public function faqs()
    {
        $faq = new Faq();
        $faqs = $faq->selectAll();

        echo $this->view->render("faqs",[
            "categories" => $this->categories,
            "faqs" => $faqs
        ]);
    }


    public function contact(array $data) : void
    {
        if(!empty($data)){
            if(in_array("",$data)){
                $json = [
                    "message1" => "Informe e-mail e mensagem para enviar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $contact = new Contact(
                NULL,
                $data['name'],
                $data['email'],
                $data['message']
            );

            if(!$contact->insert()){
                $json = [
                    "message1" => $contact->getMessage1(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "message" => $data["message"],
                    "message1" => $contact->getMessage1(),
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
            return;

        }

        
        //var_dump($data);
        echo $this->view->render("contact", [
        "categories" => $this->categories,
        "eventName" => CONF_SITE_NAME]);
    }

    public function error(array $data) : void
    {
//      echo "<h1>Erro {$data["errcode"]}</h1>";
//      include __DIR__ . "/../../themes/web/404.php";
        echo $this->view->render("404", [
            "title" => "Erro {$data["errcode"]} | " . CONF_SITE_NAME,
            "error" => $data["errcode"],
            ["categories" => $this->categories]
        ]);
    }

}