<?php
class PictureManager extends Model
{
	// This class contain the following methods:
	// uploadFile() => add an image from user file to server storage and add path to db
	// uploadPicture() => add an image from webcam to server storage and add path to db
	// getAllPictures() => return an array of Picture objects
	// getPagePictures() => return an array of Picture objects for the selected page
	// getNbPicturesDb() => return the number of picture in data base
	// deletePicture() => delete the picture from data base and from server

	public function combinePicture($picture_data, $filter_data)
	{
		$width = 200;
		$height = 200;
		$dest_image = imagecreatetruecolor($width, $height);
		//make sure the transparency information is saved
		imagesavealpha($dest_image, true);
		//create a fully transparent background (127 means fully transparent)
		$trans_background = imagecolorallocatealpha($dest_image, 0, 0, 0, 127);
		//fill the image with a transparent background
		imagefill($dest_image, 0, 0, $trans_background);
		//take create image resources out of the 3 pngs we want to merge into destination image
		$picture_data = imagecreatefrompng('1.png');
		$filter_data = imagecreatefrompng('2.png');
		//copy each png file on top of the destination (result) png
		imagecopy($dest_image, $picture_data, 0, 0, 0, 0, $width, $height);
		imagecopy($dest_image, $filter_data, 0, 0, 0, 0, $width, $height);
		//send the appropriate headers and output the image in the browser
		header('Content-Type: image/png');
		imagepng($dest_image);
		return $dest_image;
	}

	public function uploadPicture($picture_name, $picture_data, $filter_data, $picture_owner_id)
	{
		echo ("<script type='text/javascript'>console.log('picture_data = $picture_data')</script>");
		echo ("<script type='text/javascript'>console.log('filter_data = $filter_data')</script>");
		$picture_name = htmlspecialchars($picture_name);
		while (file_exists("img/" . $picture_name . ".png"))
			$picture_name = $picture_name . "_";
		$path = "img/" . $picture_name . ".png";
		$picture_data = explode(",", $picture_data)[1];
		$picture_data = base64_decode($picture_data);
		file_put_contents($path, $picture_data);
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
		{
			$array[] = new Picture($data);
			$i++;
		}
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

	public function getAllPictures()
	{
		return $this->getAll('pictures', Picture);
	}
}
?>