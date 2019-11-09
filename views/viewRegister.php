<?php $this->_t = "Register" ?>
<div>
	<h3 class="register_title">register</h3>
	<form action="/register" method="POST" class="register">
		username: <input class="register_form_cell" type="text" name="username">
		email: <input class="register_form_cell" type="text" name="email">
		password: <input class="register_form_cell" type="text" name="password">
		confirm password: <input class="register_form_cell" type="text" name="confirm_password">
		<input type="submit" name="confirm">
	</form>
</div>