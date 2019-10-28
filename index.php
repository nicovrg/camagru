<?php
session_start();
define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http" . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]")));
require_once('controllers/Router.php');

$router = new Router();
$router->routeReq(); 


if ($_POST)
{
	if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'])
	{
		$user["login"] = $_POST['login'];
		$user["passwd"] = hash("sha512", $_POST['passwd']);
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="style/index.css" media="screen"/>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<title>Document</title>
	</head>
	<body>
		<H1>Camagru<H1>
		<div>
			<form action="models/UserManager.php" method="POST" id="sign-in">
				username: <input id="POST-username" type="text" name="username">
				email: <input id="POST-email" type="text" name="email">
				password: <input id="POST-password" type="text" name="password">
				confirm password: <input id="POST-confirm_password" type="text" name="confirm_password">
				<input type="submit" value="Confirm">
			</form>
		</div>
	</body>
</html>