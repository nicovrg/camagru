<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="icon" type="image/png" href="/img_common/mew.png" />
		<link rel="stylesheet" type="text/css" href="/style/template.css">
		<link rel="stylesheet" type="text/css" href="/style/homepage.css">
		<link rel="stylesheet" type="text/css" href="/style/image_zoom.css">
		<link rel="stylesheet" type="text/css" href="/style/camera.css">
		<link rel="stylesheet" type="text/css" href="/style/register.css">
		<link rel="stylesheet" type="text/css" href="/style/modify.css">
		<link rel="stylesheet" type="text/css" href="/style/login.css">
		<link rel="stylesheet" type="text/css" href="/style/nyan.css">
		<script type="text/javascript" src="/scripts/account.js"></script>
		<script type="text/javascript" src="/scripts/buttons.js"></script>
		<script type="text/javascript" src="/scripts/camera.js"></script>
		<script type="text/javascript" src="/scripts/image_zoom.js"></script>
		<script type="text/javascript" src="/scripts/particules.js"></script>
		<script type="text/javascript" src="/scripts/app.js"></script>
		<title><?= $t ?></title>
	</head>
	<body>
		<header class="header_div">
			<a href="/">home</a>
			<?php $manager = new ConnexionManager; ?>
			<?= $manager->sessionLogin() ? "" : "<a href='/register'>" . "Register" . "</a>" ?>
			<?= $manager->sessionLogin() ? "<a href='/camera'>camera</a>" : "<a href='/login'>Login</a>"?> 
			<?php $manager->sessionLogin() ? require_once("template_account.php") : "" ?>
		</header>
		<div class="main_div">
			<div class="canvas_container">
				<canvas id="canvas"></canvas>
				<div class="layout" >
					<?= $content ?>
				</div>
			</div>
		</div>
		<footer class="footer_div">
			<!-- <button style="margin: 0em 0em 0em 0em;">down</button> -->
			<!-- <button style="margin: 0em 140em 0em 0em;">up</button> -->
			<a href="/nyancat">miaou</a>
		</footer>
	</body>
</html>