<?php

require_once('views/View');
class ControllerHomepage extends Model
{
	private $_view;
	private $_userManager;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->users();
	}

	private function user()
	{
		$this->_userManager = new UserManager;
		$users = $this->_userManager->getUsers();
		
		$this->_view = new View('Home');
		$this->_view->generate(array('users' => $users));
		
		// require_once('views/viewHomepage.php');
	}
}
?>