<?php
class ModifyManager extends Checker
{
	// require_once("ConnexionManager.php");
	private $connexion;
	
	public function __construct()
	{
		$this->connexion = new ConnexionManager();
	}

	private function modify_account($username, $password)
	{
		echo "lol";
	}
}
?>