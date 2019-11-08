<?php
class ModifyManager extends Checker
{
	// require_once("ConnexionManager.php");
	private $connexion;
	
	public function __construct()
	{
		$this->connexion = new ConnexionManager();
	}

	public function modify_account($username, $email)
	{
		echo ("username = " . $username . "\n");
		echo ("email = " . $email . "\n");
		echo ("session_id = " . session_id() . "\n");
		if (session_status() == PHP_SESSION_ACTIVE && $username != NULL && $email != NULL)
		{
			if (!$this->checkUsernameSyntax($username))
				throw new Exception('Invalid Username');
			if (!$this->checkEmailSyntax($email))
				throw new Exception('Invalid Email');
			$session_id = session_id();
			echo ("session_id = " . $session_id . "\n");
			$account_id = $this->getId($session_id);
			echo ("account_id = " . $account_id . "\n");
			$values = array(':username' => $username, ':account_id' => $account_id);
			$query = "UPDATE `users` SET `username` = :username WHERE `id` = :account_id";
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
	// ':email' => $email,
}
?>