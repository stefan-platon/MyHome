<?php

class MySQLConnection
{
    private static $connection;

    public static function getConnection()
    {
        if (!isset(self::$connection)) {
            $credentials = json_decode(file_get_contents(__DIR__ . "/mysql_connection.json"));
            self::$connection = mysqli_connect($credentials->host, $credentials->user, $credentials->pass, $credentials->database);
        }
        return self::$connection;
    }
}