<?php
class ControllerLogin
{
	private $_view;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->login();
	}

	private function login()
	{
		$this->_connexionManager = new ConnexionManager;
		if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm']))
		{
			if (!$this->_connexionManager->sessionLogin())
			{
				if ($this->_connexionManager->login(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password'])))
					header("Location: /");
				else
					throw new Exception('Login fail');
			}
			else
				throw new Exception('User already log');
		}
		else
		{
			$this->_view = new View('Login');
			$this->_view->generate(array());
		}
	}
}
?>