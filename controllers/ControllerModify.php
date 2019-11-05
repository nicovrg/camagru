<?php
class ControllerModify
{
	private $_view;
	private $_modifyManager;
	private $_connexionManager;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->modify();
	}

	private function modify()
	{
		$this->_modifyManager = new ModifyManager;
		$this->_connexionManager = new ConnexionManager;
		if ($user = $this->_connexionManager->sessionLogin())
		{
			if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['confirm']))
				$this->_modifyManager->modify_account($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
			$this->_view = new View('Modify');
			$this->_view->generate(array('user' => $user));
		}
		else
			header('Location: /login');
	}	
}
?>