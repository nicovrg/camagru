<?php $this->_t = "Home" ?>
<div class="gallery">
	<?php
		foreach ($pictures as $picture)
		{
			echo "<img src='/img/" . $picture->name() . "' class='gallery_img'>";
			$i++;
		}
	?>
	<div class="modal">
		<img class="modal-content">
		<div class="caption"></div>
		<span class="close">×</span>
	</div>
</div>






<!-- <script type="text/javascript">document.getElementById(canvas).style.height = 205%;</script> -->