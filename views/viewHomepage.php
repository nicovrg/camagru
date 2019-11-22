<?php $this->_t = "Home" ?>
<div class="gallery">
	<?php foreach ($pictures as $picture): ?>
	<div class='gallery_elements'>
		<div class='gallery_element'>
			<img src="/img/<?= $picture->name() ?>" class='gallery_element_img'>
			<p>Like: Comments: <?= $picture->name() ?> </p>
		</div>
	</div>
	<?php endforeach; ?>
	<!-- hide or show image in full screen -->
	<div class="modal"> 
		<img class="modal-content">
		<div class="caption" alt="">like</div>
		<span class="close">×</span>
	</div>
</div>






<!-- <script type="text/javascript">document.getElementById(canvas).style.height = 205%;</script> -->
