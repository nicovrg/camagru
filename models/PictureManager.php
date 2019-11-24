<?php
class PictureManager extends Model
{
	// This class contain the following methods:
	// getAllPictures() => return an array of Picture objects

	// public function uploadPicture()
	// {

	// }

	public function getAllPictures()
	{
		return $this->getAll('pictures', Picture);
	}

	public function getPictureId()
	{

	}

	//click on like btn
	//like trigger php LikeManager
	//LikeManager ask to PictureManager the picture id of the picture
	//LikeManager check if this picture as already been liked by user
	//if yes delete from like 
	//else insert into like
}
?>