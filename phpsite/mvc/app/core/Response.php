<?php
namespace App\Core;

class Response {
    private $statusCode;
    private $body;
    private $headers = [];

    public function __construct(int $statusCode, $body = '', array $headers = []) {
        $this->statusCode = $statusCode;
        $this->body = $body;
        $this->headers = array_merge([
            'Content-Type' => 'application/json'
        ], $headers);
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function getBody() {
        return $this->body;
    }

    public function getHeaders(): array {
        return $this->headers;
    }

    public function send(): void {
        http_response_code($this->statusCode);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        echo $this->body;
    }
}