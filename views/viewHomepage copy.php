<?php $this->_t = "Home" ?>
<div class="gallery">
	<?php foreach ($pictures as $picture): ?>
	<div class='gallery_elements'>
		<div class='gallery_element'>
			<img src="/img/<?= $picture->name() ?>" class="image_zoom_target">
			<p>Like: Comments: </p>
		</div>
	</div>
	<!-- hide or show image in full screen -->
	<div class="zoom"> 
		<img class="zoom_image">
		<p><?= $picture->name() ?></p>
		<?php $manager = new ConnexionManager; ?>
		<?php if ($manager->sessionLogin()): ?>
		<!-- <div class="zoom_button"> -->
		<form action="/homepage" method="post">
			<input type="hidden" value="<?= $picture	->id() ?>" name="picture_id">
			<button id="like" name="like" type="submit">like</button>
		</form>
		<?php endif; ?>
		<!-- <button id="like" name="like" type="submit"><a href="/home">like</a></button> -->
		<!-- <button id="comment" name="comment" type="submit">comment</button> -->
		<!-- </div> -->
		<!-- <div class='middle_container'> -->
			<!-- <div class='middle_text'><?= $picture->name() ?></div> -->
			<!-- </div> -->
		<span class="close">×</span>
	</div>
	<?php endforeach; ?>
</div>


<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->



<!-- <script type="text/javascript">document.getElementById(canvas).style.height = 205%;</script> -->
