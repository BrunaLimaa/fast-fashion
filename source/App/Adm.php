<?php

namespace Source\App;
use League\Plates\Engine;
use Source\Models\User;
use Source\Models\faq;
use Source\Models\Category;
use Source\Models\Contact;
use Source\Models\Products;

class Adm
{
    private $view;
    private $categories;

    public function __construct()
    {

        if(empty($_SESSION["user"]) || empty($_COOKIE["user"])){
            header("location:http://www.localhost/fast-fashion/entrar");
        } 
        if($_SESSION["user"]["email"] != "bruna@gmail.com"){
            header("location:http://www.localhost/fast-fashion/entrar");
        }

        setcookie("user", $_SESSION["user"]["email"], time()+60*60, "/");

        $this->view = new Engine(CONF_VIEW_ADMIN,'php');

        $categories = new Category();
        $this->categories = $categories->selectAll();
    }

    public function home () : void
    {
        echo $this->view->render("home", ["categories" => $this->categories]);
        
    }

    public function profile (){

        $user = new User($_SESSION["user"]["id"]);
        $user->findById();

        echo $this->view->render("profile", ["user" => $user,
        "categories" => $this->categories
        ]
        
    );
    }

    public function about()
    {
        echo $this->view->render("about", ["categories" => $this->categories]); // Engine
    }

    public function messages(?array $data){

        $contact = new Contact();
        $contacts = $contact->selectAll();
         
        echo $this->view->render(
            "messages",[
            "categories" => $this->categories,
            "contact" => $contacts
            ]
            );
    }

    public function products(?array $data){

        $user = new User($_SESSION["user"]["id"]);
        $user->findById();

        if(!empty($data)){
            $product = new Products();
            $products = $product->findByCategory($data["idCategory"]);
        }

        echo $this->view->render(
            "products-adm",[
                "categories" => $this->categories,
                "products" => $products,
            ]
        );
    }

    public function productsRegister(array $data): void {

        if(!empty($data)){

            if(in_array("",$data)){
                $productJson = [
                    "message" => "Informe todos os campos!",
                    "type" => "alert-danger"
                ];
                echo json_encode($productJson);
                return;
            }

            if(!empty($_FILES['image']['tmp_name'])) {
              $upload = uploadImage($_FILES['image']);
            } else {
                $upload =  url("themes/web/images/category-1.jpg");                
            }

            $product = new Products(
                null,
                $data["name"],
                $data["price"],
                $data["idCategory"],
                $upload,
                
            );
           // $product->insertProduct();

            if(!$product->insertProduct()){

                $productJson = [
                    "message" => "Produto não Cadastrado",
                    "type" => "alert-danger"
                ];
                echo  json_encode($productJson);
                return;
            } else {

                 $productJson = [
                 "name" => $product->getName(),
                "price" => $product->getPrice(),
                 "idCatgory" => $product->getIdCategory(),
                    "image" => $product->getphoto(),
                "message" => $product->getMessage()

               ];
               echo json_encode($productJson);
                return;
        }
    }
        echo $this->view->render("product-register", 
        ["categories" => $this->categories,
        "eventName" => CONF_SITE_NAME
    ]);
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
            //unlink($_SESSION["user"]["photo"]);
        } else {
            // se não houve alteração da imagem, manda a imagem que está na sessão
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

}


public function productUpdatePost(?array $data): void {

    $product = new Products();
    $products = $product->findById($data["id"]);

    if(!empty($data)){

        if(in_array("",$data)){
            $productJson = [
                "message" => "Informe todos os campos!",
                "type" => "alert-danger"
            ];
            echo json_encode($productJson);
            return;
        }

        if(!empty($_FILES['photo']['tmp_name'])) {
            $upload = uploadImage($_FILES['photo']);
            //unlink($_SESSION["user"]["photo"]);
        } else {
            // se não houve alteração da imagem, manda a imagem que está na sessão
            $upload = $product->getphoto();
        }

        $product = new Products(
            $data["id"],
            $data["name"],
            $data["price"],
            $data["idCategory"],
            $upload
        );
        $product->update();
        $productJson = [
            "message" => $product->getMessage(),
            "type" => "alert-success",
            "name" => $product->getName(),
            "price" => $product->getprice(),
            "idCategory" => $product->getIdCategory(),
            "photo" => url($product->getphoto()),
        ];
        echo json_encode($productJson);
    }



    echo $this->view->render("product-update",[
        "categories" => $this->categories,
        "products" => $products
    ]);

}

public function productUpdate(){
    $product = new Products();
    $products = $product->selectAll();

    echo $this->view->render("product-update",[
        "categories" => $this->categories,
        "products" => $products
    ]);

}


public function logout()
{
    session_destroy();
    header("location:http://www.localhost/fast-fashion/entrar");
     
}

public function faqs()
    {
        $faq = new Faq();
        $faqs = $faq->selectAll();

        echo $this->view->render("Faq",[
            "categories" => $this->categories,
            "faqs" => $faqs
        ]);
    }

public function createFaq(array $data): void {

    if(!empty($data)){
        $data = filter_var_array($data, FILTER_DEFAULT);

        if(in_array("",$data)){
            $response = [
                "type" => "error",
                "message" => "Informe Pergunta e Resposta!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $faq = new Faq(
            $data["question"],
            $data["answer"]
        );
        $faq->insert();
        $response = [
            "type" => "success",
            "message" => $faq->getMessage()
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
    }
    echo $this->view->render("createFaq",
["categories" => $this->categories]);
}
}