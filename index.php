<?php
require_once "./src/Controllers/index.php";


header('Access-Control-Allow-Origin: *');

class Request extends ManagerController
{
    private $routes;
    private $method;
    private $endpoint;

    function __construct()
    {
        $this->routes = [
            "POST" => [
                '/auth' => "authUser",
                '/login' => "login"
            ],
            "GET" => [
                '/usuario' => "getListUser",
            ],
            "PUT" => [],
            "DELETE" => [],
        ];

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->endpoint = $_SERVER['REQUEST_URI'];

        $this->handleRequest();
    }

    private function handleRequest()
    {
        if (!isset($this->routes[$this->method])) {
            http_response_code(405);
            die("Método não permitido");
        }

        if (!array_key_exists($this->endpoint, $this->routes[$this->method])) {
            http_response_code(404);
            die("Endpoint não encontrado");
        }

        $functionName = $this->routes[$this->method][$this->endpoint];

        if (!method_exists($this, $functionName) && is_callable([$this, $functionName])) {
            http_response_code(500);
            die("Erro interno do servidor");
        }



        $response = $this->$functionName($this->getBodyRequest());

    }


    private function getBodyRequest()
    {
        $body = file_get_contents('php://input');
        $data = json_decode($body, true);

        if (!json_last_error() === JSON_ERROR_NONE) {
            http_response_code(400);
        }

        return $data;

    }


}

new Request();
