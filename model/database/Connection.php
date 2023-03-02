<?php

class Connection
{
    private static $instance = null;
    private $PDO;

    private function __construct()
    {
        $connect = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET;
        $this->PDO = new PDO($connect, DB_USER, DB_PASS);
        $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): Connection
    {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function getPDO(): PDO
    {
        return $this->PDO;
    }
}
