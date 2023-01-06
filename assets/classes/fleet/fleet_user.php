<?php

class fleetUser
{

    private $conn;

    function __construct()
    {
        $this->conn = (new Database())->getConn();
    }

    function getFleetIdByUserId($user_id)
    {
        $sql = "SELECT * FROM fleet WHERE user_id='$user_id'";
        $fleet_data = [];
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $fleet_data[$row["id"]] = $row["fleet_name"];
        }
    }

    function getFleetById($fleet_id)
    {
        $sql = "SELECT * FROM fleet WHERE id='$fleet_id'";
        $fleet_data = [];
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $fleet_data[$row["id"]]["fleet_name"] = $row["fleet_name"];
            $fleet_data[$row["id"]]["fleet_user_id"] = $row["user_id"];
        }
    }

    function newFleet($fleet_name)
    {
        $user_id = (new User())->getUserId();
        $sql = "INSERT INTO fleet (user_id, fleet_name) VALUES ('$user_id', '$fleet_name')";
        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return 1;
        }
    }

}

