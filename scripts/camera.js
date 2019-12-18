var constraints = { video: { width: 640, height: 360 }, audio: false };
const cameraView = document.querySelector("#camera--view");
const cameraSensor = document.querySelector("#camera--sensor");
const cameraTrigger = document.querySelector("#camera--trigger");
const cameraSaver = document.querySelector("#camera--saver");
const uploadFile = document.querySelector("#upload--file");

function cameraStart() {
	navigator.mediaDevices
		.getUserMedia(constraints)
		.then(function(stream) {
		track = stream.getTracks();
		cameraView.srcObject = stream;
	})
	.catch(function(error) {
		console.error("fail to access webcam stream", error);
	});
}

function uploadImg(image)
{
	const imageDataWebcam = document.getElementById("imageDataWebcam");
	const formImageWebcam = document.getElementById("formImageWebcam");
	imageDataWebcam.value = image;
	formImageWebcam.submit();
}

cameraTrigger.onclick = () => {
	cameraSensor.style.display = "block";
	cameraSensor.width = cameraView.videoWidth;
	cameraSensor.height = cameraView.videoHeight;
	cameraSensor.getContext("2d").drawImage(cameraView, 0, 0);
};

cameraSaver.onclick = () => {
	var name = prompt("Enter picture name:");
	var imageNameWebcam = document.getElementById("imageNameWebcam");
	if (name != null)
		imageNameWebcam.value = name;
	uploadImg(cameraSensor.toDataURL("image/png"));
};

uploadFile.onclick = () => {
	console.log("send image form in js");
	var imageDataFile = document.getElementById("imageDataFile");
	var formImageFile = document.getElementById("formImageFile");
	imageDataFile.click();
	// cameraSensor.getContext("2d").drawImage(cameraView, 0, 0);
	// formImageFile.submit();
}

function draw() {
	cameraSensor.width = cameraView.videoWidth;
	cameraSensor.height = cameraView.videoWidth;
	var ctx = cameraSensor.getContext('2d');
	ctx.drawImage(this, 0, 0, cameraView.videoWidth, cameraView.videoHeight);
}

// function uploadFile() {	
// 	document.getElementById("imageDataFile").onchange = function(e) {
// 		var img = new Image();
// 		img.onload = draw;
// 		img.src = URL.createObjectURL(this.files[0]);
// 	};
// }

window.onload = () => {
	cameraStart();
	document.getElementById("imageDataFile").onchange = function(e) {
		var img = new Image();
		img.onload = draw;
		img.src = URL.createObjectURL(this.files[0]);
	};
	load_particules();
}

/*

navigator:
	represents the state and the identity of the user agent.
	allow scripts to query it and to register themselves to carry on some activities

mediaDevices:
	provides access to connected media input devices like cameras and microphones

getUserMedia:
	request user permission to open a mediastream

then:
	then() method returns a promise which takes up to two arguments: 
		- callback functions for the success
		- failure cases of the promise

getContext:
	return a context ("drawing on canvas"), or null if context id is not supported

drawImage:
	draw inside a canvas
	syntax => ...drawImage(image, dx, dy);

	tuto link: https://blog.prototypr.io/make-a-camera-web-app-tutorial-part-1-ec284af8dddf

	http://192.168.99.100/?page=2
*/
