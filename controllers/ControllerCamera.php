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
		$owner = $user->getAccount_id();
		$pictures = $this->_picturesManager->getRecentPictures($owner);
		if ($user && isset($_POST["imageDataWebcam"]) && isset($_POST["filterDataWebcam"]) && isset($_POST["imageNameWebcam"]))
			$this->_picturesManager->uploadPicture(htmlspecialchars($_POST["imageNameWebcam"]), $_POST["imageDataWebcam"], $_POST["filterDataWebcam"], $user->getAccount_id());
		if ($user && isset($_POST["inputDeletePicture"]))
			$this->_picturesManager->deletePicture($_POST["inputDeletePicture"]);
		$this->_view = new View('Camera');
		$this->_view->generate(array('pictures' => $pictures));
	}
}
?>