<?php
class PictureManager extends Model
{
	// This class contain the following methods:
	// getAllPictures() => return an array of Picture objects

	public function uploadPicture($picture_name, $picture_data, $picture_owner_id)
	{
		$picture_name = "4";
		$file = "img/" . $picture_name . ".png";
		// clearstatcache();
		// $picture_data = str_replace(' ', '+', $picture_data);
		echo ("<script type='text/javascript'>console.log('======== start ========')</script>");
		echo ("<script type='text/javascript'>console.log('$picture_data')</script>");
		$picture_data = base64_decode($picture_data);
		echo ("<script type='text/javascript'>console.log('$picture_data')</script>");
		echo ("<script type='text/javascript'>console.log('======== after decode ========')</script>");
		file_put_contents($file, $picture_data);
		$picture_data = base64_encode($picture_data);
		echo ("<script type='text/javascript'>console.log('======== after encode ========')</script>");
		echo ("<script type='text/javascript'>console.log('$picture_data')</script>");
		echo ("<script type='text/javascript'>console.log('========END========')</script>");
		// $values = array(':picture_owner_id' => $picture_owner_id, ':picture_name' => $picture_name, ':picture_data' => $picture_data);
		// $query = "INSERT INTO `pictures` (`picture_owner_id`, `picture_name`, `picture_data`) VALUES (:picture_owner_id, :picture_name, :picture_data)";
		// try
		// {
		// 	$req = $this->getDb()->prepare($query);
		// 	$req->execute($values);
		// }
		// catch (PDOException $e)
		// {
		// 	throw new Exception('Database query error');
		// }
		// echo ("<script type='text/javascript'>console.log('ending uploadPicture')</script>");
		// echo ("<script type='text/javascript'>console.log('$image')</script>");
	}

	public function getAllPictures()
	{
		return $this->getAll('pictures', Picture);
	}

	// public function getPictureId()
}
?>