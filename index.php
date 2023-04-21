<?php

ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");
//$route = new Router('localhost/acme-manha', ":"); // Route para localhost

/**
 * Web Routes
 */

$route->namespace("Source\App");
$route->get("/","Web:home");
$route->get("/sobre","Web:about");
$route->get("/contato","Web:contact");
$route->get("/entrar","Web:register");
$route->post("/entrar","Web:register");

$route->post("/login","Web:login");
$route->get("/FAQ","Web:faqs");
$route->get("/produtos/{idCategory}","Web:products");


/**
 * App Routs
 */

$route->group("/app"); // agrupa em /app
$route->get("/","App:home");
$route->get("/listar","App:list");
$route->get("/pdf","App:createPDF");
$route->get("/logout","App:logout");
$route->get("/contato","App:contact");
$route->post("/contato","App:contact");
$route->get("/perfil","App:profile");
$route->post("/perfil","App:profileUpdate");
$route->get("/meusContatos","App:myContact");
$route->get("/FAQ","App:faq");
$route->get("/sobre","App:about");
$route->get("/comprar/{idProduct}/{idCategory}","App:buy");
$route->get("/delete/{idCart}","App:deleteFromCart");
$route->get("/notafiscal","App:receipt");
$route->get("/carrinho","App:cart");
$route->get("/produtos/{idCategory}","App:products");
$route->get("/produtos","App:product");




$route->group(null); // desagrupo do /app

$route->group("/adm"); // agrupa em /admin
$route->get("/","Adm:home");
$route->get("/perfil","Adm:profile");
$route->post("/perfil","Adm:profileUpdate");
$route->get("/logout","Adm:logout");
$route->get("/addProduto","Adm:productsRegister");
$route->post("/addProduto","Adm:productsRegister");
$route->get("/updateProduto","Adm:productUpdate");
$route->post("/updateProduto","Adm:productUpdatePost");
$route->get("/criarFaq","Adm:createFaq");
$route->post("/criarFaq","Adm:createFaq");
$route->get("/FAQ","Adm:faqs");
$route->get("/produtos/{idCategory}", "Adm:products");
$route->get("/sobre","Adm:about");
$route->get("/mensagens","Adm:messages");




$route->group(null); // desagrupo do /admin

/*
 * Erros Routes
 */

$route->group("error")->namespace("Source\App");
$route->get("/{errcode}", "Web:error");

$route->dispatch();

/*
 * Error Redirect
 */

if ($route->error()) {
    $route->redirect("/error/{$route->error()}");
}

ob_end_flush();