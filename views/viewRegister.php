<?php $this->_t = "Register" ?>
<div class="register">
	<!-- <p class="register_title">please complete the field below</p> -->
	<form action="/register" method="POST" class="register">
		username: <input class="register_form_cell" type="text" name="username">
		email: <input class="register_form_cell" type="text" name="email">
		password: <input class="register_form_cell" type="text" name="password">
		confirm password: <input class="register_form_cell" type="text" name="confirm_password">
		<input type="submit" name="confirm">
	</form>
</div>