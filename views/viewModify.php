session_start();
<?php $this->_t = "Modify" ?>
<div>
	<p>For safety reasons, please log again</p>
	<form action="/modify" method="POST" class="modify">
		username: <input id="username" type="text" name="username">
		password: <input id="password" type="text" name="password">
		<input type="submit" name="confirm">
	</form>
</div>