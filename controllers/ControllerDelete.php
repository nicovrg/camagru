<?php
class ControllerDelete
{
	private $_view;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->delete();
	}

	private function delete()
	{
		$this->_deleteManager = new DeleteManager;
		$this->_connexionManager = new ConnexionManager;
		if ($this->_connexionManager->sessionLogin())
		{
			$this->_deleteManager->delete();
			header("Refresh: 4; URL='/register'");
			$this->_view = new View('Delete');
			$this->_view->generate(array());
		}
		else
			throw new Exception('error during account deletion');
	}
}
?>
