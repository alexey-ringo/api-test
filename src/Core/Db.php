<?php
declare(strict_type=1);

namespace Core;

use PDO;
use PDOStatement;

/**
 * Class Db
 * @package Core 
 */
class Db {

    /**
     * instances
     *
     * @var array
     */
    private static $instances = [];

    /**
     * db
     *
     * @var Db $db
     */
    private $db;

    private function __construct() 
    { 
        $config = require 'config/db.php';
		
        $this->db = new PDO(
            'mysql:host='.$config['host'].';dbname='.$config['name'].'', 
            $config['user'], 
            $config['password'],
            [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]
        );

        $this->db->exec('SET NAMES UTF8');
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    private function __clone() { }

    private function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
    

    /**
     * getInstance
     *
     * @return Db
     */
    public static function getInstance(): Db
    {
        $dbInstance = static::class;
        if (!isset(static::$instances[$dbInstance])) {
            static::$instances[$dbInstance] = new static;
        }

        return static::$instances[$dbInstance];        
    }

    /**
     * select
     *
     * @param  string $sql
     * @param  array|null $params
     *
     * @return array
     */
    public function select($sql, $params = []): array
    {
        $result = $this->query($sql, $params);
    
        return $result->fetchAll();
    }

    /**
     * row
     *
     * @param  string $sql
     * @param  array|null $params
     *
     * @return array
     */
    public function row($sql, $params = []): array 
    {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
	/**
	 * column
	 *
	 * @param  string $sql
	 * @param  array|null $params
	 *
	 * @return array
	 */
    public function column($sql, $params = []): array 
    {
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
    }
    
	/**
	 * lastInsertId
	 *
	 * @return int
	 */
    public function lastInsertId(): int 
    {
		return $this->db->lastInsertId();
    }    
    
    /**
     * query
     *
     * @param  string $sql
     * @param  array|null $params
     *
     * @return PDOStatement
     */
    private function query($sql, $params = []): PDOStatement
    {
        $stmt = $this->db->prepare($sql);        
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				if (is_int($val)) {
					$type = PDO::PARAM_INT;
				} else {
					$type = PDO::PARAM_STR;
				}
				$stmt->bindValue(':'.$key, $val, $type);
			}
		}
        $stmt->execute();        
		return $stmt;
    }    
}