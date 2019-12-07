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
        track = stream.getTracks();
        cameraView.srcObject = stream;
    })
    .catch(function(error) {
        console.error("Oops. Something is broken.", error);
    });
    // .then(function() {
    //     cameraSensor.width = cameraView.videoWidth;
    //     cameraSensor.height = cameraView.videoHeight;
    // });
}
// Take a picture when cameraTrigger is tapped
cameraTrigger.onclick = () => {
    cameraSensor.width = cameraView.videoWidth;
    cameraSensor.height = cameraView.videoHeight;
    cameraOutput.width = cameraView.videoWidth;
    cameraOutput.height = cameraView.videoHeight;
    cameraSensor.getContext("2d").drawImage(cameraView, 0, 0);
    console.log(cameraSensor.toDataURL("image/png"));
    cameraOutput.src = cameraSensor.toDataURL("image/png");
};
// Start the video stream when the window loads
window.addEventListener("load", cameraStart, false);

window.onload = () => {
    cameraStart();
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

*/
