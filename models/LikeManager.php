<?php
class LikeManager extends Checker
{
	public function likeBtn($picture_id, $owner_account_id)
	{
		if (!$this->isLiked($picture_id, $owner_account_id))
			$this->like($picture_id, $owner_account_id);
		else
			$this->dislike($picture_id, $owner_account_id);
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
		$req->closeCursor();
		if (is_array($data))
			return true;
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
		$req->closeCursor();
		return true;
	}

	public function dislike($picture_id, $owner_account_id)
	{
		$values = array(':picture_id' => $picture_id, ':owner_account_id' => $owner_account_id);
		$query = "DELETE FROM `likes` WHERE `picture_id` = :picture_id AND $owner_account_id = :owner_account_id";
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
		return true;
	}
}
?>