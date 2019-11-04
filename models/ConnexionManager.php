<?php

// This class contain the following methods:
	// login() => filter input, get user hash pwd from db and compare them
	// registerLoginSession() => update session_id and account_id in sessions table
	// sessionLogin() => check if user session is valid and active (return true if yes)

class ConnexionManager extends Checker
{
	private $id;
	private $username;
	private $authenticated;
	
    public function login($username, $password)
	{
		$username = trim($username);
		
		if (!$this->checkUsernameSyntax($username))
			return false;
		if (!$this->checkPasswordSyntax($password, $password))
			return false;
        $values = array(':username' => $username);
		$query = "SELECT * FROM `users` WHERE (`username` = :username)";		
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute($values);
		}
		catch (PDOException $e)
		{
		   throw new Exception('Database query error');
		}
		$res = $req->fetch(PDO::FETCH_ASSOC);
		if (is_array($res))
		{
			if (hash('sha256', $password) === $res['password'])
			{
				$this->id = intval($res['id'], 10);
				$this->username = $username;
				$this->authenticated = true;
				$this->registerLoginSession();
				return true;
			}
		}
		echo "<script>alert('fail to log')</script>";
		return false;
	}
	
	private function registerLoginSession()
	{
		if (session_status() == PHP_SESSION_ACTIVE)
		{
			$query = 'REPLACE INTO `sessions` (`session_id`, `account_id`, login_time) VALUES (:sessionId, :accountId, NOW())';
			$values = array(':sessionId' => session_id(), ':accountId' => $this->id);
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

	public function sessionLogin()
	{
		if (session_status() == PHP_SESSION_ACTIVE)
		{
			$query = "SELECT * FROM `users`, `sessions` WHERE (`sessions.session_id` = :sid)";
			$query = $query." AND (`sessions.login_time` >= (NOW() - INTERVAL 7 DAY))";
			$query = $query." AND (`sessions.account_id` = `sessions.account_id`)";
			echo $query;
			$values = array(':sid' => session_id());
			try
			{
				$req = $this->getDb()->prepare($query);
				$req->execute($values);
			}
			catch (PDOException $e)
			{
			   throw new Exception('Database query error');
			}
			$res = $req->fetch(PDO::FETCH_ASSOC);
			if (is_array($res))
			{
				$this->id = intval($res['account_id'], 10);
				$this->name = $res['account_name'];
				$this->authenticated = true;
				return true;
			}
		}
		return false;
	}
}
?>
