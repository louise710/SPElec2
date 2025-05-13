<?php
interface RequestInterface {
    public function getMethod(): string;
    public function getPath(): string;
    public function getBody(): array;
    public function setUserPayload(array $payload): void;
    public function getUserPayload(): ?array;
}