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
		$this->_userManager = new UserManager;
		if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm']))
			$this->_userManager->login($_POST['email'], $_POST['password']);
		$this->_view = new View('Login');
		$this->_view->generate(array());
	}	
}
?>