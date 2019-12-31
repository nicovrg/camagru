<?php
class ControllerRenew
{
	private $_view;
	private $_renewManager;
	private $_connexionManager;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->renew();
	}

	public function renew()
	{
		$this->_connexionManager = new ConnexionManager;
		$user = $this->_connexionManager->sessionLogin();
		$this->_renewManager = new RenewManager;
		$this->_renewManager->sendRenewMail($user);
		$this->_view = new View('Renew');
		$this->_view->generate(array());
	}
}