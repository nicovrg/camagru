<?php

	// This class contain the following method:
	//register() => register a user in db
	//activate() => valid user account in db (token become valid)

class RenewManager extends checker
{
	private function sendMail($email, $token)
	{
		$to = $email;
		$subject = "password modification";
		$message = "password reset link:" . $_SERVER['SERVER_NAME'] . "/renew" . "/" . $token;
		$headers = 'From: guillaume@guillaumerx.fr' . "\r\n" . 'Reply-To: guillaume@guillaumerx.fr' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		return (mail($to, $subject, $message, $headers));
	}

	public function sendRenewMail($user)
	{
		$account_id = $user->getAccount_id();
		$token = substr(md5(mt_rand()),0,15);
		$values = array(':account_id' => $account_id, ':token' => $token);
		$query = "UPDATE `users` SET `token` = :token WHERE (`account_id` = :account_id)";
		try
		{
			$req = $this->getDb()->prepare($query);
			$req->execute($values);
		}
		catch (PDOException $e)
		{
			throw new Exception('Database query error');
		}
		$req->closeCursor();
		$this->sendMail($user->getEmail(), $token);
		return true;
	}

	public function renewPassword()
	{
		
		return true;
	}

}
