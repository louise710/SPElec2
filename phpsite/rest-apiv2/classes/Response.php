<?php
class Response {
    private $statusCode;
    private $body;

    public function __construct($statusCode, $body) {
        $this->statusCode = $statusCode;
        // Encode to JSON only if $body is not null and not already a string
        $this->body = ($body !== null && !is_string($body)) ? json_encode($body) : $body;
    }

    public function getStatusCode() {
        return $this->statusCode;
    }

    public function getBody() {
        return $this->body;
    }
}