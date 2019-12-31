<?php

	// This class contain the following method:
	//register() => register a user in db
	//activate() => valid user account in db (token become valid)

class RenewManager extends checker
{

	private function sendmail($email)
	{
		$to = $email;
		$token = substr(md5(mt_rand()),0,15);
		$subject = "password modification";
		$message = "password reset link:" . $_SERVER['SERVER_NAME'] . "/renew" . "/" . $token;
		$headers = 'From: guillaume@guillaumerx.fr' . "\r\n" . 'Reply-To: guillaume@guillaumerx.fr' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		return (mail($to, $subject, $message, $headers));
	}

	public function sendRenewMail()
	{
		
	}
}
