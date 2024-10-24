<?php
namespace Classes;

use PDO;
use Dotenv\Dotenv;
use \Exception;
use \Throwable;

class Database {
    private $servername = 'localhost';
    private $username = 'root';
    private $dbname = 'cleaning_task';
    private $password = '';
    protected $conn;

    public function __construct() {
        $this->connection();
    }

    private function connection() {
        try {

            $this->conn =  new PDO("mysql:host={$this->servername}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "CREATE DATABASE IF NOT EXISTS {$this->dbname}";
            $this->conn->exec($sql);
            // echo "Database connection successful";

            $this->conn->exec("USE {$this->dbname}");

        } catch (PDOException $e) {
            throw new Exception('Database connection failed: ' . $e->getMessage(), $e->getCode());
            die("Database connection failed. Please try again later");
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}