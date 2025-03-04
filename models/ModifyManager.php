<?php
class ModifyManager extends Checker
{
	private $connexion;
	
	public function __construct()
	{
		$this->connexion = new ConnexionManager();
	}

	public function modify_account($username, $email)
	{
		if (session_status() == PHP_SESSION_ACTIVE && $username != NULL && $email != NULL)
		{
			if (!$this->checkUsernameSyntax($username))
				throw new Exception('Invalid Username');
			if (!$this->checkEmailSyntax($email))
				throw new Exception('Invalid Email');
			$session_id = session_id();
			$account_id = $this->getId($session_id);
			$values = array(':username' => $username, ':email' => $email, ':account_id' => $account_id);
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
			$req->closeCursor();
		}
	}
}
?>