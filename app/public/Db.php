<?php

class Db
{
	private static $instance;

	public static $dbh = null;

	private function __construct()
	{
		try { 
			$dsn = 'mysql:host=db;dbname=household_account_book';
			$user = 'developer';
			$password = 'developer';
			$options = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			];
			static::$dbh = new PDO($dsn, $user, $password, $options);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance()
	{
		static::$instance =  static::$instance ?? static::$instance = new Db();
		return static::$dbh;
	}
}
