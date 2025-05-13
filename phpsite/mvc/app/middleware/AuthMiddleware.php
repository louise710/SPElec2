<?php
namespace App\Middleware;

use App\Core\Response;
use App\Models\DataRepositoryInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class AuthMiddleware {
    private $userRepository;
    private $secretKey;

    public function __construct(DataRepositoryInterface $userRepository, string $secretKey) {
        $this->userRepository = $userRepository;
        $this->secretKey = $secretKey;
    }

    public function authenticate(callable $next): callable {
        return function() use ($next) {
            $headers = (new \App\Core\Request())->getHeaders();
            $authHeader = $headers['Authorization'] ?? '';
            
            if (empty($authHeader) || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                return new Response(401, json_encode(['error' => 'No token provided or invalid format']));
            }
            
            $token = $matches[1];
            
            try {
                $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
                
                $user = $this->userRepository->table('users')
                    ->where('id', $decoded->user_id)
                    ->where('token', $token)
                    ->get();
                    
                if (empty($user)) {
                    return new Response(401, json_encode(['error' => 'Invalid token']));
                }
                
                return call_user_func($next, $decoded);
                
            } catch (ExpiredException $e) {
                return new Response(401, json_encode(['error' => 'Token expired']));
            } catch (\Exception $e) {
                return new Response(401, json_encode(['error' => 'Invalid token: ' . $e->getMessage()]));
            }
        };
    }
}