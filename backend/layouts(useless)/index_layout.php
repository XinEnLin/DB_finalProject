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
    <title>å±???¼æ´¾å°?</title>
</head>
<body>

<h1>æ­¡è???????¨å????¼æ´¾å°?</h1>

<?php if (isset($_SESSION['username'])): ?>
    <p>æ­¡è?????ä¾?<?php echo htmlspecialchars($_SESSION['username']); ?>ï¼?
    <a href="../public/logout.php"><button>??»å??</button></a></p>
<?php else: ?>
    <a href="login_layout.php"><button>??»å??</button></a>
    <a href="register_layout.php"><button>è¨»å??</button></a>
<?php endif; ?>

<?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'boss'): ?>
    <a href="admin_layout.php"><button>??²å?¥ç®¡?????????</button></a>
<?php endif; ?>

<a href="../layouts/cart_layout.php"><button>æª¢è??è³¼ç?©è??</button></a>

<?php include("../public/index.php"); ?>
<?php include("../partials/product_table.php"); ?>

</body>
</html>
