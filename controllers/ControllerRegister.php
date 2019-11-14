<?php
class ControllerRegister
{
	private $_view;
	private $_registerManager;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->register();
	}

	private function register()
	{
		$this->_registerManager = new RegisterManager;
		if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['confirm']))
		{
			$this->_registerManager->register($_POST['username'], $_POST['password'], $_POST['confirm_password'], $_POST['email']);
			header("Refresh: 1; URL='/login'");
		}
		$this->_view = new View('Register');
		$this->_view->generate(array());
	}
}
?>