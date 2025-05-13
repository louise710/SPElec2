<?php
namespace App\Controllers;

use App\Core\Response;
use App\Models\DataRepositoryInterface;

class UserController {
    private $userRepository;

    public function __construct(DataRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function index(): Response {
        $users = $this->userRepository->table('users')->getAll();
        return new Response(200, json_encode($users));
    }

    public function show($id): Response {
        $user = $this->userRepository->table('users')
            ->where('id', $id)
            ->get();
            
        if (empty($user)) {
            return new Response(404, json_encode(['error' => 'User not found']));
        }
        
        return new Response(200, json_encode($user));
    }
}