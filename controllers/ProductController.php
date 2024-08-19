<?php
namespace App;

use Models\Product;

use Config\DatabaseConnection;


class ProductController {
    private $db;
    private $table_name = "products";

    public function __construct() {
        $database = new DatabaseConnection();
        $this->db = $database->getConnection();
    }

    public function getAllProducts() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->db->prepare($query); 
        $stmt->execute();

        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $product = new Product($this->db);
            $product->sku = $row['sku'];
            $product->name = $row['name'];
            $product->price = $row['price'];
            $product->type = $row['type'];
            $product->special_attr = $row['special_attr'];
            $products[] = $product;
        }

        return $products; 
    }
}
