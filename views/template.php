<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="icon" type="image/png" href="/img_common/mew.png" />
		<link rel="stylesheet" type="text/css" href="/style/template.css">
		<link rel="stylesheet" type="text/css" href="/style/modify.css">
		<link rel="stylesheet" type="text/css" href="/style/register.css">
		<link rel="stylesheet" type="text/css" href="/style/login.css">
		<link rel="stylesheet" type="text/css" href="/style/nyan.css">
		<script type="text/javascript" src="/scripts/particules.js"></script>
		<title><?= $t ?></title>
	</head>
	<body>
		<header class="header_div">
			<a href="/">Home</a>
			<?php $manager = new ConnexionManager; ?>
			<?= $manager->sessionLogin() ? "" : "<a href='/register'>" . "Register" . "</a>" ?>
			<?php $manager->sessionLogin() ? require_once("template_account.php") : "" ?>
			<?= $manager->sessionLogin() ? "<a href='/logout'>Logout</a>" : "<a href='/login'>Login</a>"?> 
		</header>
		<div class="main_div">
			<div class="over">
				<canvas id="canvas"></canvas>
				<div class="layout" >
					<?= $content ?>
				</div>
			</div>
		</div>
		<footer class="footer_div">
			<p></p>
			<a href="/nyancat">Miaou</a>
		</footer>
	</body>
</html>