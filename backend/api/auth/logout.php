<?php
require_once(__DIR__ . '/../../config/db.php');
require_once(__DIR__ . '/../../controllers/UserController.php');

header('Content-Type: application/json');

$controller = new UserController($conn);
$controller->apiLogout();
