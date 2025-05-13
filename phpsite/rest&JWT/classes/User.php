<?php
// interface Model {
//     public function getAll();
//     public function getById($id);
//     public function create($data);
//     public function update($id, $data);
//     public function delete($id);
//     public function getByName($name);
// }
class User implements Model {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM appusers");
    }

    public function getById($id) {
        return $this->db->query("SELECT * FROM appusers WHERE id = ?", [$id]);
    }

    public function create($data) {
        $processedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->db->query("INSERT INTO appusers (name, password) VALUES (?, ?)", [$data['name'], $processedPassword]);
    }

    public function update($id, $data) {
        $this->db->query("UPDATE appusers SET name = ?, email = ? WHERE id = ?", [$data['name'], $data['password'], $id]);
    }

    public function delete($id) {
        $this->db->query("DELETE FROM appusers WHERE id = ?", [$id]);
    }

    public function getByName($name) {
        return $this->db->query("SELECT * FROM appusers WHERE name = ?", [$name]);
    }
    
    // public function getByEmail($email) {
    //     return $this->db->query("SELECT * FROM users WHERE email = ?", [$email]);
    // }
}