<?php

class RedisConnection
{
    private static $connection;

    public static function getConnection()
    {
        if (!isset(self::$connection)) {
            self::$connection = new Redis();
            $credentials = json_decode(file_get_contents(__DIR__ . "/redis_connection.json"));
            self::$connection->connect($credentials->host, $credentials->port);
        }
        return self::$connection;
    }
}