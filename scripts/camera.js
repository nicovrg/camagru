var picUpload = false;
var fileUpload = false;
var filterSelected = null;
var constraints = { video: { width: 320, height: 180 }, audio: false };
const cameraView = document.querySelector("#camera--view");
const cameraSensor = document.querySelector("#camera--sensor");
const cameraTrigger = document.querySelector("#camera--trigger");
const cameraSaver = document.querySelector("#camera--saver");
const uploadFile = document.querySelector("#upload--file");
const filterCanvasUp = document.querySelector("#canvas--filter");
const filterCanvas = document.getElementById("filterCanvas");
const formImageWebcam = document.getElementById("formImageWebcam");
const pictureInput = document.getElementById("imageDataWebcam");
const filterInput = document.getElementById('filterDataWebcam');

function cameraStart() {
	navigator.mediaDevices
		.getUserMedia(constraints)
		.then(function(stream) {
			track = stream.getTracks();
			cameraView.srcObject = stream;
		}).catch(function(error) {});
}

function uploadImg(image) {
	filterCanvas.width = cameraSensor.width;
	filterCanvas.height = cameraSensor.height;
	let ctx = filterCanvas.getContext('2d');
	let filter = new Image();
	filter.src = `/filter/${filterSelected}.png`;
	ctx.drawImage(filter, 20, 20, 100, 100);
	filterInput.value = filterCanvas.toDataURL("image/png");
	pictureInput.value = image;
	formImageWebcam.submit();
}

cameraTrigger.onclick = () => {
	cameraSensor.style.display = "block";
	cameraSensor.width = cameraView.videoWidth;
	cameraSensor.height = cameraView.videoHeight;
	filterCanvasUp.width = cameraView.videoWidth;
	filterCanvasUp.height = cameraView.videoHeight;
	cameraSensor.getContext("2d").drawImage(cameraView, 0, 0);
	picUpload = true;
	console.log(picUpload);
};

cameraSaver.onclick = () => {
	console.log(`fileUpload = ${fileUpload}`);
	console.log(`picUpload = ${picUpload}`);
	console.log(`filterSelected = ${filterSelected}`);
	if ((fileUpload == false && picUpload == false) || filterSelected == null) {
		alert("you need both a picture and a filter to save because of strange guidelines");
		return ;
	}
	var name = prompt("Enter picture name:");
	var imageNameWebcam = document.getElementById("imageNameWebcam");
	if (name != null)
		imageNameWebcam.value = name;
	uploadImg(cameraSensor.toDataURL("image/png"));
};

uploadFile.onclick = () => {
	var imageDataFile = document.getElementById("imageDataFile");
	imageDataFile.click();
	fileUpload = true;
	console.log(fileUpload);
}

var scaleImgCanvas = function(canvas, imageObj, context) {
	var renderableHeight, renderableWidth, xStart, yStart;
	var imageAspectRatio = imageObj.width / imageObj.height;
	var canvasAspectRatio = canvas.width / canvas.height;
	if (imageAspectRatio < canvasAspectRatio) {
		renderableHeight = canvas.height;
		renderableWidth = imageObj.width * (renderableHeight / imageObj.height);
		xStart = (canvas.width - renderableWidth) / 2;
		yStart = 0;
	}
	else if (imageAspectRatio > canvasAspectRatio) {
		renderableWidth = canvas.width
		renderableHeight = imageObj.height * (renderableWidth / imageObj.width);
		xStart = 0;
		yStart = (canvas.height - renderableHeight) / 2;
	}
	else {
		renderableHeight = canvas.height;
		renderableWidth = canvas.width;
		xStart = 0;
		yStart = 0;
	}
	context.drawImage(imageObj, xStart, yStart, renderableWidth, renderableHeight);
};

function draw() {
	cameraSensor.width = cameraView.videoWidth;
	cameraSensor.height = cameraView.videoWidth;
	this.width = cameraSensor.width;
	this.height = cameraSensor.height;
	var context = cameraSensor.getContext('2d');
	scaleImgCanvas(cameraSensor, this, context);
}

function selectFilter(filterName) {
	var filter = document.getElementById(`${filterName}`);
	var filterInput = document.getElementById("filterDataWebcam");
	var ctx = filterCanvasUp.getContext('2d');
	filterSelected = filterName;
	console.log(filterSelected);
	if (filter.style.borderColor == "lime") {
		filter.style.borderColor = "transparent";
		ctx.clearRect(0, 0, filterCanvasUp.width, filterCanvasUp.height);
	}
	else {
		filter.style.borderColor = "lime";
		let tmpImg = new Image();
		tmpImg.src = `/filter/${filterSelected}.png`;
		ctx.drawImage(tmpImg, 20, 20, 100, 100);
	}
	filterInput.value = filter.src;
}

function deletePicture(pictureId) {
	const formDeletePicture = document.getElementById("formDeletePicture");
	const inputDeletePicture = document.getElementById("inputDeletePicture");
	inputDeletePicture.value = pictureId;
	formDeletePicture.submit();
}

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

fitImageOn:
	If image's aspect ratio is less than canvas's we fit on height and place the image centrally along width
	Else if image's aspect ratio is greater than canvas's we fit on width and place the image centrally along height
	Else we keep aspect ratio

tuto link: https://blog.prototypr.io/make-a-camera-web-app-tutorial-part-1-ec284af8dddf
tuto scale image to canvas: https://sadique.io/blog/2013/10/03/fitting-an-image-in-to-a-canvas-object/

pratique:
	http://192.168.99.100/?page=2
	console.log(`imageObj = ${imageObj}`);
	console.log(`xStart = ${xStart}`);
	console.log(`yStart = ${yStart}`);
	console.log(`renderableWidth = ${renderableWidth}`);
	console.log(`renderableHeight = ${renderableHeight}`);
*/
