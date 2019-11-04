<?php

// This class contain the following method:
	//register() will call methods from Checker class to verify if inputs are valid and authorized
	//then register() will add the user in the database
 
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
		// $hash = $password;
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