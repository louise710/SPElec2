<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHandler {
    private $secretKey = '6MqI6 tEmp32123ShhH*$!!!'; 
    private $algorithm = 'HS256';

    public function generateToken($userId) {
        $payload = [
            'iss' => 'http://localhost', 
            'aud' => 'http://localhost', 
            'iat' => time(),            
            'exp' => time() + 3600,     
            'userId' => $userId       
        ];
        return JWT::encode($payload, $this->secretKey, $this->algorithm);
    }

    public function validateToken($token) {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, $this->algorithm));
            return (array) $decoded; 
        } catch (\Exception $e) {
            return null; // expired token or invalidddd
        }
    }
}