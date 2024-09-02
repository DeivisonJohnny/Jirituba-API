<?php
require 'vendor/autoload.php';

use \Firebase\JWT\JWT;

class Token
{

    private $payload;
    private $token;

    function __construct($data)
    {

        $this->payload = [
            'iss' => $_ENV['TOKEN_ISS'],
            'iat' => time(),
            'exp' => time() + 60 * 5,
        ];

        $this->TokenGenerate($data);

    }

    function getToken()
    {
        return $this->token;
    }


    private function TokenGenerate($data)
    {


        $this->payload = array_merge($this->payload, ['data' => $data]);


        if (empty($_ENV['TOKEN_KEY']) or !isset($_ENV['TOKEN_KEY'])) {
            throw new Exception('Variaveis de ambiente vazia ou não configurada');
        }

        try {
            $this->token = JWT::encode($this->payload, $_ENV['TOKEN_KEY'], $_ENV['TOKEN_ALG']);

            return $this->token;

        } catch (\Throwable $th) {

            die($th);

        }

    }



}

