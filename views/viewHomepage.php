<?php $this->_t = "Home" ?>
<div class="gallery">
<?php 
	foreach ($data as $pass)
		foreach ($pass as $dbline)
			foreach ($dbline as $key => $val)
				if ($key === "picture_name")
					$array_pic[] = $val;
	foreach ($array_pic as $picture)
		echo "<img src='/img/" . $picture . "' class='gallery_img'>";
?>
</div>








<!-- <script type="text/javascript">document.getElementById(canvas).style.height = 205%;</script> -->