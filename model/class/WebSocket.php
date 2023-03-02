<?php

class WebSocket
{
    private $clients = [];
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = Connection::getInstance()->getPDO();
    }
}
