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
		while ($data = $req->fetch(PDO::FETCH_ASSOC))
		  $comments[] = new Comment($data);
		return $comments;
	}

	// public function commentBtn($picture_id, $comment_content, $owner_account_id)
	// {
	// 	$values = array(':picture_id' => $picture_id, ':owner_account_id' => $owner_account_id);
		// $query = 'INSERT INTO `comments` (`picture_id`, `owner_account_id`) VALUES (:picture_id, :owner_account_id)';

	// }

	

	// public function comment($picture_id, $owner_account_id)
	// {
	// 	$values = array(':picture_id' => $picture_id, ':owner_account_id' => $owner_account_id);
	// 	try
	// 	{
	// 		$req = $this->getDb()->prepare($query);
	// 		$req->execute($values);
	// 	}
	// 	catch (PDOException $e)
	// 	{
	// 		throw new Exception('Database query error');
	// 	}
	// 	return true;
	// }
}
?>