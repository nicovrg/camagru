<?php $this->_t = "Home" ?>
<div class="gallery">
	<?php 
		$i = 0;
		foreach ($data as $pass)
			foreach ($pass as $dbline)
				foreach ($dbline as $key => $val)
					if ($key === "picture_name")
						$array_pic[] = $val;
		foreach ($array_pic as $picture)
		{
			echo "<img src='/img/" . $picture . "' class='gallery_img'>";
			$i++;
		}
	?>
<!-- </div> -->

	<!-- Image -->
	<img id="myImg" src="/img/nico.png" alt="Like" class='gallery_img'>
	<img id="myImg" src="/img/nico.png" alt="Like" class='gallery_img'>
	<img id="myImg" src="/img/nico.png" alt="Like" class='gallery_img'>

	<!-- The Modal -->
	<div id="myModal" class="modal">
		<span class="close">×</span>
		<img class="modal-content" id="img01">
		<div id="caption"></div>
	</div>
</div>






<!-- <script type="text/javascript">document.getElementById(canvas).style.height = 205%;</script> -->