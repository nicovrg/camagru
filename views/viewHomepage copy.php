<?php $this->_t = "Home" ?>

<div class="gallery">
<?php
	foreach ($data as $line)
		foreach ($line as $key => $val)
			if ($key === "picture_name")
				$pictures[] = $val;
	var_dump($pictures);
	foreach ($pictures as $picture) { echo "<img src='/img/" . $picture . "' class='gallery_img'>"; }
?>
</div>







<!-- <script type="text/javascript">document.getElementById(canvas).style.height = 205%;</script> -->