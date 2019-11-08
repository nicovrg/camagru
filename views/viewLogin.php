<?php $this->_t = "Login" ?>
<div>
	<p style="display:flex; justify-content: center;">login</p>
	<form action="/login" method="POST" id="login">
		username: <input id="username" type="text" name="username">
		password: <input id="password" type="text" name="password">
		<input type="submit" name="confirm">
	</form>
</div>