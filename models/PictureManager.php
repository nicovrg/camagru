<?php
class PictureManager extends Model
{
	// This class contain the following methods:
	// getAllPictures() => return an array of all pictures in db

	// public function uploadPicture()
	// {

	// }

	public function getAllPictures()
	{
			return $this->getAll('pictures', Picture);
	}
}
?>