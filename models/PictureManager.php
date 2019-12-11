<?php
class PictureManager extends Model
{
	// This class contain the following methods:
	// getAllPictures() => return an array of Picture objects

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
	}

	// public function getPagePictures()
	// {
	// 	// $values = array(':picture_id' => $picture_id, ':comment_content' => $comment_content, ':owner_account_id' => $owner_account_id);
	// 	$query = "SELECT COUNT(*) FROM `pictures`";
	// 	try
	// 	{
	// 		$req = $this->getDb()->prepare($query);
	// 		// $req->execute($values);
	// 		$req->execute();
	// 	}
	// 	catch (PDOException $e)
	// 	{
	// 		throw new Exception('Database query error');
	// 	}
	// 	$data = $req->fetch(PDO::FETCH_ASSOC);
	// 	foreach ($data as $d)
	// 		echo ("<script type='text/javascript'>console.log('" . $d . "')</script>");
	// 	return $this->getAll('pictures', Picture);
	// }
	
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
		foreach ($data as $d)
			echo ("<script type='text/javascript'>console.log('" . $d . "')</script>");
		// return $data[0];
		return $this->getAll('pictures', Picture);

	}

	public function getAllPictures()
	{
		return $this->getAll('pictures', Picture);
	}
}
?>