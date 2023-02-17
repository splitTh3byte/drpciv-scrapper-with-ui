<?php
require_once __DIR__ . '/../auth.php';

class Database
{
    private $connection;
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
//            echo "new instance!\n";
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->connection = connectToMYSQL();
    }
    

    public function getConnection()
    {
        return $this->connection;
    }
}