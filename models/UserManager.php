<?php
class UserManager extends Model
{

	public function isUsernameValid($username)
	{
		$len = strlen($username);
		return ($len < 8 || $len > 16) ? false : true;
	}

    public function isPasswordValid($password, $password_conf)
    {
        // if (preg_match_all('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{10,})/', htmlspecialchars($password)) && $password == $password_conf)
            return true;
        // else
        //     return false;
    }

    public function isEmailValid($email)
    {
        return (preg_match('/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/', htmlspecialchars($email))) ? true : false;
    }

    public function getIdFromEmail($email)
    {
        $values = array(':email' => $email);
        try
        {
            $req = $this->getDb()->prepare('SELECT id FROM users WHERE (email = :email)');
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

    public function getIdFromUsername($username)
    {
        $values = array(':username' => $username);
        try
        {
            $req = $this->getDb()->prepare('SELECT id FROM users WHERE (username = :username)');
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
        $password = trim($password);
        $password_conf = trim($password_conf);

        if (!$this->isUsernameValid($username))
            throw new Exception('Invalid Username');
        if (!$this->isPasswordValid($password, $password_conf))
            throw new Exception('Invalid Password');
        if (!$this->isEmailValid($email))
            throw new Exception('Invalid Email');
		if (!is_null($this->getIdFromUsername($username)))
			throw new Exception('Username already exist');        
        if (!is_null($this->getIdFromEmail($email)))
			throw new Exception('Email already exist');
			
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $values = array(':username' => $username, ':password' => $hash, ':email' => $email);

        try
        {
            $req = $this->getDb()->prepare('INSERT INTO users (username, password, email) VALUES (:username, :password, :email)');
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



<!--
	 
	sign in - sign out - login - logout 
	check password - send email confirmation sign in - send email to renew pwd
	disconnect from everywhere
	modif account info
	
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

 -->