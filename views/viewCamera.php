<?php $this->_t = "Camera" ?>
<div id="viewCamera">
	<canvas style="display: none" id="filterCanvas"></canvas>
	<form action="/camera" method="post" id="formImageWebcam">
		<input type="hidden" id="imageNameWebcam" name="imageNameWebcam">
		<input type="hidden" id="imageDataWebcam" name="imageDataWebcam">
		<input type="hidden" id="filterDataWebcam" name="filterDataWebcam">
	</form>
	<form action="/camera" method="post" id="formDeletePicture">
		<input type="hidden" id="inputDeletePicture" name="inputDeletePicture" style="display: none;">
	</form>
	<input type="file" id="imageDataFile" name="imageDataFile" style="display: none;">
	<div id="cameraBlock">
		<video id="camera--view" autoplay playsinline muted></video>
		<canvas id="camera--sensor"></canvas>
		<canvas id="canvas--filter"></canvas>
	</div>
	<div id="filter">
		<img src="/filter/fox.png" onclick="selectFilter('fox')" id="fox" class="filter">
		<img src="/filter/tiger.png" onclick="selectFilter('tiger')" id="tiger" class="filter">
		<img src="/filter/tigre.png" onclick="selectFilter('tigre')" id="tigre" class="filter">
		<img src="/filter/koala.png" onclick="selectFilter('koala')" id="koala" class="filter">
	</div>
	<div id="buttonBlock">
		<button id="upload--file">Upload</button>
		<button id="camera--trigger">Shoot</button>	
		<button id="camera--saver">Save</button>	
	</div>
</div>
<div id="sidebar">
	<?php if ($pictures): ?>
	<?php foreach ($pictures as $picture): ?>
		<img src="<?= $picture->path() ?>" onclick="deletePicture(<?= $picture->id() ?>)">
	<?php endforeach; ?>
	<?php endif; ?>
</div>
<script src="/scripts/camera.js"></script>


<!-- change chrome webcam settings chrome://flags/#unsafely-treat-insecure-origin-as-secure -->
<!-- new tuto https://blog.prototypr.io/make-a-camera-web-app-tutorial-part-1-ec284af8dddf -->
<!-- old tuto https://developer.mozilla.org/en-US/docs/Web/API/WebRTC_API/Taking_still_photos -->