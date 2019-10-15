<?php

require_once(APP_PATH . "database/redis/RedisConnection.php");

class RoutesManager
{
    private static $routes;

    public static function getRoutes()
    {
        if (!isset(self::$routes)) {
            // check in redis cache
            $redis = RedisConnection::getConnection();
            self::$routes = $redis->get("System:collections");

            if (!self::$routes) {
                $collectionFiles = scandir(__DIR__ . '/collections');

                foreach ($collectionFiles as $collectionFile) {
                    $pathInfo = pathinfo($collectionFile);
                    if($pathInfo['extension'] === 'php'){
                        self::$routes[] = include(__DIR__ . "/collections/$collectionFile");
                    }
                }
            }
            $redis->save("System:collections", self::$routes);
        }
        return self::$routes;
    }
}