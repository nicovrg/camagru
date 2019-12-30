<?php

	// This class contain the following method:
	//register() => register a user in db
	//activate() => valid user account in db (token become valid)

class RegisterManager extends Checker
{
	private function sendmail($email, $token)
	{
		$to = $email;
		$subject = "Account Activation Code";
		$message = "activation link:" . $_SERVER['SERVER_NAME'] . "/activation" . "/" . $token;
		$headers =	'From: guillaume@guillaumerx.fr' . "\r\n" .
     				'Reply-To: guillaume@guillaumerx.fr' . "\r\n" .
     				'X-Mailer: PHP/' . phpversion();
		return (mail($to, $subject, $message, $headers));
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
		if (!is_null($this->getUsernameId($username)))
			throw new Exception('Username already exist');
		if (!is_null($this->getEmailId($email)))
			throw new Exception('Email already exist');
		$hash = hash('sha256', $password);
		$token = substr(md5(mt_rand()),0,15);
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
		if (!$this->sendmail($email, $token))
			throw new Exception('mail error');
	}

	public function activate($token)
	{
		$values = array(':token' => $token);

		$query = "SELECT * FROM users WHERE (token = :token)";
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
		{
			$query = "UPDATE users SET activated = 1 WHERE (token = :token)";
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
			return true;
		}
		else
			return false;
		$req->closeCursor();
	}
}
?>