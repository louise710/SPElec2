<?php
require 'api/BookController.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Handle /books endpoint
if ($uri[1] !== 'books') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$controller = new BookController();

switch($requestMethod) {
    case 'GET':
        if (isset($uri[2])) {
            $controller->getBook($uri[2]);
        } else {
            $controller->getAllBooks();
        }
        break;
    case 'POST':
        $controller->createBook();
        break;
    case 'PUT':
        if (isset($uri[2])) {
            $controller->updateBook($uri[2]);
        }
        break;
    case 'DELETE':
        if (isset($uri[2])) {
            $controller->deleteBook($uri[2]);
        }
        break;
    default:
        header("HTTP/1.1 405 Method Not Allowed");
        break;
}