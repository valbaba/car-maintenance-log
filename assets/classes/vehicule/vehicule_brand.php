<?php
/**
 *
 */
class Brand
{
    /**
     * @var mysqli
     */
    private $conn;

    /**
     *
     */
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConn();
    }

    /**
     * @return array
     */
    public function getAllBrands()
    {
        $sql = "SELECT * FROM brand";
        $result = $this->conn->query($sql);
        $brands = [];
        while ($row = $result->fetch_assoc()) {
            $brands[$row["id"]] = $row["name"];
        }
        return $brands;

    }


    /**
     * @param $brand_id
     * @return int|string|mixed
     */
    public function getBrandNameById($brand_id){
        $sql = "SELECT * FROM brand WHERE id=$brand_id";
        $result = $this->conn->query($sql);
        $brands = [];
        while ($row = $result->fetch_assoc()) {
            return $row["name"];
        }
        return $brands;
    }


    /**
     * @param $brand_name
     * @return int|string|mixed
     */
    public function getBrandIdByName($brand_name){
        $sql = "SELECT * FROM brand WHERE name=$brand_name";
        $result = $this->conn->query($sql);
        $brands = [];
        while ($row = $result->fetch_assoc()) {
            return $row["id"];
        }
        return $brands;
    }

    /**
     * @param $brand_name
     * @return int
     */
    public function addBrand($brand_name){
        $sql = "INSERT INTO brand (name) VALUES ('$brand_name')";
        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return 1;
        }
    }



}