<?php
class PictureManager extends Model
{
	// This class contain the following methods:
	// uploadFile() => add an image from user file to server storage and add path to db
	// uploadPicture() => add an image from webcam to server storage and add path to db
	// getAllPictures() => return an array of Picture objects
	// getPagePictures() => return an array of Picture objects for the selected page
	// getNbPicturesDb() => return the number of picture in data base
	// getRecentPictures() => return an array of picture taken by the user in the last 20 minutes
	// deletePicture() => delete the picture from data base and from server

	public function combinePicture($path, $picture_data, $filter_data)
	{
		if (!$picture_data)
			return false;
		$width = 200;
		$height = 200;
		$dest_image = imagecreatetruecolor($width, $height);
		imagesavealpha($dest_image, true);
		$trans_background = imagecolorallocatealpha($dest_image, 0, 0, 0, 127);
		imagefill($dest_image, 0, 0, $trans_background);
		$picture_string = imagecreatefromstring($picture_data);
		$filter_string = imagecreatefromstring($filter_data);
		imagecopy($dest_image, $picture_string, 0, 0, 0, 0, $width, $height);
		imagecopy($dest_image, $filter_string, 0, 0, 0, 0, $width, $height);
		imagepng($dest_image, $path);
		return true;
	}

	public function uploadPicture($picture_name, $picture_data, $filter_data, $picture_owner_id)
	{
		if (!$picture_name || $picture_name != htmlspecialchars($picture_name) || strlen($picture_name) > 200)
			$picture_name = "_";
		while (file_exists("img/" . $picture_name . ".png"))
			$picture_name = $picture_name . "_";
		$path = "img/" . $picture_name . ".png";
		if (!$picture_data)
			return ;
		$picture_data = base64_decode(explode(",", $picture_data)[1]);
		$filter_data = base64_decode(explode(",", $filter_data)[1]);
		if (!$this->combinePicture($path, $picture_data, $filter_data))
			return false;
		$values = array(':picture_owner_id' => $picture_owner_id, ':picture_path' => $path);
		$query = "INSERT INTO `pictures` (`picture_owner_id`, `picture_path`) VALUES (:picture_owner_id, :picture_path)";
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Database query error');
		}
		$req->closeCursor();
	}

	public function getNbPicturesDb()
	{
		$query = "SELECT COUNT(*) FROM `pictures`";
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute();
		}
		catch (PDOException $e)
		{
			throw new Exception('Database query error');
		}
		$data = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
		$nblines = 0;
		foreach ($data as $res)
			$nblines = $res;
		return $nblines;
	}

	public function getPagePictures($nbPage)
	{
		$nbPictures = $this->getNbPicturesDb();
		$limit = 9;
		$offset = $nbPage * 9;
		$query = "SELECT * FROM `pictures` limit $offset, $limit";
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute();
		}
		catch (PDOException $e)
		{
			throw new Exception('Database query error');
		}
		while ($data = $req->fetch(PDO::FETCH_ASSOC))
			$array[] = new Picture($data);
		$req->closeCursor();
		return $array;
	}

	public function deletePicture($picture_id)
	{
		$values = array(':picture_id' => $picture_id);
		$query = "SELECT * FROM `pictures` WHERE (`picture_id` = :picture_id)";
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
		$res = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
		$values = array(':picture_id' => $picture_id);
		$query = "DELETE FROM `pictures` WHERE (`picture_id` = :picture_id)";
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
		$req->closeCursor();
		if (file_exists($res['picture_path']))
			unlink($res['picture_path']);
		return true;
	}

	public function getRecentPictures($picture_owner)
	{
		$values = array(':picture_owner' => $picture_owner);
		$query = "SELECT * FROM `pictures` WHERE (`picture_owner_id` = :picture_owner)";
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Database query error');
		}
		while ($data = $req->fetch(PDO::FETCH_ASSOC))
			$array[] = new Picture($data);
		$req->closeCursor();
		return $array;
	}

	public function getAllPictures()
	{
		return $this->getAll('pictures', Picture);
	}
}
/*
combinePicture:
	make sure the transparency information is saved
	create a fully transparent background (127 means fully transparent)
	fill the image with a transparent background
	take create image resources out of the 3 pngs we want to merge into destination image
	copy each png file on top of the destination (result) png
	send the appropriate headers and output the image in the browser
*/
?>