<?php
return [
    ['method' => 'POST', 'path' => '/login', 'handler' => function () use ($controller) {
        return $controller->login();
    }, 'middleware' => null],

    ['method' => 'GET', 'path' => '/users', 'handler' => function () use ($controller) {
        return $controller->getAllUsers();
    }, 'middleware' => $authMiddleware],
    
    ['method' => 'GET', 'path' => '/users/{id}', 'handler' => function ($id) use ($controller) {
        return $controller->getUserById($id);
    }, 'middleware' => $authMiddleware],
    
    ['method' => 'POST', 'path' => '/users', 'handler' => function () use ($controller) {
        return $controller->createUser();
    }, 'middleware' => null],
    
    ['method' => 'PUT', 'path' => '/users/{id}', 'handler' => function ($id) use ($controller) {
        return $controller->updateUser($id);
    }, 'middleware' => null],
    
    ['method' => 'DELETE', 'path' => '/users/{id}', 'handler' => function ($id) use ($controller) {
        return $controller->deleteUser($id);
    }, 'middleware' => null],
];