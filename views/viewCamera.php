<?php $this->_t = "Camera" ?>
<div id="camera">		
	<video id="camera--view" autoplay playsinline></video>		
	<canvas id="camera--sensor"></canvas>		
	<img id="camera--output" src="//:0" alt="">	   
	<button id="camera--trigger">Shoot!</button>	
	<script src="/scripts/camera.js"></script>
</div>	
		




<!-- <div class="camera">
		<video id="video">Video stream not available.</video>
		<button id="startbutton">Take photo</button>
</div>

<canvas id="canvas"></canvas>
	<div class="output">
		<img id="photo" alt="The screen capture will appear in this box.">
	</div> -->

<!-- change chrome webcam settings chrome://flags/#unsafely-treat-insecure-origin-as-secure -->
<!-- new tuto https://blog.prototypr.io/make-a-camera-web-app-tutorial-part-1-ec284af8dddf -->
<!-- old tuto https://developer.mozilla.org/en-US/docs/Web/API/WebRTC_API/Taking_still_photos -->