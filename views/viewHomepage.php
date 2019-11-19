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

	<!-- The Modal -->
	<div class="modal">
		<img class="modal-content">
		<div class="caption"></div>
		<span class="close">×</span>
	</div>
</div>






<!-- <script type="text/javascript">document.getElementById(canvas).style.height = 205%;</script> -->