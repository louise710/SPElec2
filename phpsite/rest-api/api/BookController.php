<?php
class BookController {
    private $books = [
        1 => ['id' => 1, 'title' => '1984', 'author' => 'George Orwell'],
        2 => ['id' => 2, 'title' => 'Dune', 'author' => 'Frank Herbert'],
        3 => ['id' => 3, 'title' => 'Dune Messiah', 'author' => 'Frank Herbert'],
        4 => ['id' => 4, 'title' => 'Children of Dune', 'author' => 'Frank Herbert'],
        5 => ['id' => 5, 'title' => 'Emperor of Dune', 'author' => 'Frank Herbert'],
        6 => ['id' => 6, 'title' => "Harry Potter and the Philosopher's Stone", 'author' => 'J.K. Rawling'],
        7 => ['id' => 7, 'title' => 'Harry Potter and the Chamber of Secrets', 'author' => 'J.K. Rawling'],
        8 => ['id' => 8, 'title' => 'Harry Potter and the Prisoner of Azkaban', 'author' => 'J.K. Rawling'],
    ];

    public function getAllBooks() {
        echo json_encode(array_values($this->books));
    }

    public function getBook($id) {
        if (!isset($this->books[$id])) {
            http_response_code(404);
            echo json_encode(['error' => 'Book not found']);
            return;
        }
        echo json_encode($this->books[$id]);
    }

    public function createBook() {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = max(array_keys($this->books)) + 1;
        $this->books[$id] = [
            'id' => $id,
            'title' => $data['title'],
            'author' => $data['author']
        ];
        http_response_code(201);
        echo json_encode($this->books[$id]);
    }

    public function updateBook($id) {
        if (!isset($this->books[$id])) {
            http_response_code(404);
            return;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $this->books[$id]['title'] = $data['title'];
        $this->books[$id]['author'] = $data['author'];
        echo json_encode($this->books[$id]);
    }

    public function deleteBook($id) {
        if (!isset($this->books[$id])) {
            http_response_code(404);
            return;
        }
        unset($this->books[$id]);
        echo json_encode(['message' => 'Book deleted']);
    }
}