<?php

class ConnectDB
{
    private static $instance = null;
    private $conn;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db_name = 'apachish';

    private function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name};", $this->user, $this->pass);
    }

    /**
     * @return null
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            echo "create instance \n";
            self::$instance = new ConnectDB();
        }

        return self::$instance;
    }


    public function getConnection(): PDO
    {
        return $this->conn;
    }
}

$instance = ConnectDB::getInstance();
var_dump($instance->getConnection());

$instance1 = ConnectDB::getInstance();
var_dump($instance1->getConnection());

$instance2 = ConnectDB::getInstance();
var_dump($instance2->getConnection());



