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
		$this->_loginManager = new LoginManager;
		if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm']))
			$this->_loginManager->login($_POST['username'], $_POST['password']);
		$this->_view = new View('Login');
		$this->_view->generate(array());
	}	
}
?>