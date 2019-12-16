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

function submitLike(pictureId)
{
	const form = document.getElementById(`like-form${pictureId}`);
	form.submit();
}

function submitComment(pictureId)
{
	const form = document.getElementById(`comment-form${pictureId}`);
	form.submit();
}

function submitDelete(pictureId)
{
	const form = document.getElementById(`delete-form${pictureId}`);
	form.submit();
}

function submitFormOne(page)
{
	page = page - 1;
	const pageForm = document.getElementById(`page-form-1`);
	const input = document.getElementById(`input_form_1`);
	input.value = page;
	pageForm.submit();
}

function submitFormTwo(page)
{
	page = page + 1;
	const pageForm = document.getElementById(`page-form-2`);
	const input = document.getElementById(`input_form_2`);
	input.value = page;
	pageForm.submit();
}