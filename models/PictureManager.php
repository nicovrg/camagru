<?php
class PictureManager extends Model
{


	public function uploadPicture()
	{

	}

	public function getPicture()
	{
			$query = "SELECT * FROM `pictures`";
			try
			{
				$req = $this->getDb()->prepare($query);
				$req->execute();
			}
			catch (PDOException $e)
			{
				throw new Exception('Database query error');
			}
			if (is_array($data))
			{
				$pictures = $data['picture_name'];
				var_dump($pictures);
			}
	}
}
?>