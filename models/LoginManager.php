<?php
class LoginManager extends Model
{

	public function startSession($username)
    {
        session_start();
        $_SESSION['username'] = $username;
    }

	public function checkInfo($username, $password)
	{
		$username = trim($username);
		$password = hash('sha256', $password);
		$values = array(':username' => $username);
		try
		{
			$req = $this->getDb()->prepare('SELECT * FROM users WHERE username = :username');
			$req->execute($values);
		}
		catch (PDOException $e)
		{
				throw new Exception('Query error');
		}
		$data = $req->fetch(PDO::FETCH_ASSOC);
		if (is_array($data))
			if ($data["password"] === $password)
				return TRUE;
		return FALSE;			
		$req->closeCursor();
	}

	public function checkSessionActivity($username)
	{
		$values = array(':username' => $username);
		try
		{
			$req = $this->getDb()->prepare('SELECT * FROM session WHERE username = :username');
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
		$data = $req->fetch(PDO::FETCH_ASSOC);
		if (is_array($data))
			throw new Exception('Your account is already log');
		else
			$this->logUser($username);
		$req->closeCursor();
	}

	public function logUser($username)
	{
		$values = array(':username' => $username, ':active' => TRUE);
		try
		{
			$req = $this->getDb()->prepare('INSERT INTO session (username, active) VALUES (:username, :active)');
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
		// $this->startSession($username);
		// echo "<script>console.log('--|log user|--' );</script>";
		$req->closeCursor();
	}


	public function login($username, $password)
	{
		if ($this->checkInfo($username, $password) === FALSE)
			throw new Exception('Invalid Credentials');
		if ($this->checkSessionActivity($username) === TRUE)
			throw new Exception('Already log');
		else 
			$this->logUser($username);
	}
}
?>
