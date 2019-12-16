<?php
class PictureManager extends Model
{
	// This class contain the following methods:
	// uploadPicture() => add an image to server storage and add path to db
	// getAllPictures() => return an array of Picture objects
	// getPagePictures() => return an array of Picture objects for the selected page
	// getNbPicturesDb() => return the number of picture in data base
	// deletePicture() => delete the picture from data base and from server

	public function uploadPicture($picture_name, $picture_data, $picture_owner_id)
	{
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