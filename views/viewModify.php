<?php $this->_t = "Modify" ?>

<div>
	<p>Edit the field you want to change and submit</p>
	<form action="/modify" method="POST" id="modify">
		username: <input class="modify_form_cell" type="text" name="username" value="lala">
		email: <input class="modify_form_cell" type="text" name="email">
		password: <input class="modify_form_cell" type="text" name="password">
		confirm password: <input class="modify_form_cell" type="text" name="confirm_password">
		<input type="submit" name="confirm">
	</form>
</div>