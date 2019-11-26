<?php $this->_t = "Home" ?>
<div class="gallery">
	<?php $i = 0; ?>
	<?php foreach ($pictures as $picture): ?>
		<?php $i++ ?>
	<div class='gallery_elements'>
		<div class='gallery_element'>
			<img onclick="openImg(<?= $picture->id() ?>)" src="/img/<?= $picture->name() ?>" class="image_zoom_target">
			<p>Like: Comments: <?= $picture->name() ?></p>
		</div>
		<div class="zoom" id="zoom<?= $picture->id() ?>"> 
			<img class="zoom_image" src="/img/<?= $picture->name() ?>" id="zoom_image<?= $picture->id() ?>">
			<p> <?= $picture->name() ?> <?= $i ?></p>
			<script>console.log("<?= $picture->name() ?>")</script>
			<?php $manager = new ConnexionManager; ?>
			<?php if ($manager->sessionLogin()): ?>
				<form action="/homepage" method="post">
				<input type="hidden" value="<?= $picture->id() ?>" name="picture_id">
				<button id="like" name="like" type="submit">like</button>
			</form>
			<?php endif; ?>
			<span onclick="closeImg(<?= $picture->id() ?>)" class="close">×</span>
		</div>
		<!-- <div class='middle_container'> -->
			<!-- <div class='middle_text'><?= $picture->name() ?> -->
			<!-- </div> -->
		<!-- </div> -->
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
