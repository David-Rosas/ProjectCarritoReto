<?php

namespace Core;

use PDO;

/**
 * Connection
 */
class Connection
{
    // Hosting
    private $host = "localhost";
    // DataBase Name
    private $dbname = "marketplace";
    // DataBase User
    private $user = "root";
    // DataBase Password
    private $password = "";
    // ChartSet
    private $charset = "utf8";
    // Connection
    private $connection = null;

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * Get Database Connection
     */
    public function getConnection(): PDO
    {
        try {
            $this->connection = new \PDO("mysql:host=$this->host; dbname=$this->dbname", $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec("SET CHARACTER SET $this->charset");
            return $this->connection;
        } catch (Exception $expcetion) {
            echo "Exception <<Error>>: " . $expcetion->getMessage();
        } finally {
            $this->conexion = null;
        }
    }
}
