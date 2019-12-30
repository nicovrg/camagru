<?php
class ControllerNotification
{
	private $_view;
	private $_connexionManager;
	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->changeNotification($url[1]);
	}
	
	private function changeNotification($token)
	{
		$this->_connexionManager = new ConnexionManager;
		$user = $this->_connexionManager->sessionLogin();
		if ($this->_connexionManager->isUserMailActivated($user->getAccount_id()))
			$this->_connexionManager->disableMail($user->getAccount_id());
		else
			$this->_connexionManager->enableMail($user->getAccount_id());
		$this->_view = new View('Notification');
		$this->_view->generate(array());
	}
}
?>