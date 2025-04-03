<?php
class UserRepository implements DataRepositoryInterface {
    private $db;

    public function __construct(iDBFuncs $db) {
        $this->db = $db;
    }

    public function getAll() {
        return $this->db->select()->from('students')->getAll();
    }

    public function getById($id) {
        return $this->db->select()->from('students')->where('id', $id)->get();
    }

    public function create($data) {
        $this->db->table('students')->insert([
            $data['id'],
            $data['name'],
            $data['email']
        ]);
    }

    public function update($id, $data) {
        $this->db->table('students')
            ->where('id', $id)
            ->update($data);
    }

    public function delete($id) {
        $this->db->table('students')
            ->where('id', $id)
            ->delete();
    }
}