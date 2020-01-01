<?php
class ControllerRenew
{
	private $_view;
	private $_renewManager;
	private $_connexionManager;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 2)
			throw new Exception('Page not found');
		else if (isset($url) && count($url) > 1)
			$this->renew($url[1]);
		else
			$this->renew(null);
	}

	public function renew($token)
	{
		$this->_renewManager = new RenewManager;
		$this->_connexionManager = new ConnexionManager;
		$user = $this->_connexionManager->sessionLogin();
		if (isset($_POST["token"]) && isset($_POST["new_password"]) && isset($_POST["confirm_password"]))
			$this->_renewManager->renewPassword($user, htmlspecialchars($_POST["token"]), htmlspecialchars($_POST["new_password"]), htmlspecialchars($_POST["confirm_password"]));
		else
			$this->_renewManager->sendRenewMail($user);
		$this->_view = new View('Renew');
		$this->_view->generate(array('token' => $token));
	}
}