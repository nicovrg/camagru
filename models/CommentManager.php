<?php
class CommentManager extends Checker
{
	public function commentBtn($picture_id, $owner_account_id)
	{
		$values = array(':picture_id' => $picture_id, ':owner_account_id' => $owner_account_id);
		// $query = 'INSERT INTO `comments` (`picture_id`, `owner_account_id`) VALUES (:picture_id, :owner_account_id)';

	}

	public function like($picture_id, $owner_account_id)
	{
		$values = array(':picture_id' => $picture_id, ':owner_account_id' => $owner_account_id);
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Database query error');
		}
		echo ("<script type='text/javascript'>console.log('PICTURE HAS JUST BEEN LIKED')</script>");
		return true;
	}
}
?>