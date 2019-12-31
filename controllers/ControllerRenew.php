<?php
class ControllerRenew
{
	private $_view;
	private $_renewManager;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->renew();
	}

	public function renew()
	{
		$_renewManager = new RenewManager;
		$this->_renewManager->sendRenewMail();
		$this->_view = new View('Renew');
		$this->_view->generate(array());
	}
}