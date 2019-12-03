<?php $this->_t = "Home" ?>
<?php $like_manager = new LikeManager; ?>
<?php $comment_manager = new CommentManager; ?>
<?php $connexion_manager = new ConnexionManager; ?>
<div class="gallery">
	<?php foreach ($pictures as $picture): ?>
	<div class='gallery_elements'>
		<div class='gallery_element'>
			<img onclick="openImg(<?= $picture->id() ?>)" src="/img/<?= $picture->name() ?>" class="image_zoom_target">
			<p>Like: Comments: <?= $picture->name() ?></p>
		</div>
		<div class="zoom" id="zoom<?= $picture->id() ?>">
			<div class="zoom_container">
				<div onclick="reduceImg(<?= $picture->id() ?>)" class='middle_container'>
					<p class='middle_text'><?= $picture->name() ?></p>
				</div>
				<img id="zoom_image<?= $picture->id() ?>" class="zoom_image" src="/img/<?= $picture->name() ?>">
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
					<p> <?= split('-', split(' ', $comment->commentTime())[0])[2] ?> <?= split('-', split(' ', $comment->commentTime())[0])[1] ?> <?= split('-', split(' ', $comment->commentTime())[0])[0] ?> </p>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
			<form action="/homepage" method="post">
				<input type="hidden" value="<?= $picture->id() ?>" name="picture_id">
				<textarea id="taBind" type="text" placeholder=" comment ..." name="comment_content"></textarea>
				<button id="bindButtons" type="submit"></button>
			</form>
			<div class="form_container">
				<form action="/homepage" method="post">
					<input type="hidden" value="<?= $picture->id() ?>" name="picture_id">
					<button id="like" name="like" type="submit"><?= $like_manager->isLiked($picture->id(), $user->getAccount_id()) ? 'like' : 'dislike' ?></button>
				</form>
				<form action="/homepage" method="post">
					<input type="hidden" value="<?= $picture->id() ?>" name="picture_id">
					<!-- <button id="comment" value="....." name="comment_content" type="submit">comment</button> -->
					<button id="comment" onclick=c"document.getElementById('bindButtons').click()">comment</button>
					<!-- <script>console.log(document.getElementById('taBind').name)</script> -->
					<!-- <script>document.getElementById('taBind').setAttribute('name', 'workingGGGG')</script> -->
					<!-- <script> -->
					<!-- $('#comment').click(function(){ -->
					    <!-- $("#bindButtons").click(); -->
					<!-- }) -->
					<!-- </script> -->
					</form>
			</div>
			<?php endif; ?>
			<span onclick="closeImg(<?= $picture->id() ?>)" class="close">×</span>
		</div>
	</div>
	<?php endforeach; ?>
</div>


<!-- <script type="text/javascript">document.getElementById(canvas).style.height = 205%;</script> -->

<!-- <script>console.log(document.getElementById('taBind').value)</script> -->
<!-- <script>cdocument.getElementById('taBind').name</script> -->