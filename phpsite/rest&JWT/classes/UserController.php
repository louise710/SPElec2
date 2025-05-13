<?php
class UserController {
    private $user;
    private $request;
    private $jwtHandler;

    public function __construct(Model $user, RequestInterface $request, JwtHandler $jwtHandler) {
        $this->user = $user;
        $this->request = $request;
        $this->jwtHandler = $jwtHandler;
    }

    public function login() {
        $data = $this->request->getBody();
        $name = $data['name'] ?? null;
        $password = $data['password'] ?? null;

        if (!$name || !$password) {
            return new Response(400, json_encode(['error' => 'Name and password are required']));
        }

        $user = $this->user->getByName($name);
        if (empty($user) || !password_verify($password, $user[0]['password'])) {
            return new Response(401, json_encode(['error' => 'Invalid credentials']));
        }

        $token = $this->jwtHandler->generateToken($user[0]['id']);
        return new Response(200, json_encode(['token' => $token]));
    }

    public function getAllUsers() {
        return new Response(200, json_encode($this->user->getAll()));
    }

    public function getUserById($id) {
        $user = $this->user->getById($id);
        if (empty($user)) {
            return new Response(404, json_encode(['error' => 'User not found']));
        }
        return new Response(200, json_encode($user[0]));
    }

    public function createUser() {
        $data = $this->request->getBody();
        $this->user->create($data);
        return new Response(201, json_encode(['message' => 'User created']));
    }

    public function updateUser($id) {
        $data = $this->request->getBody();
        $this->user->update($id, $data);
        return new Response(200, json_encode(['message' => 'User updated']));
    }

    public function deleteUser($id) {
        $this->user->delete($id);
        return new Response(204, '');
    }
}