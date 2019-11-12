<?php
class DeleteManager extends Checker
{
	public function delete()
	{
		if (session_status() == PHP_SESSION_ACTIVE)
		{
			$account_id = $this->getId(session_id());
			$values = array(':account_id' => $account_id);
			$query = "DELETE FROM `users` WHERE `account_id` = :account_id";
			try
			{
				$req = $this->getDb()->prepare($query);
				$req->execute($values);
			}
			catch (PDOException $e)
			{
				throw new Exception('Database query error');
			}
			$values = array(':account_id' => $account_id);
			$query = "DELETE FROM `sessions` WHERE `account_id` = :account_id";
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
}
?>