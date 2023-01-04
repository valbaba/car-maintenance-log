<?php

/**
 *
 */
class Category {
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
    public function getCategories(){
        $sql = "SELECT * FROM category";
        $result = $this->conn->query($sql);
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[$row["id"]] = $row["category_name"];
        }
        return $categories;
    }

    /**
     * @param $category_name
     * @return array
     */
    public function getCategoryByName($category_name){
        $sql = "SELECT * FROM category WHERE category_name='$category_name'";
        $result = $this->conn->query($sql);
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[$row["id"]] = $row["category_name"];
        }
        return $categories;
    }

    /**
     * @param $category_id
     * @return array
     */
    public function getCategoryById($category_id){
        $sql = "SELECT * FROM category WHERE id='$category_id'";
        $result = $this->conn->query($sql);
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[$row["id"]] = $row["category_name"];
        }
        return $categories;
    }

    /**
     * @param $category_name
     * @return int
     */
    public function addCategory($category_name){
        $sql = "INSERT INTO category (category_name) VALUES ('$category_name')";
        if ($this->conn->query($sql) === TRUE) {
            return 0;
        } else {
            return $this->conn->error;
        }
    }


}