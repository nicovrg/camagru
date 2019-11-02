<?php
abstract class Model
{
	private static $db;

	private static function setDb()
	{
		require_once('config/database.php');
		self::$db = new PDO($DB_HOST.$DB_NAME, $DB_USER, $DB_PWD);
		self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}

	protected function getDb()
	{
		if (self::$db == NULL)
			self::setDb();
		return self::$db;
	}

	protected function getAll($table, $obj)
	{
		$array = [];
		$req = $this->getDb()->prepare('SELECT * FROM '.$table.' ORDER BY ID DESC');
		$req->execute();
		while ($data = $req->fetch(PDO::FETCH_ASSOC))
			$array[] = new $obj($data);
		return $array;
		$req->closeCursor();
	}

}
?>

<!-- model class define connexion to the database methods for it's child classes -->
<!-- setDB establish connection with the database -->
<!-- getDB return the connexion identifier to the db -->
<!-- getALL return all data from a table within the db -->