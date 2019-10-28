<?php
require_once('views/View.php');
class ControllerRegister
{
	private $_view;
	private $_userManager;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->register();
	}

	private function register()
	{
		$this->_userManager = new UserManager;
		if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['confirm']))
			$this->_userManager->register($_POST['username'], $_POST['password'], $_POST['password_conf'], $_POST['email']);
		$this->_view = new View('Register');
		$this->_view->generate(array());
	}
}
?>