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
		$data = $_POST["imageDataFile"];
		$name = $_POST["imageNameFile"];
		// echo ("<script type='text/javascript'>console.log('outbond')</script>");
		// echo ("<script type='text/javascript'>console.log('data = $data')</script>");
		// echo ("<script type='text/javascript'>console.log('name = $name')</script>");
		if ($user && isset($_POST["imageDataFile"]) && isset($_POST["imageNameFile"]))
		{
			// echo ("<script type='text/javascript'>console.log('in controller')</script>");
			// echo ("<script type='text/javascript'>console.log('imageDataFile = |$test|')</script>");
			$this->_picturesManager->uploadFile($_POST["imageNameFile"], $_POST["imageDataFile"], $user->getAccount_id());
		}
		if ($user && isset($_POST["imageDataWebcam"]) && isset($_POST["imageNameWebcam"]))
			$this->_picturesManager->uploadPicture($_POST["imageNameWebcam"], $_POST["imageDataWebcam"], $user->getAccount_id());
		$this->_view = new View('Camera');
		$this->_view->generate(array());
	}
}
?>
