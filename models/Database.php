<?php

class Database
{
    private $severname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "mydb";
    protected $mysqli;
    protected $stmt;

    function __construct()
    {
        $this->mysqli = new mysqli($this->severname, $this->username, $this->password, $this->database);
        $this->stmt = $this->mysqli->stmt_init();

        if ($this->mysqli->connect_error) {
            die("Erro ao conectar ao banco: " . $this->mysqli->connect_error);
        }
    }
}