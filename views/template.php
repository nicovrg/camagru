<!-- <?php //session_start(); ?> -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="/style/template.css">
		<title><?= $t ?></title>
	</head>
	<body>
		<header id="header_div">
			<a href="/">Home</a>
			<a href="/register">Register</a>
			<a href="/login">Login</a>
			<a href="/logout">Logout</a>
			<a href="/modify">Modify</a>
		</header>
			<div id="main_div">
				<?= $content ?>
			</div>
		<footer id="footer_div">
			<p>footer</p>
		</footer>
	</body>
</html>