// Set constraints for the video stream
var constraints = { video: { facingMode: "user" }, audio: false };
// Define constants
const cameraView = document.querySelector("#camera--view");
const cameraSensor = document.querySelector("#camera--sensor");
const cameraOutput = document.querySelector("#camera--output");
const cameraTrigger = document.querySelector("#camera--trigger");
// Access the device camera and stream to cameraView
function cameraStart() {
    navigator.mediaDevices
        .getUserMedia(constraints)
        .then(function(stream) {
        track = stream.getTracks()[0];
        cameraView.srcObject = stream;
    })
    .catch(function(error) {
        console.error("Oops. Something is broken.", error);
    });
}
// Take a picture when cameraTrigger is tapped
cameraTrigger.onclick = function() {
    cameraSensor.width = cameraView.videoWidth;
    cameraSensor.height = cameraView.videoHeight;
    cameraSensor.getContext("2d").drawImage(cameraView, 0, 0);
    console.log(cameraSensor.toDataURL("image/png"));
};
// Start the video stream when the window loads
window.addEventListener("load", cameraStart, false);

window.onload = () => {
    cameraStart();
    load_particules();
}


/*
Navigator interface: 
	represents the state and the identity of the user agent.
	allow scripts to query it and to register themselves to carry on some activities

MediaDevices:
	provides access to connected media input devices like cameras and microphones

GetUserMedia:
	request user permission to open a mediastream

Then:
	then() method returns a promise which takes up to two arguments: 
		- callback functions for the success
		- failure cases of the promise


	tuto link: https://blog.prototypr.io/make-a-camera-web-app-tutorial-part-1-ec284af8dddf
*/
