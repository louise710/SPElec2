<?php
namespace App\Controllers;

use App\Core\Response;
use App\Models\DataRepositoryInterface;
use Firebase\JWT\JWT;

class AuthController {
    private $userRepository;
    private $secretKey;

    public function __construct(DataRepositoryInterface $userRepository, string $secretKey) {
        $this->userRepository = $userRepository;
        $this->secretKey = $secretKey;
    }

    public function register(): Response {
        $data = (new \App\Core\Request())->getBody();
        
        if (!isset($data['username']) || !isset($data['password']) || !isset($data['email'])) {
            return new Response(400, json_encode(['error' => 'Username, password and email are required']));
        }
        
        $existingUser = $this->userRepository->table('users')
            ->where('username', $data['username'])
            ->get();
            
        if (!empty($existingUser)) {
            return new Response(409, json_encode(['error' => 'Username already exists']));
        }
        
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $userId = $this->userRepository->table('users')->insert([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $hashedPassword,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        return new Response(201, json_encode([
            'message' => 'User registered successfully',
            'user_id' => $userId
        ]));
    }

    public function login(): Response {
        $data = (new \App\Core\Request())->getBody();
        
        if (!isset($data['username']) || !isset($data['password'])) {
            return new Response(400, json_encode(['error' => 'Username and password are required']));
        }
        
        $user = $this->userRepository->table('users')
            ->where('username', $data['username'])
            ->get();
            
        if (empty($user) || !password_verify($data['password'], $user['password'])) {
            return new Response(401, json_encode(['error' => 'Invalid credentials']));
        }
        
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;
        
        $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'user_id' => $user['id'],
            'username' => $user['username']
        ];
        
        $token = JWT::encode($payload, $this->secretKey, 'HS256');
        
        $this->userRepository->table('users')
            ->where('id', $user['id'])
            ->update([
                'token' => $token,
                'token_expires_at' => date('Y-m-d H:i:s', $expirationTime)
            ]);
            
        return new Response(200, json_encode([
            'token' => $token,
            'expires_at' => $expirationTime
        ]));
    }
}