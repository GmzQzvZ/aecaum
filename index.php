<?php
// ACAEUM — Front Controller
require_once __DIR__ . '/bootstrap.php';

$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
