<?php
class ModifyManager extends Model
{

	public function getUserId($username)
    {
		$values = array(':username', $username);
		try
		{
			$req = $this->getDb()->prepare('SELECT `id` FROM `user` WHERE `username` = :username');
			$req->execute($values);
			$res = $req->fetchColumn();
			$req->closeCursor();
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
        if ($res)
            return $res;
        else
            return NULL;
	}
	
	public function updateUsername()
	{
		session_start();
		$old_username = $_SESSION['username'];
		$new_username = htmlentities($_POST['new_username']);
		$values = array(':new_username' => $new_username, ':old_username' => $old_username);
		try
		{
			$req = $this->getDb()->prepare('UPDATE `users` SET `username` = `:new_username` WHERE `username` = `:old_username`');
			$req->execute($values);
			$req->closeCursor();
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
		$_SESSION['username'] = $new_username;
		echo "<script>window.alert('Your new username is ".$new_username."')</script>";
	}
	
	public function updatePassword()
	{
		session_start();
		$username = $_SESSION['username'];
		$old_password = hash('sha256', htmlentities($_POST['old_password']));
		$new_password = hash('sha256', htmlentities($_POST['new_password']));
		$values = array(':username' => $username);
		try
		{
			$req = $this->getDb()->prepare('SELECT `password` FROM `users` WHERE `username` = :username');
			$req->execute($values);
			$db_old_password = $req->fetchColumn();
			$req->closeCursor();
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
		if (preg_match_all('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{10,})/', htmlspecialchars($new_password)) && $old_password === $db_old_password)
		{
			$values = array(':username' => $username, ':new_password' => $new_password);
			try
			{
				$req = $this->getDb()->prepare('UPDATE `user` SET `password` = :new_password WHERE `username` = :username');
				$req->execute($values);
				$req->closeCursor();
			}
			catch (PDOException $e)
			{
				throw new Exception('Query error');
			}
			echo "<script>window.alert('Password succesfully updated')</script>";
			return true;
		}
		else
		{
			if ($db_old_password !== $old_password) 
				echo "<script>window.alert('Incorrect password')</script>";
			else
				echo "<script>window.alert('Password must meet conditions (length > 10, at least one of [A-Z] [a-z] [0-9] [!@#%\^&\*]')</script>";
			return false;
		}
	}
	
	public function checkNewEmail()
	{
		$new_email = htmlentities($_POST['email']);
		$values = array(':email' => $new_email);
		try
		{
			$req = $this->getDb()->prepare('SELECT * FROM `user` WHERE `email` = :email');
			$req->execute($values);
			$res = $req->fetchColumn();
			$req->closeCursor();
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
		if ($res)
		{
			echo "<script>window.alert('This email is already used')</script>";
			return false;
		}
		else
			return true;
	}
	
	public function updateEmail()
	{
		session_start();
		$username =  $_SESSION['username'];
		$new_email = htmlentities($_POST['email']);
		$values = array(':new_email' => $new_email, ':user_logged' => $username);
		try
		{
			$req = $this->getDb()->prepare('UPDATE `user` SET `email` = :new_email WHERE `username` = :user_logged');
			$req->execute($values);
			$req->closeCursor();
		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
		echo "<script>window.alert('Your new email is ".$new_email." ')</script>";
	}
	
	public function delAccount() 
	{
		session_start();
		$username = $_SESSION['username'];
		$id = $this->getUserId($username);
		$values = array(':id' => $id);
		try
		{
			$req = $this->getDb()->prepare('DELETE FROM `user` WHERE `id` = :id'); 
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