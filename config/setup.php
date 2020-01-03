<?php
    class Setup
    {
        private static $db;
    
        private static function setDb()
        {
            require_once('./database.php');
            self::$db = new PDO($DB_DSN, $DB_USER, $DB_PWD);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
    
        public function getDb()
        {
            if (self::$db == null)
                self::setDb();
            return self::$db;
        }
    }

    $query = file_get_contents('export/cleanDb.sql');
    $setup = new Setup;
    try
    {
        $setup->getDb()->exec($query);
    }
    catch (PDOException $e)
    {
        echo 'merde';
    }

?>