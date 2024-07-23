<?php

namespace App\Models;

class Category {

    public function __construct(
        private int $id,
        private string $name,
        private string $createAt,
        private string $updatedAt
    ) {
    }

    public function id(): int {
        return $this->id;
    }

    public function name(): string {
        return $this->name;
    }

    public function createAt(): string {
        return $this->createAt;
    }

    public function updatedAt(): string {
        return $this->updatedAt;
    }
}