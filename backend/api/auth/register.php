<?php
require_once(__DIR__ . '/../../config/db.php');
require_once(__DIR__ . '/../../controllers/UserController.php');

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$controller = new UserController($conn);
$controller->apiRegister($input);
