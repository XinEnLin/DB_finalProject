<?php
require_once(__DIR__ . '/../controllers/ProductController.php');
$productController = new ProductController($conn);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productController->handlePost($_POST, $_FILES);
}


$editingProduct = null;
if (isset($_GET['edit'])) {
    $editingProduct = $productController->getById($_GET['edit']);
}

$products = $productController->getAll(); 
?>

<h1> Boss Dashboard</h1>

<?php include('../partials/message.php'); ?>
<?php include('../partials/product_form.php'); ?>
<hr>
<?php include('../partials/boss_product_table.php'); ?>
