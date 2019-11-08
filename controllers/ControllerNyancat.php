<?php
class ControllerNyancat
{
	private $_view;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		$this->_view = new View('Nyancat');
		$this->_view->generate(array());
	}
}
