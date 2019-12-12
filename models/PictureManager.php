<?php
class PictureManager extends Model
{
	// This class contain the following methods:
	// uploadPicture() => add an image to server storage and add path to db
	// getAllPictures() => return an array of Picture objects
	// getPagePictures() => return an array of Picture objects for the selected page
	// getNbPicturesDb() => return the number of picture in data base

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
		$i = 0;
		$nbPictures = $this->getNbPicturesDb();
		$minPage = $nbPage * 9;
		$maxPage = $nbPage * 9 + 9;
		echo ("<script type='text/javascript'>console.log('nbPage = " . $nbPage . "\\nminPage = " . $minPage . "\\nmaxPage = " . $maxPage . "\\nnbPictures = " . $nbPictures . "')</script>");
		$query = "SELECT * FROM `pictures` limit $minPage, $maxPage";
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
		echo ("<script type='text/javascript'>console.log('nbPicPerPage = " . $i . "')</script>");
		return $array;
		$req->closeCursor();
	}

	public function getAllPictures()
	{
		return $this->getAll('pictures', Picture);
	}
}
?>