<?php
class ControllerActivation
{
	private $_view;
	private $_registerManager;
	public function __construct($url)
	{
		if (isset($url) && count($url) < 2 || count($url) > 2)
			throw new Exception('Page not found');
		else
			$this->activation();
	}
	
	private function activation()
	{
		$this->_registerManager = new RegisterManager;
		if ($url[1] == hash('ripemd160', hash('ripemd160', $email)))
			$this->_registerManager->activate($url[1]);
		else
			throw new Exception('Wrong activation token');
		$this->_view = new View('Activation');
		$this->_view->generate(array());
	}
}
?>