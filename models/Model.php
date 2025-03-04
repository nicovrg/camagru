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
		if (self::$db == null)
			self::setDb();
		return self::$db;
	}

	protected function getAll($table, $obj)
	{
		$array = [];
		$query = 'SELECT * FROM '.$table;
		$req = $this->getDb()->prepare($query);
		$req->execute();
		while ($data = $req->fetch(PDO::FETCH_ASSOC))
			$array[] = new $obj($data);
		$req->closeCursor();
		return $array;
	}
}

// <!-- model class define connexion to the database methods for it's child classes -->
// <!-- setDB establish connection with the database -->
// <!-- getDB return the connexion identifier to the db -->
// <!-- getALL return all data from a table within the db -->

?>
