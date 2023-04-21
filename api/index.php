<?php

ob_start();

require __DIR__ . "/../vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(url(), ":");

$route->namespace("Source\App");

$route->get("/user","Api:getUser");

$route->put("/user/name/{name}/email/{email}/document/{document}","Api:updateUser");

$route->post("/user/type/{type}/name/{name}/email/{email}/password/{password}", "Api:createUser");

$route->get("/user/products/{idProduct}","Api:getProducts");

$route->get("/user/product","Api:getProduct");

$route->post("/user/product/name/{name}/price/{price}/idCategory/{idCategory}/photo/{photo}","Api:createProduct");

$route->get("/allproducts","Api:getAllProducts");
$route->get("/users", "Api:getUsers");
$route->post("/user/post", "Api:insertUser");


$route->dispatch();

/*
 * Error Redirect
 */

if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type " => "endpoint_not_found",
            "message" => "Não foi possível processar a requisição"
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

ob_end_flush();