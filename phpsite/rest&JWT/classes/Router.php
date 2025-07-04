<?php
class Router {
    private $request;
    private $routeMatcher;
    private $routes = [];

    public function __construct(RequestInterface $request, RouteMatcher $routeMatcher) {
        $this->request = $request;
        $this->routeMatcher = $routeMatcher;
    }

    public function addRoute($method, $path, $handler, $middleware = null) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    public function dispatch() {
        $match = $this->routeMatcher->match(
            $this->routes,
            $this->request->getMethod(),
            $this->request->getPath()
        );

        if ($match) {
            // print_r($this->routes);
            $middleware = $match['middleware'];
            if ($middleware) {
                $response = $middleware->handle($this->request);
                if ($response) {
                    return $response; 
                }
            }
            return call_user_func_array($match['handler'], array_values($match['params']));
        }

        return new Response(404, json_encode(['error' => 'Not Found']));
    }
}