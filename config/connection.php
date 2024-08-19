<?php
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

class Connection
{
    private $connection;


    function __construct()
    {
        $this->connect();

    }

    private function connect()
    {

        $dsn = 'mysql:dbname=' . $_ENV['DBNAME'] . ';';

        try {
            $this->connection = new PDO($dsn, $_ENV['USERNAME'], $_ENV['PASSWORD']);
        } catch (\PDOException $error) {
            echo $error;
        }


    }

}


new Connection();