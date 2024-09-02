<?php

require_once __DIR__ . "/../../config/connection.php";


class Login extends Connection
{

    function __construct()
    {

        parent::__construct();

    }

    function Login($username, $password)
    {

        try {

            $sql = "SELECT id, username FROM Users WHERE username = :username and password = :password";

            $query = $this->connection->prepare($sql);
            $query->bindParam(":username", $username);
            $query->bindParam(":password", $password);


            if (!$query->execute()) {
                http_response_code(404);
                die("Erro inesperado");
            }

            if ($query->rowCount() !== 1) {
                return false;
            }

            return $query->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

}

