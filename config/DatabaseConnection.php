<?php


namespace Config;

use Dotenv\Dotenv;

class DatabaseConnection
{
    private $conn;

    public function __construct()
    {
       
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

   
        $this->conn = new \mysqli(
            $_ENV['DB_HOST'], 
            $_ENV['DB_USERNAME'], 
            $_ENV['DB_PASSWORD'], 
            $_ENV['DB_DATABASE']
        );

        if ($this->conn->connect_error) {
            throw new \Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
