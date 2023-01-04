<?php

class Database{
    public $conn;

    function __construct()
    {
        $servername = "localhost:3307";
        $username = "pma";
        $password = "";

// Create connection
        $this->conn = new mysqli($servername, $username, $password);

// Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
//        echo "Connected successfully";

    }
}