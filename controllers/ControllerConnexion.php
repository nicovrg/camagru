<?php
class ControllerConnexion
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
			$this->_connexionManager->connectUser($_POST['username'], $_POST['password']);
		$this->_view = new View('Login');
		$this->_view->generate(array());
	}	

	private function logout()
	{
		$this->_connexionManager = new ConnexionManager;
		// $this->_connexionManager->disconnectUser();
		$this->_view = new View('Logout');
		$this->_view->generate(array());
	}
}
?>