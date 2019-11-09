<?php $this->_t = "Modify" ?>

<div>
	<p class="modify.title">Edit the field you want to change and submit</p>
	<form action="/modify" method="POST" id="modify">
		username: <input class="modify_form_cell" type="text" name="username" value="<?= $user->username() ?>">
		email: <input class="modify_form_cell" type="text" name="email" value="<?= $user->email() ?>">
		<input type="submit" name="confirm">
	</form>
</div>