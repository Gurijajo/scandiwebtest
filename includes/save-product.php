<?php

namespace Includes;

require_once __DIR__ . '/../vendor/autoload.php';

use Config\DatabaseConnection;
use Models\Product;


session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new DatabaseConnection();
    $db = $database->getConnection();

    $product = new product($db);
    $product->sku = trim($_POST['sku']);
    $product->name = trim($_POST['name']);
    $product->price = trim($_POST['price']);
    $product->type = trim($_POST['productType']);
    $product->special_attr = '';

    $message = '';

    switch ($product->type) {
        case 'DVD':
            $size = trim($_POST['size']);
            if (!is_numeric($size) || $size <= 0) {
                $message .= 'Please, provide a valid size in MB<br>';
                break;
            }
            $product->special_attr = 'Size: ' . $size . ' MB';
            break;

        case 'Furniture':
            $height = trim($_POST['height']);
            $width = trim($_POST['width']);
            $length = trim($_POST['length']);
            if (!is_numeric($height) || !is_numeric($width) || !is_numeric($length) || $height <= 0 || $width <= 0 || $length <= 0) {
                $message .= 'Please, provide valid dimensions (HxWxL) in CM<br>';  
                break;
            }
            $product->special_attr = 'Dimensions: ' . $height . 'x' . $width . 'x' . $length . ' CM';
            break;

        case 'Book':
            $weight = trim($_POST['weight']);
            if (!is_numeric($weight) || $weight <= 0) {
                $message .= 'Please, provide a valid weight in KG<br>';
                break;
            }
            $product->special_attr = 'Weight: ' . $weight . ' KG';
            break;

        default:
            $message .= 'Invalid product type<br>';
            break;
    }

    if (empty($product->sku) || empty($product->name) || empty($product->price) || empty($product->type) || empty($product->special_attr)) {
        $message .= 'Please, submit required data<br>';
    }

    if ($product->skuExists()) {
        $message .= 'SKU must be unique<br>';
    }

    if ($message) {
        $_SESSION['message'] = $message;
        $_SESSION['status'] = 'danger'; 
        header("Location: ../views/add-product.php");
        exit;
    }

    if ($product->create()) {
        $_SESSION['status'] = 'success';
        header("Location: ../views/index.php"); 
        exit;
    } else {
        $_SESSION['message'] = 'Unable to save product';
        $_SESSION['status'] = 'danger';
        header("Location: ../views/add-product.php");
        exit;
    }
}
?>
