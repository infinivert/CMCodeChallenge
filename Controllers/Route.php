<?php

namespace JCC\Controllers;

class Route
{
    // Associate first URI segment with a Controller Method
    public static $routes = [
        '404' => [
            'controller' => 'Route',
            'method' => 'pageNotFound'
        ],
        'Credits' => [
            'controller' => 'Credit',
            'method' => 'showList',
        ]
    ];

    // Processes a simple Route request.
    public static function process(string $route = null, array $params = null)
    {
        if (empty($route)) {
            $route = self::getRouteFromURI();
            $params = self::getParamsFromURI();
        }

        $class = '\\JCC\\Controllers\\' . self::$routes[$route]['controller'];
        $method = self::$routes[$route]['method'];
        $controller = new $class();
        $controller->{$method}($params);
    }

    // Determines a Route from a URI.
    public static function getRouteFromURI()
    {
        $URISegments = self::getURISegments();

        if (!$URISegments || !is_array($URISegments) || count($URISegments) === 0) {
            self::redirect('Credits');
        }

        if (!in_array($URISegments[0], array_keys(self::$routes))) {
            return '404';
        }

        return $URISegments[0];
    }

    // Determines Route Parameters from a URI.
    public static function getParamsFromURI()
    {
        $URISegments = self::getURISegments();

        if (count($URISegments) < 2 || !in_array($URISegments[0], array_keys(self::$routes))) {
            return null;
        }

        array_shift($URISegments);

        return $URISegments;
    }

    // Splits the current requested URI into segments
    private static function getURISegments()
    {
        $root = substr($_SERVER['SCRIPT_NAME'],0,strlen($_SERVER['SCRIPT_NAME']) - strlen('/index.php'));
        $request = substr($_SERVER['REQUEST_URI'],strlen($root));
        $request = trim(trim($request),'/');
        if (!empty($request)) {
            $request = explode('/',trim(trim($request),'/'));
        } else {
            $request = null;
        }
        return $request;
    }

    // Redirects the user to the specified route (or to a 404 if it doesn't exist)l
    public static function redirect($route = null, array $params = null)
    {
        if (!$route || !in_array($route, array_keys(self::$routes))) {
            $route = '404';
        }
        header('Location: ' . APPURL . $route . '/');
        exit();
    }

    // Represents the 404 view
    public function pageNotFound()
    {
        http_response_code(404);
        exit("Not all who wander are lost, but I'm afraid your princess is in another castle.");
    }
}
