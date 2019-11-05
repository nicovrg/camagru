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
				if ($this->registerLoginSession($user->id()))
					return true;
			}
		}
		echo "<script>alert('fail to log')</script>";
		return false;
	}
	
	private function registerLoginSession($id)
	{
		if (session_status() == PHP_SESSION_ACTIVE)
		{
			$query = 'INSERT INTO `sessions` (`session_id`, `account_id`) VALUES (:sessionId, :accountId)';
			$values = array(':sessionId' => session_id(), ':accountId' => $id);
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
			$data = $req->fetch(PDO::FETCH_ASSOC);
			if (is_array($data))
				return new User($data);
		}
		return null;
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
		if (session_status() == PHP_SESSION_ACTIVE)
		{
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
