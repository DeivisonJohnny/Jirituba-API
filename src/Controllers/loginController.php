<?php

require_once __DIR__ . "/../Models/Login.php";
require_once __DIR__ . "/../Services/Response.php";

class loginController extends Login 
{

    private $username;
    private $password;


    function __construct($username, $password)
    {
        parent::__construct();
        $this->username = $username;
        $this->password = $password;

    }


    function validLogin()
    {
        require_once __DIR__ . "/../Services/Token.php";

        $result = $this->Login($this->username, $this->password);


        if(!$result) {
            die(json_encode(Response::userInvalid()));
        }

        $token = new Token($result);

        die (json_encode($token->getToken()));

    }


}