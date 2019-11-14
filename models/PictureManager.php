<?php
class PictureManager extends Model
{

	public function getPicture()
	{

			$values = array(':username' => $username);
			$query = "UPDATE `users` SET `username` = :username, `email` = :email WHERE `account_id` = :account_id";
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
?>