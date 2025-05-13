<?php
namespace App\Models;

interface DataRepositoryInterface {
    public function table(string $tableName): object;
    public function insert(array $values): int;
    public function get(): array;
    public function getAll(): array;
    public function select(array $fieldList = null): object;
    public function from($table): object;
    public function where($field, $value, $operator = '='): object;
    public function whereOr(): object;
    public function showQuery(): string;
    public function update(array $values): int;
    public function delete(): int;
    public function showValueBag(): array;
}