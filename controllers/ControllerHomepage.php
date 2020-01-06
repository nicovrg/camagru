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
		$nbPageMax = $this->_picturesManager->getNbPicturesDb() / 9;
		$user = $this->_connexionManager->sessionLogin();
		if (!isset($_GET["page"]) || $_GET["page"] < 0 || $_GET["page"] >= $nbPageMax)
			$_GET["page"] = 0;
		$_GET["page"] = round($_GET["page"]);
		if ($user && isset($_POST["like"]) && isset($_POST["picture_id"]))
			$this->_likeManager->likeBtn(htmlspecialchars($_POST["picture_id"]), htmlspecialchars($user->getAccount_id()));
		if ($user && isset($_POST["picture_id"]) && isset($_POST["comment_content"]))
			$this->_commentManager->commentBtn(htmlspecialchars($_POST["picture_id"]), htmlspecialchars($_POST["comment_content"]), $user->getAccount_id());
		if ($user && isset($_POST["delete"]) && isset($_POST["picture_id"]))
			$this->_picturesManager->deletePicture(htmlspecialchars($_POST["picture_id"]));
		$users = $this->getAll("users", "User");
		$pictures = $this->_picturesManager->getPagePictures($_GET["page"]);
		$comments = $this->_commentManager->getAllComments();
		$this->_view = new View('Homepage');
		$this->_view->generate(array('user' => $user, 'users' => $users, 'pictures' => $pictures, 'comments' => $comments));
	}
}
?>
