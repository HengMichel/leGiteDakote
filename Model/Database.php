<?php

namespace Model;

class Database
{
    // connexion à la base de données
    private $host = "localhost";
    private $db_name = "gite_db";
    private $username = "root";
    private $password = "";
    private $connection = null;

    public function dbConnect()
    {
        try {
            $this->connection = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            
        } catch (\PDOException $exception) {
            echo "Erreur de connetion : " . $exception->getMessage();
            
        }

        return $this->connection;
    }
}