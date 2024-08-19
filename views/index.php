<?php
require __DIR__ . '/../vendor/autoload.php';

use App\ProductController;


$productController = new ProductController();
$products = $productController->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<header>
    <div class="header-content">
        <h2>Product List</h2>
        <div class="buttons">
            <a href="add-product.php" class="btn btn-outline-primary">ADD</a>
            <button type="submit" form="massDeleteForm" class="btn btn-outline-danger" id="massDeleteBtn">MASS DELETE</button>
        </div>
    </div>
    <div class="line"></div>
</header>
    <div class="container mt-3">
    <?php if (isset($_GET['error'])): ?>
        <div id="errorAlert" class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>
        <form id="massDeleteForm" action="../includes/mass-delete.php" method="post">
            <div class="row">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <?php $details = $product->display(); ?>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <input type="checkbox" name="deleteIds[]"
                                        value="<?php echo htmlspecialchars($product->sku); ?>" class="delete-checkbox">
                                    <p class="card-text text-center"> <?php echo htmlspecialchars($details["SKU"]); ?></p>
                                    <p class="card-text text-center"><?php echo htmlspecialchars($details["Name"]); ?></p>
                                    <p class="card-text text-center"><?php echo htmlspecialchars('$' . number_format($details["Price"], 2)); ?></p>
                                    <p class="card-text text-center">
                                        <?php echo htmlspecialchars($details["Attribute Value"]); ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">No products found.</p>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <footer class="footer fixed-bottom">
        <div class="line"></div>
            <h3>ScandiWeb Test Assignment</h3>
    </footer>
    <script src="../assets/js/script.js"></script>
</body>

</html>