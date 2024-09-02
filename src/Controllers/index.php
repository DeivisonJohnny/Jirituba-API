<?php

class ManagerController
{


    protected function authUser($json)
    {
        require_once "./src/Controllers/authController.php";
        require_once "./config/firebase.php";
        $authUser = new AuthController();

        if (!isset($json['username']) or !isset($json['password']) or empty($json['username']) or empty($json['password'])) {
            http_response_code(400);
            die("Dados vazios ");
        }

        return false;

    }

    protected function login($json)
    {
        require_once __DIR__ . "/loginController.php";

        if (!isset($json['username']) or !isset($json['password']) or empty($json['username']) or empty($json['password'])) {
            http_response_code(400);
            die("Dados vazios ");
        }

        $loginController = new loginController($json['username'], $json['password']);

        $loginController->validLogin();

    }



    protected function getListUser()
    {
        echo "getLIstUser chamado";
    }


}



































