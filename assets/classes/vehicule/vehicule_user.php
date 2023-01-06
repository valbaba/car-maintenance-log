<?php

/**
 *
 */
class vehiculeUser
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConn();
    }

    /**
     * @param $fleet_id
     * @return array
     */
    public function getUserVehiculesByFleetId($fleet_id)
    {
        $sql = "SELECT * FROM vehicules where fleet_id='$fleet_id'";
        $result = $this->conn->query($sql);
        $fleet_ids = [];
        while ($row = $result->fetch_assoc()) {
            $fleet_ids[] = $row["id"];
        }
        return $fleet_ids;
    }

    /**
     * @param $fleet_id
     * @return array
     */
    public function getUserVehiculesMetaByFleetId($fleet_id)
    {
        $sql = "SELECT * FROM vehicules_meta";
        $result = $this->conn->query($sql);
        $vehicules = [];
        while ($row = $result->fetch_assoc()) {
            $meta_key = $row["meta_key"];
            $vehicules[]["$meta_key"] = $row["meta_data"];
        }
        return $vehicules;
    }

    /**
     * @param $fleet_id
     * @param $vehicule_model
     * @param $vehicule_brand
     * @param $vehicule_year
     * @param $vehicule_energy
     * @param $vehicule_owner_id
     * @param $vehicule_type
     * @return int|string
     */
    public function newVehicule($fleet_id, $vehicule_model, $vehicule_brand, $vehicule_year, $vehicule_energy, $vehicule_owner_id, $vehicule_type)
    {
        $sql = "INSERT INTO vehicules (fleet_id) VALUES ('$fleet_id')";
        if ($this->conn->query($sql) === TRUE) {
            $vehicule_id = $this->conn->insert_id;
            $sql = "INSERT INTO vehicules_meta (vehicule_id, meta_key, meta_data) VALUES ('$vehicule_id', 'brand', '$vehicule_brand');";
            $sql .= "INSERT INTO vehicules_meta (vehicule_id, meta_key, meta_data) VALUES ('$vehicule_id', 'model', '$vehicule_model');";
            $sql .= "INSERT INTO vehicules_meta (vehicule_id, meta_key, meta_data) VALUES ('$vehicule_id', 'year', '$vehicule_year');";
            $sql .= "INSERT INTO vehicules_meta (vehicule_id, meta_key, meta_data) VALUES ('$vehicule_id', 'energy', '$vehicule_energy');";
            $sql .= "INSERT INTO vehicules_meta (vehicule_id, meta_key, meta_data) VALUES ('$vehicule_id', 'owner_id', '$vehicule_owner_id');";
            $sql .= "INSERT INTO vehicules_meta (vehicule_id, meta_key, meta_data) VALUES ('$vehicule_id', 'type', '$vehicule_type');";
            if ($this->conn->multi_query($sql) === TRUE) {
                return $vehicule_id;
            } else {
                return $this->conn->error;
            }
        } else {
            return $this->conn->error;
        }
    }
}

