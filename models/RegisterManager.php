<?php
class RegisterManager extends Model
{

	public function checkUsernameSyntax($username)
	{
		$len = strlen($username);
		return ($len < 4 || $len > 16) ? false : true;
	}

	public function checkPasswordSyntax($password, $password_conf)
	{
		if (preg_match_all('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{10,})/', htmlspecialchars($password)) && $password == $password_conf)
			return true;
		else
			return false;
	}

	public function checkEmailSyntax($email)
	{
		return (preg_match('/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/', htmlspecialchars($email))) ? true : false;
	}

	public function checkUsernameTaken($username)
	{
		$values = array(':username' => $username);
		try
		{
			$req = $this->getDb()->prepare('SELECT `id` FROM `users` WHERE (`username` = `:username`)');
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
		$data = $req->fetch(PDO::FETCH_ASSOC);
		if (is_array($data))
			$id = intval($data['id'], 10);
		return $id;
		$req->closeCursor();
	}


	public function checkEmailTaken($email)
	{
		$values = array(':email' => $email);
		try
		{
			$req = $this->getDb()->prepare('SELECT `id` FROM `users` WHERE (`email` = `:email`)');
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
		$data = $req->fetch(PDO::FETCH_ASSOC);
		if (is_array($data))
			$id = intval($data['id'], 10);
		return $id;
		$req->closeCursor();
	}

	public function register($username, $password, $password_conf, $email)
	{
		$email = trim(htmlentities($email));
		$username = trim(htmlentities($username));

		if (!$this->checkUsernameSyntax($username))
			throw new Exception('Invalid Username');
		if (!$this->checkPasswordSyntax($password, $password_conf))
			throw new Exception('Invalid Password');
		if (!$this->checkEmailSyntax($email))
			throw new Exception('Invalid Email');
		if (!is_null($this->checkUsernameTaken($username)))
			throw new Exception('Username already exist');
		if (!is_null($this->checkEmailTaken($email)))
			throw new Exception('Email already exist');
		$hash = hash('sha256', htmlentities($password));
		$values = array(':username' => $username, ':password' => $hash, ':email' => $email);
		try
		{
			$req = $this->getDb()->prepare('INSERT INTO `users` (`username`, `password`, `email`) VALUES (`:username`, `:password`, `:email`)');
			$req->execute($values);
			$req->closeCursor();
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
	}
}
?>