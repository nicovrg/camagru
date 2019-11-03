<?php
class RegisterManager extends Model
{
	/* This class contain function to check syntax of user input,
	also to check that email and username are not already used by another user,
	and a register function to call all of the previously mentionned methods */

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

	public function checkUsernameAvailable($username)
	{
		$values = array(':username' => $username);
		$query = "SELECT `id` FROM `users` WHERE (`username` = :username)";
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
		$res = $req->fetch(PDO::FETCH_ASSOC);
		if (is_array($res))
			$id = intval($res['id'], 10);
		$req->closeCursor();
		return $id;
	}


	public function checkEmailAvailable($email)
	{
		$values = array(':email' => $email);
		$query = "SELECT `id` FROM `users` WHERE (`email` = :email)";
		try
		{
			$req = $this->getDb()->prepare($query);
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
		$email = trim($email);
		$username = trim($username);

		if (!$this->checkUsernameSyntax($username))
			throw new Exception('Invalid Username');
		if (!$this->checkPasswordSyntax($password, $password_conf))
			throw new Exception('Invalid Password');
		if (!$this->checkEmailSyntax($email))
			throw new Exception('Invalid Email');
		if (!is_null($this->checkUsernameAvailable($username)))
			throw new Exception('Username already exist');
		if (!is_null($this->checkEmailAvailable($email)))
			throw new Exception('Email already exist');
		$hash = hash('sha256', $password);
		$values = array(':username' => $username, ':password' => $hash, ':email' => $email);
		$query = "INSERT INTO `users` (`username`, `password`, `email`) VALUES (:username, :password, :email)";
		try
		{
			$req = $this->getDb()->prepare($query);
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