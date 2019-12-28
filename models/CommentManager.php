<?php
class CommentManager extends Checker
{
	public function getAllComments()
	{
		return $this->getAll('comments', Comment);
	}

	private function sendmail($email, $token)
	{
		$to = $email;
		$subject = "activation code";
		$message = "activation link:" . $_SERVER['SERVER_NAME'] . "/activation" . "/" . $token;
		$headers = 'From: guillaume@guillaumerx.fr' . "\r\n" .
     				'Reply-To: guillaume@guillaumerx.fr' . "\r\n" .
     				'X-Mailer: PHP/' . phpversion();
		return (mail($to, $subject, $message, $headers));
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
		if ($this->sendmail("nicolasvergne88@gmail.com", "hello"))
			echo ("<script type='text/javascript'>console.log('work')</script>");
		else
			echo ("<script type='text/javascript'>console.log('didnt work')</script>");
		// if (mail("nicolasvergne88@gmail.com", "test", "test"))
		// 	echo ("<script type='text/javascript'>console.log('mail supposed to be sent')</script>");
		// else
		// 	echo ("<script type='text/javascript'>console.log('fail to send mail')</script>");
	}



	// public function getCommentsPicId($picture_id)
	// {
	// 	$values = array(':picture_id' => $picture_id);
	// 	$query = "SELECT * FROM `comments` WHERE `picture_id` = :picture_id";
	// 	try
	// 	{
	// 		$req = $this->getDb()->prepare($query);
	// 		$req->execute($values);
	// 	}
	// 	catch (PDOException $e)
	// 	{
	// 		throw new Exception('Database query error');
	// 	}
	// 	while ($data = $req->fetch(PDO::FETCH_ASSOC))
	// 	  $comments[] = new Comment($data);
	// $req->closeCursor();
	// 	return $comments;
	// }
}
?>