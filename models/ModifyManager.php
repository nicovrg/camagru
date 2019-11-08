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
		echo ($username);
		echo ($email);
		if (session_status() == PHP_SESSION_ACTIVE && $username != NULL && $email != NULL)
		{
			if (!$this->checkUsernameSyntax($username))
				throw new Exception('Invalid Username');
			if (!$this->checkEmailSyntax($email))
				throw new Exception('Invalid Email');
			echo (session_id());
			// ':email' => $email,
			$values = array(':username' => $username, ':sid' => session_id());
			$query = "UPDATE `users` SET `username` = :username WHERE `id` = :sid";
			// UPDATE Customers
			// SET ContactName = 'Alfred Schmidt', City= 'Frankfurt'
			// WHERE CustomerID = 1;
			// :username, :email WHERE (users.id = sessions.account_id)
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