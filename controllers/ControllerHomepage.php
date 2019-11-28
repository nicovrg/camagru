<?php
class ControllerHomepage
{
	private $_view;
	private $_likeManager;
	private $_connexionManager;
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
		$this->_likeManager = new LikeManager;
		$this->_commentManager = new CommentManager;
		$this->_connexionManager = new ConnexionManager;
		$user = $this->_connexionManager->sessionLogin();
		if ($user && isset($_POST["like"]) && isset($_POST["picture_id"]))
			$this->_likeManager->likeBtn($_POST["picture_id"], $user->getAccount_id());
		if ($user && isset($_POST["comment"]) && isset($_POST["picture_id"]))
			$this->_commentManager->commentBtn($_POST["picture_id"], $user->getAccount_id());
		$this->_picturesManager = new PictureManager;
		$pictures = $this->_picturesManager->getAllPictures();
		$this->_view = new View('Homepage');
		$this->_view->generate(array('pictures' => $pictures, 'user' => $user));
	}
}
?>
