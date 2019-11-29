<?php
class CommentManager extends Checker
{
	public function getAllComments()
	{
		return $this->getAll('comments', Comment);
	}

	public function getCommentsPicId($picture_id)
	{
		$values = array(':picture_id' => $picture_id);
		$query = "SELECT * FROM `comments` WHERE `picture_id` = :picture_id";
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
			return $data;
		
		// {
		// 	foreach($data as $key => $val)
		// 		echo ("<script type='text/javascript'>console.log('" . $key . "=" . $val . "')</script>");
		
		// }
		return ;
	}

	public function commentBtn($picture_id, $owner_account_id)
	{
		$values = array(':picture_id' => $picture_id, ':owner_account_id' => $owner_account_id);
		// $query = 'INSERT INTO `comments` (`picture_id`, `owner_account_id`) VALUES (:picture_id, :owner_account_id)';

	}

	

	public function comment($picture_id, $owner_account_id)
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
		return true;
	}
}
?>