<?php
namespace App\Core\Database;

class Connection
{
	public static function make()
	{
		try {

			return new \PDO(
				env('DB_DRIVER') . ":host=" .
				env('DB_HOST') . ";dbname=" .
				env('DB_NAME'),
				env('DB_USERNAME'),
				env('DB_PASSWORD'),
				[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
				);
		}
		catch (\PDOException $e) {
			die($e->message());
		}
	}
}