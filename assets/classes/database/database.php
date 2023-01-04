<?php

class Database{
    public $conn;

    function __construct()
    {
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $database = "garage";

// Create connection
        $this->conn = new mysqli($servername, $username, $password, $database);

// Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
//        echo "Connected successfully";

    }

    /**
     * @return mysqli
     */
    public function getConn()
    {
        return $this->conn;
    }


}