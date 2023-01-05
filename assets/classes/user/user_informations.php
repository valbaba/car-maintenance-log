<?php

class User
{
    private $conn;
    public $firstname;
    public $lastname;
    public $city;
    public $country;
//    public $dob;
    public $street;
    public $email;
    public $postal_code;
    public $user_id;

    /**
     * @param $conn
     * @param $firstname
     * @param $lastname
     * @param $city
     * @param $country
     * @param $street
     * @param $email
     * @param $postal_code
     * @param $user_id
     */
    public function __construct($firstname, $lastname, $city, $country, $street, $email, $postal_code, $user_id)
    {
        $this->conn = (new Database())->getConn();
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->city = $city;
        $this->country = $country;
        $this->street = $street;
        $this->email = $email;
        $this->postal_code = $postal_code;
        $this->user_id = $user_id;
    }

    public function __construct1(){

    }



    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }


}