<?php

// This class contain the following methods:
	// login() => filter input, get user hash pwd from db and compare them
	// registerLoginSession() => update session_id and account_id in sessions table
	// sessionLogin() => check if user session is valid and active (return true if yes)
	// logout() => reset ConnexionManager attributes to null/false and delete from db user session

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
			$query = "SELECT * FROM `users`, `sessions` WHERE (`session_id` = :sid)";
			$query = $query." AND (`login_time` >= (NOW() - INTERVAL 7 DAY))";
			$query = $query." AND (`account_id` = `account_id`)";
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
				echo $this->id;
				echo "true";
				return true;
			}
		}
		echo "false";
		return false;
	}

	// public function check()
	// {
	// 	echo "logout</br>";
	// 	// echo $_SESSION['test'];
	// 	if ($this->sessionLogin() === true)
	// 		echo "user is log";
	// 	else
	// 		echo "user is not log";
		
	// }

	public function logout()
	{
		var_dump($this->id);
		global $id;
		var_dump($this->id);
		if (is_null($this->id))
			return ;
		$this->id = NULL;
		$this->username = NULL;
		$this->authenticated = false;
		echo "<p>before</p>";
		if (session_status() == PHP_SESSION_ACTIVE)
		{
			echo "<p>after</p>";
			$query = "DELETE FROM `sessions` WHERE (`session_id` = :sid)";
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
		}
	}

}
?>
