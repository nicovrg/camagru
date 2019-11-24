<?php
class LikeManager extends Checker
{
	public function like()
	{
		if (session_status() == PHP_SESSION_ACTIVE)
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
	}

	public function dislike()
	{
		if (session_status() == PHP_SESSION_ACTIVE)
		{
			$values = array(':picture_id' => $picture_id)
		}
	}

}
?>