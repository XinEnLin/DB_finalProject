<?php
session_start();
require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../controllers/CartController.php');

$cart = new CartController($conn);
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>�???�派�?</title>
</head>
<body>

<h1>歡�???????��????�派�?</h1>

<?php if (isset($_SESSION['username'])): ?>
    <p>歡�?????�?<?php echo htmlspecialchars($_SESSION['username']); ?>�?
    <a href="../public/logout.php"><button>??��??</button></a></p>
<?php else: ?>
    <a href="login_layout.php"><button>??��??</button></a>
    <a href="register_layout.php"><button>註�??</button></a>
<?php endif; ?>

<?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'boss'): ?>
    <a href="admin_layout.php"><button>??��?�管?????????</button></a>
<?php endif; ?>

<a href="../layouts/cart_layout.php"><button>檢�??購�?��??</button></a>

<?php include("../public/index.php"); ?>
<?php include("../partials/product_table.php"); ?>

</body>
</html>
