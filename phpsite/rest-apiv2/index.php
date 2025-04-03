<?php
require_once 'init.php';

$driver = 'mysql:host=localhost;dbname=usjr2;charset=utf8'; 
$user = 'root';
$password = 'root';

$dbORM = new DBORM($driver, $user, $password);

$userRepository = new UserRepository($dbORM); 

$request = new Request();

$controller = new UserController($userRepository, $request);

$routes = include __DIR__ . '/routes.php';

$router = new Router($request, new RouteMatcher());

foreach ($routes as $route) {
    $router->addRoute($route['method'], $route['path'], $route['handler']);
}

try {
    $response = $router->dispatch();
} catch (PDOException $e) {
    $response = new Response(500, ['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    $response = new Response(500, ['error' => 'Server error: ' . $e->getMessage()]);
}

http_response_code($response->getStatusCode());
header('Content-Type: application/json');
echo $response->getBody();