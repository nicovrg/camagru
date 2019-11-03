<?php
class ConnexionManager extends Model
{
	private $id;
	private $name;
	private $authenticated;
	
    public function login(string $username, string $password)
	{
		global $pdo;
		$username = trim($username);
		
		// if (!$this->isNameValid($username))
		// 	return FALSE;
		// if (!$this->isPasswordValid($password))
		// 	return FALSE;
        $values = array(':username' => $username);
        $query = "SELECT * FROM `users` WHERE (`username` = :username)";
		try
		{
			$req = $pdo->prepare($query);
			$req->execute($values);
		}
		catch (PDOException $e)
		{
		   throw new Exception('Database query error');
		}
		$res = $req->fetch(PDO::FETCH_ASSOC);
		if (is_array($res))
		{
            if (hash('sha256', $password) === hash('sha256', $res['account_password']))
			{
				$this->id = intval($res['id'], 10);
				$this->username = $username;
				$this->authenticated = TRUE;
				$this->registerLoginSession();
				return TRUE;
			}
		}
		return FALSE;
	}
	
	public function isNameValid(string $name)
	{
		$len = mb_strlen($name);
		if (($len < 4) || ($len > 16))
			return FALSE;
		return TRUE;
	}
	
	public function isPasswordValid(string $password)
	{
		$valid = TRUE;
		$len = mb_strlen($password);
		if (($len < 8) || ($len > 16))
			$valid = FALSE;
		return $valid;
	}
	
	public function isIdValid(int $id)
	{
		$valid = TRUE;
		if (($id < 1) || ($id > 1000000))
			$valid = FALSE;
		return $valid;
	}
	
	public function sessionLogin()
	{
		global $pdo;
		if (session_status() == PHP_SESSION_ACTIVE)
		{
			/* 
				Query template to look for the current session ID on the account_sessions table.
				The query also make sure the Session is not older than 7 days
			*/
			$query = 
			
			'SELECT * FROM myschema.account_sessions, myschema.accounts WHERE (account_sessions.session_id = :sid) ' . 
			'AND (account_sessions.login_time >= (NOW() - INTERVAL 7 DAY)) AND (account_sessions.account_id = accounts.account_id) ' . 
			'AND (accounts.account_enabled = 1)';
			
			/* Values array for PDO */
			$values = array(':sid' => session_id());
			
			/* Execute the query */
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
			   /* If there is a PDO exception, throw a standard exception */
			   throw new Exception('Database query error');
			}
			
			$row = $res->fetch(PDO::FETCH_ASSOC);
			
			if (is_array($row))
			{
				/* Authentication succeeded. Set the class properties (id and name) and return TRUE*/
				$this->id = intval($row['account_id'], 10);
				$this->name = $row['account_name'];
				$this->authenticated = TRUE;
				
				return TRUE;
			}
		}
		
		/* If we are here, the authentication failed */
		return FALSE;
	}


}
?>
