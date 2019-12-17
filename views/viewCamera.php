<?php $this->_t = "Camera" ?>
<div id="viewCamera">
	<form action="/camera" method="post" id="formImageWebcam">
		<input type="hidden" id="imageDataWebcam" name="imageDataWebcam">
		<input type="hidden" id="imageNameWebcam" name="imageNameWebcam">
	</form>
	<form action="/camera" method="post" id="formImageFile" enctype="multipart/form-data">
		<input type="file" id="imageDataFile" name="imageDataFile" style="display: block;">
		<!-- <input type="hidden" id="imageNameFile" name="imageNameFile"> -->
	</form>
	<div id="cameraBlock">
		<video id="camera--view" autoplay playsinline muted></video>
		<canvas id="camera--sensor"></canvas>		
	</div>
	<div id="buttonBlock">
		<button id="upload--file" onclick="uploadFile()">Upload !</button>	
		<button id="camera--trigger">Shoot !</button>	
		<button id="camera--saver">Save !</button>	
	</div>
</div>
<script src="/scripts/camera.js"></script>


<!-- change chrome webcam settings chrome://flags/#unsafely-treat-insecure-origin-as-secure -->
<!-- new tuto https://blog.prototypr.io/make-a-camera-web-app-tutorial-part-1-ec284af8dddf -->
<!-- old tuto https://developer.mozilla.org/en-US/docs/Web/API/WebRTC_API/Taking_still_photos -->