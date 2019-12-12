<?php
class ControllerHomepage extends Model
{
	private $_view;
	private $_likeManager;
	private $_commentManager;
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
		$this->_picturesManager = new PictureManager;
		$user = $this->_connexionManager->sessionLogin();
		if (!isset($_GET["page"]))
			$_GET["page"] = 0;
		if ($user && isset($_POST["like"]) && isset($_POST["picture_id"]))
			$this->_likeManager->likeBtn($_POST["picture_id"], $user->getAccount_id());
		if ($user && isset($_POST["picture_id"]) && isset($_POST["comment_content"]))
			$this->_commentManager->commentBtn($_POST["picture_id"], $_POST["comment_content"], $user->getAccount_id());
		$users = $this->getAll("users", "User");
		// $pictures = $this->_picturesManager->getAllPictures();
		$pictures = $this->_picturesManager->getPagePictures($_GET["page"]);
		$comments = $this->_commentManager->getAllComments();
		$this->_view = new View('Homepage');
		$this->_view->generate(array('user' => $user, 'users' => $users, 'pictures' => $pictures, 'comments' => $comments));
	}
}
?>
