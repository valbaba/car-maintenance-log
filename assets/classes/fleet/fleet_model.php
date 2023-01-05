<?php

class Model {
    /**
     * @var mysqli
     */
    private $conn;

    /**
     *
     */
    public function __construct()
    {
        $this->conn = (new Database)->getConn();
    }

    /**
     * @return array
     */
    public function getAllModels()
    {
        $sql = "SELECT * FROM model";
        $result = $this->conn->query($sql);
        $models = [];
        while ($row = $result->fetch_assoc()) {
            $models[$row["id"]] = $row["name"];
        }
        return $models;

    }


    /**
     * @param $model_id
     * @return int|string|mixed
     */
    public function getModelNameById($model_id){
        $sql = "SELECT * FROM model WHERE id=$model_id";
        $result = $this->conn->query($sql);
        $models = [];
        while ($row = $result->fetch_assoc()) {
            return $row["name"];
        }
        return $models;
    }


    /**
     * @param $model_name
     * @return int|string|mixed
     */
    public function getModelIdByName($model_name){
        $sql = "SELECT * FROM model WHERE name=$model_name";
        $result = $this->conn->query($sql);
        $models = [];
        while ($row = $result->fetch_assoc()) {
            return $row["id"];
        }
        return $models;
    }

    /**
     * @param $model_name
     * @return int
     */
    public function addModel($model_name){
        $sql = "INSERT INTO model (name) VALUES ('$model_name')";
        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return 1;
        }
    }
}