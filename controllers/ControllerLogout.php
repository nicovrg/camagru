<?php
class ControllerLogout
{
	private $_view;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->logout();
	}

	private function logout()
	{
		$this->_connexionManager = new ConnexionManager;
		if ($this->_connexionManager->sessionLogin())
			$this->_connexionManager->logout();
		header("Refresh: 4; URL='/login'");
		$this->_view = new View('Logout');
		$this->_view->generate(array());
	}
}
?>