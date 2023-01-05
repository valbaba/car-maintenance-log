<?php

class UserGarage
{
    private $conn;

    public function construct()
    {
        $this->conn = (new Database)->getConn();
    }

    public function addVehicule($vehicule_brand, $vehicule_model, $vehicule_year, $vehicule_immatriculation, $vehicule_owner_id) {

    }
}