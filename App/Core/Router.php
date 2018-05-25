<?php
namespace App\Core;

class Router
{

	protected static $routes = [
		"GET" => [],
		"POST" => []
	];

	public static function load($path) {
		$router = new static;
		require $path;
		
		return $router;
	}
	

	public static function get($uri, $controller)
	{
		static::$routes["GET"][$uri] = $controller;
	}


	public static function post($uri, $controller)
	{
		static::$routes["POST"][$uri] = $controller;
	}


	public function direct($uri, $request_type)
	{
		$this->followRouteExists($uri, $request_type);

		if (isset($GLOBALS['dieAfter'])) {
		    die();
        }

		if (!isset($GLOBALS['dieAfter']) || !$GLOBALS['dieAfter']) {
			//continue with carportal index.php
			return false;
		}

		die(error_log("URI not found: " . $uri ));
	}


	protected function callAction($controller, $action, $parameters = array())
	{
		$class = "App\\Controllers\\{$controller}";
		$controller = new $class;

		if (!method_exists($controller, $action)) {
			throw new \Exception(get_class($controller) . " does not respond to the {$action} action.");
			
		}

		$controller->$action(...$parameters);
	}

	protected function followRouteExists($uri, $request_type)
	{
		if (array_key_exists($uri, static::$routes[$request_type])) {
		    if (is_callable(static::$routes[$request_type][$uri])) {
		        $function = static::$routes[$request_type][$uri];
		        return $function();
            }

			$this->callAction(...explode('@', static::$routes[$request_type][$uri]));
		}

		$route = static::findMatchingRoute($uri, $request_type);

		foreach ($route as $route_uri => $data) {

			$optionals = strpos($route_uri, '{');
			$parameters = [];

			if ($optionals) {
				$uri_pieces = explode('/', $uri);
				$route_uri_pieces = explode('/', $route_uri);

				for($i = 0; $i < count($route_uri_pieces); $i++) {
					if (strpos($route_uri_pieces[$i], '{') !== false) {
						$option = preg_replace('/[{}]/', '', $route_uri_pieces[$i]);
						$parameters[$option] = $uri_pieces[$i];
						continue;
					}

					if ($uri_pieces[$i] != $route_uri_pieces[$i]) {
//						throw new \Exception("No route exists for /$uri_pieces[$i]");
						echo ("No route defined for {$uri}");
						throw new \Exception("No route defined for {$uri}");
						return false;
					}
				}
				list($controller, $action) = explode('@', static::$routes[$request_type][$route_uri]);
//				dd($parameters);
				$this->callAction($controller, $action, array_values($parameters));
			}
		}

		return false;
	}

    private static function getNonArgumentPieces($route)
    {
        $index = strpos($route, "{");

        if ($index !== false) {
            return substr($route, 0, $index);
        }

        return $route;
    }

    private static function findMatchingRoute($uri, $request_type)
    {
        $correct_route = array_filter(static::$routes[$request_type], function ($route) use ($uri) {
            if (empty(static::getNonArgumentPieces($route))) return;

            if (substr_count($route, '/') == substr_count($uri, '/')
                && (strpos(static::getNonArgumentPieces($uri), static::getNonArgumentPieces($route)) !== false)
            ) {

                return true;
            }

        }, ARRAY_FILTER_USE_KEY);

        return $correct_route;
    }

}