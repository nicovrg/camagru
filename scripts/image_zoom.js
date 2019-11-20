function load_image_zoom() {
	var imgList = document.getElementsByClassName("gallery_img");
	var modal = document.getElementsByClassName("modal")[0];
	var modalImg = document.getElementsByClassName("modal-content")[0];
	var captionText = document.getElementsByClassName("caption");

	for (let i = 0, length = imgList.length; i < length; ++i)
	{
		let img = imgList[i];
		img.onclick = function() {
			modal.style.display = "block";
			modalImg.src = this.src;
			captionText.innerHTML = this.alt;
		}

		// img.onkeyup = function keyPress (e) {
		// 	if(e.key === "Escape") 
		// 		modal.style.display = "none";
		// }
	}
	
	var span = document.getElementsByClassName("close")[0];

	span.onclick = function() {
		modal.style.display = "none";
	}
	
	
	// console.log("imgList = ");
	// console.log(imgList);
	// console.log("modal = ");
	// console.log(modal);
	// console.log("modalImg = ");
	// console.log(modalImg);
	// console.log("captionText = ");
	// console.log(captionText);
	// console.log("span = ");
	// console.log(span);
}