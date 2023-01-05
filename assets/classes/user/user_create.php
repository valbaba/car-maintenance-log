<?php

class CreateUser
{
    public $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConn();
    }

    public function createUser($email, $password)
    {
        $login = explode("@", $email)[0];
        $sql = "INSERT INTO user (email, login, password) VALUES ('$email', '$login','$password')";
        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return 1;
        }
    }

    private function getUserIdByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            return $row["id"];
        }
    }

    public function addUserInfos($firstname, $lastname, $country, $city, $street, $postal_code)
    {
        $user_id = $this->getUserIdByEmail($_SESSION["email"]);
        $this->setFirstname($firstname, $user_id);
        $this->setLastname($lastname, $user_id);
        $this->setCountry($country, $user_id);
        $this->setCiy($city, $user_id);
        $this->setStreet($street, $user_id);
        $this->setPostalCode($postal_code, $user_id);
    }

    public function setFirstname($firstname, $user_id)
    {
        $sql = "INSERT INTO user_meta (user_id, meta_key, meta_data) VALUES ($user_id, 'firstname', $firstname)";
        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return 1;
        }
    }

    public function setLastname($lastname, $user_id)
    {
        $sql = "INSERT INTO user_meta (user_id, meta_key, meta_data) VALUES ($user_id, 'lastname', $lastname)";
        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return 1;
        }
    }

    public function setCountry($country, $user_id)
    {
        $sql = "INSERT INTO user_meta (user_id, meta_key, meta_data) VALUES ($user_id, 'country', $country)";
        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return 1;
        }
    }

    public function setCiy($city, $user_id)
    {
        $sql = "INSERT INTO user_meta (user_id, meta_key, meta_data) VALUES ($user_id, 'city', $city)";
        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return 1;
        }
    }

    public function setStreet($street, $user_id)
    {
        $sql = "INSERT INTO user_meta (user_id, meta_key, meta_data) VALUES ($user_id, 'street', $street)";
        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return 1;
        }
    }

    public function setPostalCode($postal_code, $user_id)
    {
        $sql = "INSERT INTO user_meta (user_id, meta_key, meta_data) VALUES ($user_id, 'postal_code', $postal_code)";
        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return 1;
        }
    }


}