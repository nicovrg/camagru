<div class="dropdown">
	<button class="dropbtn" onclick="myFunction()">
		<?= $manager->sessionLogin()->getUsername() ?>
		<?php $manager->userMailActivate() == false ? $mail = "enable notification" : "disable notification" ?>
	</button>
	<div class="dropdown-content" id="myDropdown">
		<a href="/logout">Logout</a>
		<a href="/modify">Edit account</a>
		<a href="/renew">Renew password</a>
		<a href="/notification"><?= $mail ?></a>
		<a href="/delete">Delete account</a>
	</div>
	<script src="/scripts/account.js"></script> 
</div>