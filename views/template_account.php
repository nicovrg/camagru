<div class="dropdown">
	<button class="dropbtn" onclick="myFunction()">
		<?= $manager->sessionLogin()->username() ?>
	</button>
	<div class="dropdown-content" id="myDropdown">
		<a href="/modify">Edit account</a>
		<a href="/renew">Renew Password</a>
		<a href="/delete">Delete account</a>
	</div>
	<script src="/scripts/account.js"></script> 
</div>