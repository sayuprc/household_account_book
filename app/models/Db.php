<?php

namespace models;

use PDO;
use PDOException;

class Db
{
	private static $instance;

	public $dbh;

	private function __construct()
	{
		try { 
			$dsn = 'mysql:host=db;dbname=household_account_book';
			$user = 'developer';
			$password = 'developer';
			$options = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			];

			$this->dbh = new PDO($dsn, $user, $password, $options);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance()
	{
		return static::$instance ?? static::$instance = new Db();
	}

    public function execute(string $query, array $prepare = [])
    {
        $stmt = $this->dbh->prepare($query);
        $stmt->execute($prepare);

        $data = $stmt->fetchAll();

        return $data;
    }
}
