function closeImg(pictureId) {
	var zoom = document.getElementById(`zoom${pictureId}`);
	zoom.style.display = "none";
}
	
function openImg(pictureId) {
	var zoom = document.getElementById(`zoom${pictureId}`);
	zoom.style.display = "block";
	var zoomImg = document.getElementById(`zoom_image${pictureId}`);
}	
	// console.log("imgList = ");
	// console.log(imgList);
	// console.log("zoom = ");
	// console.log(zoom);
	// console.log("zoomImg = ");
	// console.log(zoomImg);
	// console.log("captionText = ");
	// console.log(captionText);
	// console.log("span = ");
	// console.log(span);