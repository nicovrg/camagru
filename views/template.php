<!-- <?php //session_start(); ?> -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title><?= $t ?></title>
	</head>
	<body>
		<header>
			<a href="/">Home</a>
			<a href="/register">Register</a>
			<a href="/login">Login</a>
			<a href="/logout">Logout</a>
		</header>
		<?= $content ?>
		<footer>
		</footer>
	</body>
</html>