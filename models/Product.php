<?php
namespace Models;


class product
{

    private $conn;
    private $table_name = "products";


    public $id;
    public $sku;
    public $name;
    public $price;
    public $type;
    public $special_attr;


    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
                  (sku, name, price, type, special_attr) 
                  VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);


        $stmt->bind_param("ssdss", $this->sku, $this->name, $this->price, $this->type, $this->special_attr);


        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function skuExists()
    {
        $query = "SELECT id FROM " . $this->table_name . " WHERE sku = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("s", $this->sku);

        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return true;
        }

        return false;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $products = [];
        while ($row = $stmt->fetch_assoc()) {
            $product = new Product($this->conn);
            $product->sku = $row['sku'];
            $product->name = $row['name'];
            $product->price = $row['price'];
            $product->type = $row['type'];
            $product->special_attr = $row['special_attr'];
            $products[] = $product;
        }

        return $products;
    }

    public function display()
    {
        return [
            "SKU" => $this->sku,
            "Name" => $this->name,
            "Price" => $this->price,
            "Attribute" => $this->type,
            "Attribute Value" => $this->special_attr
        ];
    }

    public function delete()
    {
        if (empty($this->sku)) {
            return false; 
        }
    
        $query = "DELETE FROM " . $this->table_name . " WHERE sku = ?";
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            return false; 
        }
    
        $stmt->bind_param("s", $this->sku);
    
        if ($stmt->execute()) {
            if ($stmt->affected_rows === 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    

}
?>