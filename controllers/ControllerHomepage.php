<?php
class ControllerHomepage
{
	private $_view;
	private $_pictures;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->homepage();
	}

	private function homepage()
	{
		$this->_pictures = new PictureManager;
		$pictures = $this->_pictures->getPicture();
		// var_dump($pictures);
		$this->_view = new View('Homepage');
		$this->_view->generate(array('pictures' => $pictures));
	}
}

?>
