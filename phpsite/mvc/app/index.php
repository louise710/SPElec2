<?php
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/classes/RouteMatcher.php';
require_once __DIR__ . '/classes/RequestInterface.php';
require_once __DIR__ . '/classes/Request.php';
require_once __DIR__ . '/classes/Response.php';
require_once __DIR__ . '/classes/UserController.php';
require_once __DIR__ . '/classes/Model.php';
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__.'/classes/AuthMiddleware.php';
require_once __DIR__.'/classes/JwtHandler.php';


// require_once __DIR__.'/classes/Database.php';

// require_once __DIR__.'/classes/Model.php';
// require_once __DIR__.'/classes/RequestInterface.php';
// require_once __DIR__.'/classes/Request.php';
// require_once __DIR__.'/classes/Response.php';
// require_once __DIR__.'/classes/RoutMatcher.php';
// require_once __DIR__.'/classes/Router.php';
// require_once __DIR__.'/classes/User.php';
// require_once __DIR__.'/classes/UserController.php';
require_once __DIR__.'/vendor/firebase/php-jwt/src/JWTExceptionWithPayloadInterface.php';
require_once __DIR__.'/vendor/firebase/php-jwt/src/BeforeValidException.php';
require_once __DIR__.'/vendor/firebase/php-jwt/src/CachedKeySet.php';
require_once __DIR__.'/vendor/firebase/php-jwt/src/ExpiredException.php';
require_once __DIR__.'/vendor/firebase/php-jwt/src/JWK.php';
require_once __DIR__.'/vendor/firebase/php-jwt/src/JWT.php';

require_once __DIR__.'/vendor/firebase/php-jwt/src/Key.php';
require_once __DIR__.'/vendor/firebase/php-jwt/src/SignatureInvalidException.php';

$jwtHandler = new JwtHandler();
$authMiddleware = new AuthMiddleware($jwtHandler);


$db = new Database('localhost', 'root', '', 'appusers');


$user = new User($db);


$request = new Request();


$controller = new UserController($user, $request, $jwtHandler);


$routes = include __DIR__ . '/routes.php';


$router = new Router($request, new RouteMatcher());


foreach ($routes as $route) {
    $router->addRoute($route['method'], $route['path'], $route['handler'], $route['middleware']);
}


$response = $router->dispatch();


http_response_code($response->getStatusCode());
header('Content-Type: application/json');
echo $response->getBody();