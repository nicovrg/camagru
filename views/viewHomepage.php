<?php $this->_t = "Home" ?>
<div class="gallery">
	<?php foreach ($pictures as $picture): ?>
	<div class='gallery_elements'>
		<div class='gallery_element'>
			<img onclick="openImg(<?= $picture->id() ?>)" src="/img/<?= $picture->name() ?>" class="image_zoom_target">
			<p>Like: Comments: <?= $picture->name() ?></p>
		</div>
		<div class="zoom" id="zoom<?= $picture->id() ?>">
			<div class="zoom_container">
				<div class='middle_container'>
					<p class='middle_text'><?= $picture->name() ?></p>
				</div>
				<img id="zoom_image<?= $picture->id() ?>" class="zoom_image" src="/img/<?= $picture->name() ?>">
			</div>
			<?php $like_manager = new LikeManager; ?>
			<?php $connexion_manager = new ConnexionManager; ?>
			<?php if ($connexion_manager->sessionLogin()): ?>
			<form action="/homepage" method="post">
				<input type="hidden" value="<?= $picture->id() ?>" name="picture_id">
				<button id="like" name="like" type="submit"><?= $like_manager->isLiked($picture->id(), $user->getAccount_id()) ? 'like' : 'dislike' ?></button>
			</form>
			<?php endif; ?>
			<span onclick="closeImg(<?= $picture->id() ?>)" class="close">×</span>
		</div>
	</div>
	<?php endforeach; ?>
</div>



<!-- <script type="text/javascript">document.getElementById(canvas).style.height = 205%;</script> -->
