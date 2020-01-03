<?php
class ControllerRegister
{
	private $_view;
	private $_registerManager;

	public function __construct($url)
	{
		if (isset($url) && count($url) > 1)
			throw new Exception('Page not found');
		else
			$this->register();
	}

	private function sendmail($email, $token)
	{
		$to = $email;
		$subject = "activation code";
		$message = "activation link:" . $_SERVER['SERVER_NAME'] . "/activation" . "/" . $token;
		$headers = 'From: guillaume@guillaumerx.fr' . "\r\n" . 'Reply-To: guillaume@guillaumerx.fr' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		return (mail($to, $subject, $message, $headers));
	}

	private function register()
	{
		$this->_registerManager = new RegisterManager;
		if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['confirm']))
		{
			$email = htmlspecialchars($_POST['email']);
			$token = hash('ripemd160', hash('ripemd160', $email));
			$this->sendmail($email, $token);
			$this->_registerManager->register(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']), htmlspecialchars($_POST['confirm_password']), htmlspecialchars($_POST['email']));
			header("Refresh: 1; URL='/login'");
		}
		$this->_view = new View('Register');
		$this->_view->generate(array());
	}
}
?>