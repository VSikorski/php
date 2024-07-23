<?php

namespace App\Kernel\Http;
use App\Kernel\Upload\UploadedFileInterface;
use App\Kernel\Validator\ValidatorInterface;

interface RequestInterface {
    public static function createFromGlobals(): static;
    public function uri(): string;
    public function method(): string;
    public function input(string $name, $default = null): string|null;
    public function file(string $name): ?UploadedFileInterface;
    public function setValidator(ValidatorInterface $validator): void;
    public function validate(array $rules): bool;
    public function errors(): array;
}