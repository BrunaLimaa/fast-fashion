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

        echo $this->view->render("register");
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
            "eventName" => CONF_SITE_NAME
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

        echo $this->view->render("register"
    );

    }

}