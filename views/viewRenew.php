<?php $this->_t = "Renew" ?>

<div>
	<?php if (!$token): ?>
	<p class="renew_title">Check your mail</p>
	<?php endif; ?>
	<?php if ($token): ?>
	<form action="/renew" method="POST" id="renew">
		token: <input class="renew_form_cell" type="text" name="token">
		new password: <input class="renew_form_cell" type="password" name="new_password">
		confirm password: <input class="renew_form_cell" type="password" name="confirm_password">
		<input type="submit" name="confirm">
	</form>
	<?php endif; ?>
</div>

