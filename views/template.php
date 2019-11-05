<!-- <?php //session_start(); ?> -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="icon" type="image/png" href="../favicon.png" />
		<link rel="stylesheet" type="text/css" href="/style/template.css">
		<link rel="stylesheet" type="text/css" href="/style/modify.css">
		<link rel="stylesheet" type="text/css" href="/style/register.css">
		<title><?= $t ?></title>
	</head>
	<body>
		<header class="header_div">
			<a href="/">Home</a>
			<a href="/register">Register</a>
			<?php $manager = new ConnexionManager; ?>
			<?= $manager->sessionLogin() ? '<a href="/modify">' . $manager->sessionLogin()->username() . "</a>" : "" ?>
			<a <?= $manager->sessionLogin() ? 'href="/logout">Logout</a>' : 'href="/login">Login</a> ' ?>
		</header>
			<div class="main_div">
				<?= $content ?>
			</div>
		<footer class="footer_div">
			<p>footer</p>
		</footer>
	</body>
</html>