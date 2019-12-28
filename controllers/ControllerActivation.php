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
			$this->activation($url[1]);
	}
	
	private function activation($token)
	{
		$this->_registerManager = new RegisterManager;
		if ($this->_registerManager->activate($token))
		{
			$this->_view = new View('Activation');
			$this->_view->generate(array());
		}
		else
			throw new Exception('Wrong activation token');
	}
}
?>