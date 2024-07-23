<?php

namespace App\Kernel\Session;

interface SessionInterface {
    public function set($key, $value): void;
    public function get($key, $default = null);
    public function getFlash($key, $default = null);
    public function has(string $key): bool;
    public function remove(string $key): void;
    public function destroy(): void;
}