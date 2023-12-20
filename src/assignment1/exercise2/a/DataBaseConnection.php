<?php

namespace AndresZeballos\RaintreeHomework\assignment1\exercise2\a;

class DatabaseConnection
{
    private $host;
    private $username;
    private $password;
    private $database;

    private $conn;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function getConnection(): \mysqli
    {
        $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_errno) {
            throw new \Exception('Failed to connect to MySQL: '.$this->conn->connect_error);
        }

        return $this->conn;
    }

    public function closeConnection()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
