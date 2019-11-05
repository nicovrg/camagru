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
			if ($this->_connexionManager->login($_POST['username'], $_POST['password']))
				header('Location: /');
		}
		else
		{
			$this->_view = new View('Login');
			$this->_view->generate(array());
		}
	}
}
?>