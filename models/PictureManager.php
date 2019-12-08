<?php
class PictureManager extends Model
{
	// This class contain the following methods:
	// getAllPictures() => return an array of Picture objects

	public function uploadPicture($picture_name, $picture_data, $picture_owner_id)
	{
		// echo ("<script type='text/javascript'>console.log('" . . "')</script>");
		$values = array(':picture_owner_id' => $picture_owner_id, ':picture_name' => $picture_name, ':picture_data' => $picture_data);
		$query = "INSERT INTO `pictures` (`picture_owner_id`, `picture_name`, `picture_data`) VALUES (:picture_owner_id, :picture_name, :picture_data)";
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Database query error');
		}
		echo ("<script type='text/javascript'>console.log('ending uploadPicture')</script>");
		// echo ("<script type='text/javascript'>console.log('$image')</script>");
	}

	public function getAllPictures()
	{
		return $this->getAll('pictures', Picture);
	}

	// public function getPictureId()
}
?>