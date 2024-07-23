<?php

namespace App\Kernel\Config;

class Config implements ConfigInterface
{
    public function get(string $key, $default = null): mixed 
    {
        //database.host
        [$file, $key] = explode(".", $key);

        $configPath = APP_PATH."/Config/$file.php";

        if (!file_exists($configPath)) {
            return $default;
        }

        $config = require $configPath;

        return $config[$key] ?? $default;
    }
}