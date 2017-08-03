<?php

namespace JCC\Controllers;

use \PDO;

class Database
{
    private static $driver = 'mysql';
    private static $host = 'localhost';
    private static $schema = 'psamatho_CMCode';
    private static $user = 'psamatho_CMUser';
    private static $password = '45MyMpE4Qtma2d8z';
    private static $port = '3306';
    private static $charset = 'utf8';

    private static $conn = null;

    private function __construct()
    {
        // Singleton class. Disallow direct instantiation.
    }

    private function __clone()
    {
        // Singleton class. Disallow direct instantiation.
    }

    // Returns a PDO connection object based on the specified database credentials.
    public static function connection()
    {
        if (!isset(self::$conn)) {
            $dsn = self::$driver . ':host=' . self::$host . ';dbname=' . self::$schema . ';charset=' . self::$charset;
            $opt = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            self::$conn = new \PDO($dsn, self::$user, self::$password, $opt);
        }
        return self::$conn;
    }
}
