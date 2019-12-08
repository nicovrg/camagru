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
		zoomImg.style.width = "60%";
	else if (zoomImg.style.width == "60%")
		zoomImg.style.width = "40%"
	else
		zoomImg.style.width = "80%"
}

function submitComment(pictureId)
{
	const form = document.getElementById(`comment-form${pictureId}`);
	form.submit();
}

function submitLike(pictureId)
{
	const like = document.getElementById(`like-form${pictureId}`);
	like.submit();
}