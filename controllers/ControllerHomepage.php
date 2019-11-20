<?php
class ControllerHomepage
{
	private $_view;
	private $_picturesManager;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->homepage();
	}

	private function homepage()
	{
		$this->_picturesManager = new PictureManager;
		$pictures = $this->_picturesManager->getAllPictures();
		$this->_view = new View('Homepage');
		$this->_view->generate(array('pictures' => $pictures));
	}
}

?>
