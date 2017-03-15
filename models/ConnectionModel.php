<?php
namespace Blog\Models;
use Blog\Configuration;
// Utilitaire de connection à PDO en singleton
class ConnectionModel
{
    private static $_instance;
    private static $_pdo;

    private function __construct()
    {
        $dbname = Configuration\Configuration::get("DB", "DBNAME");
        $dbhost = Configuration\Configuration::get("DB", "HOST");
        $dbuser = Configuration\Configuration::get("DB", "USER");
        $dbpass = Configuration\Configuration::get("DB", "PASSWORD");

        self::$_pdo = new \PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
        self::$_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if(!self::$_instance)
        {
            self::$_instance = new ConnectionModel();
        }
        return self::$_instance;
    }


    public function query($str)
    {
        return self::$_pdo->query($str);
    }

    public function prepare($str)
    {
        return self::$_pdo->prepare($str);
    }

}

?>
