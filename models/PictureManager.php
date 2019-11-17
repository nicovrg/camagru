<?php
class PictureManager extends Model
{

	// public function uploadPicture()
	// {

	// }

	public function getPicture()
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
			if (is_array($data))
			{
				foreach ($data as $line)
					foreach ($line as $key => $val)
						if ($key === "picture_name")
							$pictures[] = $val;
			}
			return $pictures;
	}
}
?>