<?php

define('APP_PATH', __DIR__ . '/../');
define('UPLOADS_PATH', __DIR__ . '/../../uploads/');

if (!file_exists(UPLOADS_PATH)) {
    mkdir(UPLOADS_PATH, 0777, true);
}

require_once(APP_PATH . '/routes/Collection.php');
require_once(APP_PATH . '/routes/RoutesManager.php');

$collections = RoutesManager::getRoutes();

$response = [];

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET" :
        foreach ($collections as $collection) {
            foreach ($collection->getGet() as $function => $route) {
                if (preg_match($route, $_SERVER['QUERY_STRING'], $matches)) {
                    $handler = $collection->getHandler();
                    require_once(APP_PATH . "/controllers/$handler.php");
                    $controller = new $handler();
                    $response = $controller->$function(isset($matches[1]) ? $matches[1] : null);
                    break 2;
                }
            }
        }
        break;
    case "POST" :
        foreach ($collections as $collection) {
            foreach ($collection->getPost() as $function => $route) {
                if (preg_match($route, $_SERVER['REQUEST_URI'])) {
                    $handler = $collection->getHandler();
                    require_once(APP_PATH . "/controllers/$handler.php");
                    $controller = new $handler();
                    $response = $controller->$function();
                    break 2;
                }
            }
        }
        break;
    default :
        throw new HttpException("Request type not supported.", 425);
}

header('Content-Type: application/json');
if ($response && isset($response['code'])) {
    http_response_code($response['code']);
}
echo json_encode($response);
