<?php $this->_t = "Login" ?>
<div class="login">
	<p class="login_title">login</p>
	<form action="/login" method="POST" id="login">
		<p class="login_field_name">username: </p>
		<input class="login_form_cell" type="text" name="username">
		<p class="login_field_name">password: </p>
		<input class="login_form_cell" type="text" name="password">
		<input class="login_form_cell" type="submit" name="confirm">
	</form>
</div>