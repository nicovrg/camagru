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
			$values = array(':picture_id' => $picture_id);
			$query = "SELECT * FROM `pictures`";
			try
			{
				$req = $this->getDb()->prepare($query);
				$req->execute($values);
			}
			catch (PDOException $e)
			{
				throw new Exception('Database query error');
			}
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			//return here or in view?
			// if (is_array($data))
			// {
				// foreach ($data as $line)
				// 	foreach ($line as $key => $val)
				// 		if ($key === "picture_name")
				// 			$pictures[] = $val;
			// }
			return $data;
	}
}
?>