<?php

namespace Source\App;

use Dompdf\Dompdf;
use League\Plates\Engine;
use Source\Models\Cart;
use Source\Models\User;
use Source\Models\Category;
use Source\Models\faq;
use Source\Models\Contact;
use Source\Models\Products;


class App
{
    private $view;
    private $categories;

    public function __construct()
    {

        if(empty($_SESSION["user"]) || empty($_COOKIE["user"])){
            header("location:http://www.localhost/fast-fashion/entrar");
        }

        setcookie("user", $_SESSION["user"]["email"], time()+60*60, "/");

        $this->view = new Engine(CONF_VIEW_APP,'php');

        $categories = new Category();
        $this->categories = $categories->selectAll();
    }

    public function home () : void
    {
        echo $this->view->render("home", ["categories" => $this->categories]);
        
    }

    public function products(array $data) : void
    {
        if(!empty($data)){
            $product = new Products();
            $products = $product->findByCategory($data["idCategory"]);
        }
        echo $this->view->render(
            "products-app",[
                "categories" => $this->categories,
                "products" => $products,
            ]
        );
    }

    public function product(): void {

        $product = new Products();
        $products =  $product->selectAll();
      
        echo $this->view->render(
            "products",
             ["categories" => $this->categories,
            "products" => $products]);
    }

    public function receipt(){
        $user = new User($_SESSION["user"]["id"]);
        $user->findById();
        $cart = new Cart();
        $carts = $cart->selectByIdUser($_SESSION["user"]["id"]);
        echo $this->view->render(
            "Receipt",
             ["categories" => $this->categories,
             "carts" => $carts,
            "user" => $user ]);
    }


    public function cart(){
        $cart = new Cart();
        $carts = $cart->selectByIdUser($_SESSION["user"]["id"]);

        //echo "olá";
        echo $this->view->render("Cart", [
        "categories" => $this->categories,
        "carts" => $carts 
        ]);

    }

    public function deleteFromCart($data){
        $cart = new Cart();
        $cart->deleteProduct($data["idCart"]);

        header("location:http://www.localhost/fast-fashion/app/carrinho");
    }

    
    public function myContact (){
        $contact = new Contact();
        $contacts = $contact->selectbyUser($_SESSION["user"]["id"]);

        echo $this->view->render("myContact", [
            "categories" => $this->categories,
            "eventName" => CONF_SITE_NAME,
            "contacts" => $contacts
        ]);
    }

    public function buy(array $data)
    {


        $cart = new Cart();
        $cart->insert(
            $_SESSION["user"]["id"],
            $data["idProduct"]
        );
        

        $product = new Products();
        $product->findById();
        
        header("location:http://www.localhost/fast-fashion/app/produtos/{$data["idCategory"]}");
    }

    public function about()
    {
        echo $this->view->render("about", ["categories" => $this->categories]); // Engine
    }


    public function profile (){

        $user = new User($_SESSION["user"]["id"]);
        $user->findById();

        echo $this->view->render("profile", ["user" => $user,
        "categories" => $this->categories
        ]
        
    );
    }

    public function profileUpdate (?array $data): void {

        if(!empty($data)){

            if(in_array("",$data)){
                $userJson = [
                    "message" => "Informe todos os campos!",
                    "type" => "alert-danger"
                ];
                echo json_encode($userJson);
                return;
            }

            if(!empty($_FILES['photo']['tmp_name'])) {
                $upload = uploadImage($_FILES['photo']);
            } else 
                $upload = $_SESSION["user"]["photo"];
            }

            $user = new User(
                $_SESSION["user"]["id"],
                $data["name"],
                $data["email"],
                null ,
                null,
                $upload
            );
            $user->update();
            $userJson = [
                "message" => $user->getMessage(),
                "type" => "alert-success",
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "photo" => url($user->getPhoto())
            ];
            echo json_encode($userJson);
        }



    public function faq()
    {
        $faq = new Faq();
        $faqs = $faq->selectAll();

        echo $this->view->render("faqs",[
            "categories" => $this->categories,
            "faqs" => $faqs
        ]);
    }

    

    public function logout()
    {
        session_destroy();
        header("location:http://www.localhost/fast-fashion/entrar");
         
    }

  
    public function contact(array $data) : void
    {
        if(!empty($data)){
            if(in_array("",$data)){
                $json = [
                    "message1" => "Informe todos os campos!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $contact = new Contact(
                NULL,
                $_SESSION["user"]["id"],
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
                    "idUser" => $_SESSION["user"]["id"],
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


    


}