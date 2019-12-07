<?php $this->_t = "Camera" ?>
<div id="viewCamera">
	<div id="cameraBlock">
		<video id="camera--view" autoplay playsinline muted></video>		
		<canvas id="camera--sensor"></canvas>		
		<img id="camera--output" src="//:0" alt="">	   
	</div>
	<div id="buttonBlock">
		<button id="camera--trigger">Shoot!</button>	
		<button id="camera--saver">Save!</button>	
	</div>
</div>	
<script src="/scripts/camera.js"></script>


<!-- change chrome webcam settings chrome://flags/#unsafely-treat-insecure-origin-as-secure -->
<!-- new tuto https://blog.prototypr.io/make-a-camera-web-app-tutorial-part-1-ec284af8dddf -->
<!-- old tuto https://developer.mozilla.org/en-US/docs/Web/API/WebRTC_API/Taking_still_photos -->