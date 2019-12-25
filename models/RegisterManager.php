<?php

// This class contain the following method:
	//register() => register a user in db
	//activate() => valid user account in db (token become valid)
 
class RegisterManager extends Checker
{
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
		if (!is_null($this->getUsernameId($username)))
			throw new Exception('Username already exist');
		if (!is_null($this->getEmailId($email)))
			throw new Exception('Email already exist');
		$hash = hash('sha256', $password);
		$token = hash('ripemd160', hash('ripemd160', $email));
		$values = array(':username' => $username, ':password' => $hash, ':email' => $email, ':token' => $token);
		$query = "INSERT INTO `users` (`username`, `password`, `email`, `token`) VALUES (:username, :password, :email, :token)";
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

	public function activate($token)
	{
		$valid = "valid";
		$values = array(':token' => $token, ':valid' => $valid);
		$query = "UPDATE `users` SET `token` = :valid WHERE `token` = :token";
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