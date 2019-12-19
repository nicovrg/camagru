<?php $this->_t = "Camera" ?>
<div id="viewCamera">
	<form action="/camera" method="post" id="formImageWebcam">
		<input type="hidden" id="imageNameWebcam" name="imageNameWebcam">
		<input type="hidden" id="imageDataWebcam" name="imageDataWebcam">
		<input type="hidden" id="filterDataWebcam" name="filterDataWebcam">
	</form>
	<input type="file" id="imageDataFile" name="imageDataFile" style="display: none;">
	<div id="cameraBlock">
		<video id="camera--view" autoplay playsinline muted></video>
		<canvas id="camera--sensor"></canvas>		
	</div>
	<div id="filter">
		<img src="/filter/fox.png" onclick="selectFilter('fox')" id="fox">
		<img src="/filter/tiger.png" onclick="selectFilter('tiger')" id="tiger">
		<img src="/filter/tigre.png" onclick="selectFilter('tigre')" id="tigre">
		<img src="/filter/koala.png" onclick="selectFilter('koala')" id="koala">
		<!-- <img src="/filter/bitcoin.png" onclick=""> -->
		<!-- <img src="/filter/ethereum.png" onclick=""> -->
		<!-- <img src="/filter/safe.png" onclick=""> -->
		<!-- <img src="/filter/institution.png" onclick=""> -->
	</div>
	<div id="buttonBlock">
		<button id="upload--file">Upload</button>
		<button id="camera--trigger">Shoot</button>	
		<button id="camera--saver">Save</button>	
	</div>
</div>
<div id="sidebar">
	<img src="/filter/ethereum.png" onclick="">
</div>
<script src="/scripts/camera.js"></script>


<!-- change chrome webcam settings chrome://flags/#unsafely-treat-insecure-origin-as-secure -->
<!-- new tuto https://blog.prototypr.io/make-a-camera-web-app-tutorial-part-1-ec284af8dddf -->
<!-- old tuto https://developer.mozilla.org/en-US/docs/Web/API/WebRTC_API/Taking_still_photos -->