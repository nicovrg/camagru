<?php
    require_once('database.php');
    $db = new PDO($DB_DSN, $DB_USER, $DB_PWD);
    if (!$db)
        die();
    $query = file_get_contents('export/cleanDb.sql');
    try 
    {
        $db->exec($query);
    }
    catch (PDOException $e)
    {
        echo "Error " . $e->getMessage() . "\n";
        die();
    }
?>