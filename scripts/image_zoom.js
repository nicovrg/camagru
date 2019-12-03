function closeImg(pictureId) {
	var zoom = document.getElementById(`zoom${pictureId}`);
	zoom.style.display = "none";
}
	
function openImg(pictureId) {
	var zoom = document.getElementById(`zoom${pictureId}`);
	zoom.style.display = "flex";
}

function reduceImg(pictureId) {
	var zoomImg = document.getElementById(`zoom_image${pictureId}`);
	var zoomComment = document.getElementsByClassName("comments_container");
	if (zoomImg.style.width == "80%")
	{
		zoomImg.style.width = "60%";
		zoomComment.style.height = "25em";
		zoomMiddleText.style.margin = "20em";
	}
	else if (zoomImg.style.width == "60%")
	{
		zoomImg.style.width = "40%"
		zoomComment.style.height = "50em";
	}	
	else
	{
		zoomImg.style.width = "80%"
		zoomComment.style.height = "12.5em";
	}
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