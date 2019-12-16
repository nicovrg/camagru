<?php
class ControllerCamera
{
	private $_view;
	private $_picturesManager;
	private $_connexionManager;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->camera();
	}

	private function camera()
	{
		$this->_picturesManager = new PictureManager;
		$this->_connexionManager = new ConnexionManager;
		$user = $this->_connexionManager->sessionLogin();
		if ($user && isset($_POST["imageDataWebcam"]) && isset($_POST["imageNameWebcam"]))
			$this->_picturesManager->uploadPicture($_POST["imageNameWebcam"], $_POST["imageDataWebcam"], $user->getAccount_id());
		$this->_view = new View('Camera');
		$this->_view->generate(array());
	}
}
?>
