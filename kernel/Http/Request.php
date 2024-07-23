<?php

namespace App\Kernel\Http;
use App\Kernel\Upload\UploadedFile;
use App\Kernel\Upload\UploadedFileInterface;
use App\Kernel\Validator\ValidatorInterface;

class Request implements RequestInterface {
    private ValidatorInterface $validator;

    public function __construct(
        public readonly array $get, 
        public readonly array $post, 
        public readonly array $server, 
        public readonly array $files, 
        public readonly array $cookies) {
        
    }

    public static function createFromGlobals(): static {
        return new static($_GET, $_POST, $_SERVER, $_FILES, $_COOKIE);
    }

    public function uri(): string {
        return strtok($this->server["REQUEST_URI"], '?');
    }

    public function method(): string {
        return $this->server["REQUEST_METHOD"];
    }

    public function input(string $name, $default = null): string|null {
        return $this->get[$name] ?? $this->post[$name] ?? $default;
    }

    public function file(string $name): ?UploadedFileInterface {
        if (! isset($this->files[$name])) {
            return null;
        }
        return new UploadedFile(
            $this->files[$name]['name'],
            $this->files[$name]['type'],
            $this->files[$name]['tmp_name'],
            $this->files[$name]['error'],
            $this->files[$name]['size'],
        );
    }

    public function setValidator(ValidatorInterface $validator): void {  
        $this->validator = $validator;
    }

    public function validate(array $rules): bool {
        $data = [];

        foreach ($rules as $field => $rule) {
            $data[$field] = $this->input($field);
        }

        return $this->validator->validate($data, $rules);
    }

    public function errors(): array {
        return $this->validator->errors();
    }
}