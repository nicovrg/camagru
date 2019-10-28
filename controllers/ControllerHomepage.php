<?php
require_once('views/View.php');
class ControllerHomepage
{
	private $_view;
	private $_pictureManager;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->users();
	}

	private function users()
	{
		$this->_view = new View('Homepage');
		$this->_view->generate(array());
	}
}
?>