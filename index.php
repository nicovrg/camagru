<?php
if (session_status() != PHP_SESSION_ACTIVE) 
	session_start();
define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http" . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]")));
require_once('controllers/Router.php');
$router = new Router();
$router->routeReq(); 
?>

