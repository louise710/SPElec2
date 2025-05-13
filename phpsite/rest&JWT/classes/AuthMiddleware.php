<?php
class AuthMiddleware {
    private $jwtHandler;

    public function __construct(JwtHandler $jwtHandler) {
        $this->jwtHandler = $jwtHandler;
    }

    public function handle(RequestInterface $request) {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            return new Response(401, json_encode(['error' => 'Missing Authorization header']));
        }

        $authHeader = $headers['Authorization'];
        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return new Response(401, json_encode(['error' => 'Invalid Authorization header format']));
        }

        $token = $matches[1];
        $payload = $this->jwtHandler->validateToken($token);
        if (!$payload) {
            return new Response(401, json_encode(['error' => 'Invalid or expired token']));
        }

        $request->setUserPayload($payload);
        return null; // No error, proceed
    }
}