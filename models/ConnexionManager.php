<?php
// This class contain the following methods:
	// login() => filter input, get user hash pwd from db and compare them
	// registerLoginSession() => update session_id and account_id in sessions table
	// sessionLogin() => check if user session is valid and active (return true if yes)
	// logout() => reset ConnexionManager attributes to null/false and delete from db user session

class ConnexionManager extends Checker
{
	
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
		$data = $req->fetch(PDO::FETCH_ASSOC);
		if (is_array($data))
		{
			$user = new User($data);
			if (hash('sha256', $password) === $data['password'])
			{
				if ($this->registerLoginSession($user->account_id()))
					return true;
			}
		}
		echo "<script>alert('fail to log')</script>";
		return false;
	}
	
	private function registerLoginSession($account_id)
	{
		if (session_status() == PHP_SESSION_ACTIVE)
		{
			$values = array(':session_id' => session_id(), ':account_id' => $account_id);
			$query = 'INSERT INTO `sessions` (`session_id`, `account_id`) VALUES (:session_id, :account_id)';
			try
			{
				$req = $this->getDb()->prepare($query);
				$req->execute($values);
			}
			catch (PDOException $e)
			{
				throw new Exception('Database query error');
			}
			return true;
		}
		return false;
	}

	public function sessionLogin()
	{
		if (session_status() == PHP_SESSION_ACTIVE)
		{
			$values = array(':sid' => session_id());
			$query = "SELECT * FROM `users`, `sessions` WHERE (`session_id` = :sid)";
			$query = $query." AND (`login_time` >= (NOW() - INTERVAL 7 DAY))";
			$query = $query." AND (users.account_id = sessions.account_id)";
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
			if (is_array($data))
			{
				// echo ("<script type='javascript'>console.log(" . var_dump($data) . ")</script>");
				return new User($data);
			}
		}
		return null;
	}

	public function logout()
	{
		if (session_status() == PHP_SESSION_ACTIVE)
		{
			$values = array(':sid' => session_id());
			$query = "DELETE FROM `sessions` WHERE (`session_id` = :sid)";
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
		return true;
	}
}
?>