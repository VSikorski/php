<?php

namespace App\Models;
use App\Kernel\Auth\User;
 
class Review {
    public function __construct(
        private int $id,
        private string $rating,
        private string $comment,
        private string $created_at,
        private User $user
    ) {
    }

    public function id(): int { 
        return $this->id; 
    }

    public function comment(): string {
        return $this->comment;
    }

    public function created_at(): string {
        return $this->created_at;
    }

    public function user(): User {
        return $this->user;
    }

    public function rating() {
        return $this->rating;
    }
}