<?php
class LikeManager extends Checker
{
	public function likeBtn($picture_id, $owner_account_id)
	{
		if ($this->isLiked($picture_id, $owner_account_id) == false)
			$this->like($picture_id, $owner_account_id);
		// else
			// dislike($picture_id, $owner_account_id);
	}

	public function isLiked($picture_id, $owner_account_id)
	{
		$values = array(':picture_id' => $picture_id, ':owner_account_id' => $owner_account_id);
		$query = "SELECT * FROM `likes` WHERE `picture_id` = :picture_id AND `owner_account_id` = :owner_account_id";
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Database query error');
		}
		$data = $req->fetch(PDO::FETCH_ASSOC);
		if (is_array($data))
		{
			echo ("<script type='text/javascript'>console.log('INSIDE IS ARRAY')</script>");
			foreach($data as $key => $val)
				echo ("<script type='text/javascript'>console.log('" . $key . "=" . $val . "')</script>");
				return true;
		}
		return false;
	}

	public function like($picture_id, $owner_account_id)
	{
		$values = array(':picture_id' => $picture_id, ':owner_account_id' => $owner_account_id);
		$query = 'INSERT INTO `likes` (`picture_id`, `owner_account_id`) VALUES (:picture_id, :owner_account_id)';
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

	// public function dislike($picture_id, $owner_account_id)
	// {
	// 	$values = array(':picture_id' => $picture_id);

	// }

}
?>