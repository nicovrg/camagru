<?php
class ConnexionManager extends Model
{
    private $_user;

	public function startSession()
    {
        session_start();
        $_SESSION['username'] = $this->_user->connectUser();
    }

    public function connectUser()
    {
        $this->_user = new User($_POST);
        $username = $this->_user->username();
        $password = $this->_user->password();
		$values = array(':username' => $username, ':password' => $password);
		try
		{
			$req = $this->getDb()->prepare('SELECT * FROM `users` WHERE `username` = `:username` AND `password` = `:password`');
	        $req->execute($values);
	        $res = $req->fetch(PDO::FETCH_ASSOC);
			$req->closeCursor();

		}
		catch (PDOException $e)
		{
			throw new Exception('Query error');
		}
        if ($res != false)
        {
            $this->startSession();
            return $res;
        }
        else
            return NULL;
    }
    
    public function disconnectUser()
    {
        session_start();
        if (isset($_SESSION['username']))
            $_SESSION['username'] = NULL;
    }
        
}
?>
