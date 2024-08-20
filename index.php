<?php

class Request
{
    private $routes;
    public $method;
    private $body;
    private $endpoint;

    function __construct()
    {
        $this->routes = [
            "POST" => [
                '/auth' => "authUser"
            ],
            "GET" => [
                '/auth' => "authUser",
            ],
            "PUT" => [],
            "DELETE" => [],
        ];

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->endpoint = $_SERVER['REQUEST_URI'];

        $this->handleRequest();
    }

    function handleRequest()
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


        return $this->$functionName();
    }

    function authUser(){

        

    }

}

new Request();
