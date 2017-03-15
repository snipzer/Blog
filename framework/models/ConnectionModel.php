<?php
namespace Blog\Framework\Models;
use Blog\Framework\Configuration;
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


    /*  Methode permettant de compacter les deux fonctions query et prepare, perte de flexibilité au profis d'une factorisation de code redondant
    public function query(string $sql, array $params = [])
    {
        if(empty($params))
        {
            $statements = self::getInstance()->query($sql);
        }
        else
        {
            $statements = self::getInstance()->prepare($sql);
            $statements->execute($params);
        }

        return $statements->fetchAll(\PDO::FETCH_OBJ);
    }
    */
}

?>
