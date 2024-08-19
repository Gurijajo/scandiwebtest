<?php

namespace Includes;

require_once __DIR__ . '/../vendor/autoload.php';


use Models\Product;
use Config\DatabaseConnection;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['deleteIds'])) {
    $database = new DatabaseConnection();
    $db = $database->getConnection();
    $product = new Product($db);

    foreach ($_POST['deleteIds'] as $sku) {
        $product->sku = $sku;
        $product->delete();
    }

    
    header("Location: ../views/index.php");
    exit();
} else {
    header("Location: ../views/index.php?error=Please select at least one product to delete");
    exit();
}
?>
