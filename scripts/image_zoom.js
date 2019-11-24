function load_image_zoom() {
	var imgList = document.getElementsByClassName("image_zoom_target");
	var zoom = document.getElementsByClassName("zoom")[0];
	var zoomImg = document.getElementsByClassName("zoom_image")[0];
	var captionText = document.getElementsByClassName("caption");

	for (let i = 0, length = imgList.length; i < length; ++i)
	{
		let img = imgList[i];
		img.onclick = function() {
			zoom.style.display = "block";
			zoomImg.src = this.src;
			captionText.innerHTML = this.alt;
		}

		// img.onkeyup = function keyPress (e) {
		// 	if(e.key === "Escape") 
		// 		zoom.style.display = "none";
		// }
	}
	
	var span = document.getElementsByClassName("close")[0];

	span.onclick = function() {
		zoom.style.display = "none";
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
}