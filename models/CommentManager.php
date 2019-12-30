<?php
class CommentManager extends Checker
{
	public function getAllComments()
	{
		return $this->getAll('comments', Comment);
	}

	private function sendmail($email, $comment_content)
	{
		$to = $email;
		$subject = "new comment";
		$message = "you've got a new comment\n\n" . $comment_content;
		$headers = 'From: guillaume@guillaumerx.fr' . "\r\n" . 'Reply-To: guillaume@guillaumerx.fr' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		return (mail($to, $subject, $message, $headers));
	}

	public function isUserMailActivated($account_id)
	{
		$values = array(':account_id' => $account_id);
		$query = "SELECT * FROM `users` WHERE (`account_id` = :account_id)";
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
			$data['mail'] == 1 ? $ret = true : $ret = false;
		return $ret;
	}

	public function commentBtn($picture_id, $comment_content, $owner_account_id)
	{
		$comment_content = htmlspecialchars($comment_content);
		$values = array(':picture_id' => $picture_id, ':comment_content' => $comment_content, ':owner_account_id' => $owner_account_id);
		$query = 'INSERT INTO `comments` (`picture_id`, `comment_content`, `owner_account_id`) VALUES (:picture_id, :comment_content, :owner_account_id)';
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
		if ($this->alertUserOne($picture_id, $comment_content))
			return true;
		return false;
	}

	public function alertUserOne($picture_id, $comment_content)
	{
		$values = array(':picture_id' => $picture_id);
		$query = 'SELECT * FROM `pictures` WHERE (`picture_id` = :picture_id)';
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
			$picture_owner = $data['picture_owner_id'];
		if ($this->alertUserTwo($comment_content, $picture_owner))
			return true;
		return false;
	}

	public function alertUserTwo($comment_content, $picture_owner)
	{
		$values = array(':picture_owner' => $picture_owner);
		$query = 'SELECT * FROM `users` WHERE (`account_id` = :picture_owner)';
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
		if (is_array($data) && $this->isUserMailActivated($picture_owner))
			$email = $data['email'];
		if ($email && $this->sendmail($email, $comment_content))
			return true;
		return false;
	}
}
?>