<?php
namespace Views;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Add</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<header>
    <div class="header-content">
        <h2>Product ADD</h2>
        <div class="buttons">
            <button type="submit" form="product_form" class="btn btn-outline-success">Save</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Cancel</button>
        </div>
    </div>
    <div class="line"></div>
</header>

<div class="form-container">
    <form id="product_form" action="../includes/save-product.php" method="post">
        <div id="notification">
        <?php
        session_start();
        if (isset($_SESSION['message'])) {
            $status = $_SESSION['status'] == 'success' ? 'alert-success' : 'alert-danger';
            echo "<div class=\"alert $status text-center\">" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
        ?>
        </div>

        <label for="sku">SKU:</label>
        <input type="text" id="sku" name="sku" required>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Price ($):</label>
        <input type="text" id="price" name="price" required>

        <label for="productType">Type Switcher:</label>
        <select id="productType" name="productType" onchange="switchForm()" required>
            <option value="" disabled selected>Select Type</option>
            <option value="DVD">DVD</option>
            <option value="Book">Book</option>
            <option value="Furniture">Furniture</option>
        </select>

        <div id="dynamicForm">
            
        </div>

    </form>
</div>

<footer class="footer fixed-bottom">
    <div class="line"></div>
    <h3>ScandiWeb Test Assignment</h3>
</footer>

<script src="../assets/js/script.js"></script>