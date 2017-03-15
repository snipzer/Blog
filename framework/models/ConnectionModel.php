<?php
namespace Blog\Framework\Models;
use Blog\Framework\Configuration;

// Utilitaire de connection à PDO en singleton
class ConnectionModel
{
    private static $_instance;
    private $_pdo;

    private function __construct()
    {
        $dbname = Configuration\Configuration::get("DB", "DBNAME");
        $dbhost = Configuration\Configuration::get("DB", "HOST");
        $dbuser = Configuration\Configuration::get("DB", "USER");
        $dbpass = Configuration\Configuration::get("DB", "PASSWORD");

        $this->_pdo = new \PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
        $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (!self::$_instance)
        {
            self::$_instance = new ConnectionModel();
        }
        return self::$_instance;
    }

    public function execute(string $sql, array $params = [])
    {
        if(empty($params))
        {
            $statements = $this->_pdo->query($sql);
        }
        else
        {
            $statements = $this->_pdo->prepare($sql);
            $statements->execute($params);
        }

        return $statements;
    }

    public function query(string $sql, array $params = [])
    {
        $statements = $this->execute($sql, $params);

        return $statements->fetchAll(\PDO::FETCH_OBJ);
    }

}

?>
