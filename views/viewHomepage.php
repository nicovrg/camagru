<?php $this->_t = "Home" ?>
<?php $like_manager = new LikeManager; ?>
<?php $comment_manager = new CommentManager; ?>
<?php $connexion_manager = new ConnexionManager; ?>
<div class="gallery">
	<?php foreach ($pictures as $picture): ?>
	<!-- if (picture_id > ($_GET["nbpage"] * 9) && picture_id < ($_GET["nbpage"] * 9): -->
	<div class='gallery_elements'>
		<div class='gallery_element'>
			<img onclick="openImg(<?= $picture->id() ?>)" src="<?= $picture->path() ?>" class="image_zoom_target">
			<p>Like: Comments: <?= explode("/", $picture->path())[1] ?></p>
		</div>
		<div class="zoom" id="zoom<?= $picture->id() ?>">
			<div class="zoom_container">
				<div onclick="reduceImg(<?= $picture->id() ?>)" class='middle_container'>
					<p class='middle_text'><?= $picture->path() ?></p>
				</div>
				<img id="zoom_image<?= $picture->id() ?>" class="zoom_image" src="<?= $picture->path() ?>">
			</div>
			<?php if ($connexion_manager->sessionLogin()): ?>
			<div class="comments_container">
				<?php foreach ($comments as $comment): ?>
				<div class="comment_container">
				<?php if ($comment->isFromPicture($picture->id()) == true): ?>
					<?php foreach ($users as $tmp): ?>
						<?=	$comment->ownerAccountId() == $tmp->getAccount_id() ? "<p>" . $tmp->getUsername() . "</p>" : "" ?>
					<?php endforeach; ?>
					<p> <?= $comment->commentContent() ?> </p>
					<p> <?= $comment->commentTime() ?> </p>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
			<form action="/homepage" method="post" id="comment-form<?= $picture->id() ?>">
				<input type="hidden" value="<?= $picture->id() ?>" name="picture_id">
				<textarea type="text" placeholder=" comment ..." name="comment_content"></textarea>
			</form>
			<div class="form_container">
				<form action="/homepage" method="post" id="like-form<?= $picture->id() ?>">
					<input type="hidden" value="<?= $picture->id() ?>" name="picture_id">
					<input type="hidden" value="like" name="like">
				</form>
				<button onclick="submitLike(<?= $picture->id() ?>)"><?= $like_manager->isLiked($picture->id(), $user->getAccount_id()) ? 'dislike' : 'like' ?></button>
				<button id="comment" onclick="submitComment(<?= $picture->id() ?>)">comment</button>
			</div>
			<?php endif; ?>
			<span onclick="closeImg(<?= $picture->id() ?>)" class="close">×</span>
		</div>
	</div>
	<!-- endif -->
	<?php endforeach; ?>
	<p>page: </p>
</div>


<!-- <script type="text/javascript">document.getElementById(canvas).style.height = 205%;</script> -->

<!-- <script>console.log(document.getElementById('taBind').value)</script> -->
<!-- <script>cdocument.getElementById('taBind').name</script> -->