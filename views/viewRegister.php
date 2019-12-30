<?php $this->_t = "Register" ?>
<div class="register">
	<!-- <p class="register_title">please complete the field below</p> -->
	<form action="/register" method="POST" class="register">
		username: <input class="register_form_cell" type="text" value="test" name="username">
		email: <input class="register_form_cell" type="text" value="test@yopmail.com" name="email">
		password: <input class="register_form_cell" type="text" value="Test123456!" name="password">
		confirm password: <input class="register_form_cell" type="text" value="Test123456!" name="confirm_password">
		<input type="submit" name="confirm">
	</form>
</div>