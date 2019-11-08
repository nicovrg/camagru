<?php

// This class contain the following functions:
	// check syntax of user input (username, password, email)
	// check availability of user info (username, email)

	abstract class Checker extends Model
{

	public function isIdValid(int $id)
	{
		if (($id < 1) || ($id > 1000000))
			return false;
		return true;
	}

	public function getId($session_id)
	{
		$user_id;
		$values = array(':session_id' => $session_id);
		$query = "SELECT `account_id` FROM `sessions` WHERE (`session_id` = :session_id)";
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
			$user_id = intval($data['session_id'], 10);
		$req->closeCursor();
		return $user_id;
	}

	public function getUsernameId($username)
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

	public function getEmailId($email)
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
}
?>