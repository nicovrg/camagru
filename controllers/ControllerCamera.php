<?php
class ControllerCamera
{
	private $_view;
	// private $_pictures;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->camera();
	}

	private function camera()
	{
		// $this->_pictures = new PictureManager;
		// $pictures = $this->_pictures->getAllPictures();
		$this->_view = new View('Camera');
		$this->_view->generate(array());
	}
}

?>
