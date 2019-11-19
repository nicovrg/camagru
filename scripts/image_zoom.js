function load_image_zoom() {
	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var imgList = document.getElementsByClassName("gallery_img");
	var modal = document.getElementsByClassName("modal")[0];
	var modalImg = document.getElementsByClassName("modal-content")[0];
	var captionText = document.getElementsByClassName("caption")[0];
	
	for (let i = 0, length = imgList.length; i < length; ++i)
	{
		let img = imgList[i];
		img.onclick = function() {
			modal.style.display = "block";
			modalImg.src = this.src;
			captionText.innerHTML = this.alt;
		}
	};
	
	// When the user clicks on <span> (x), close the modal
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	span.onclick = function() {
		modal.style.display = "none";
	}
	
	console.log("imgList = ");
	console.log(imgList);
	console.log("modal = ");
	console.log(modal);
	console.log("modalImg = ");
	console.log(modalImg);
	console.log("captionText = ");
	console.log(captionText);
	console.log("span = ");
	console.log(span);
}


// function load_image_zoom() {
// 	// Get the modal
// 	var modal = document.getElementById('myModal');
	
// 	// Get the image and insert it inside the modal - use its "alt" text as a caption
// 	var img = document.getElementById('myImg');
// 	var modalImg = document.getElementById("img01");
// 	var captionText = document.getElementById("caption");
	
// 	img.onclick = function() {
// 	  modal.style.display = "block";
// 	  modalImg.src = this.src;
// 	  captionText.innerHTML = this.alt;
// 	}
	
// 	// Get the <span> element that closes the modal
// 	var span = document.getElementsByClassName("close")[0];
	
// 	// When the user clicks on <span> (x), close the modal
// 	span.onclick = function() {
// 	  modal.style.display = "none";
// 	}
	
// 	console.log("modal = ");
// 	console.log(modal);
// 	console.log("modalImg = ");
// 	console.log(modalImg);
// 	console.log("captionText = ");
// 	console.log(captionText);
// 	console.log("span = ");
// 	console.log(span);
// }