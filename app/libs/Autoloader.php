<?php

namespace libs;

final class Autoloader
{
    private string $root;

    public function __construct(string $root)
    {
        $this->root = $root;
    }

    public function load()
    {
        spl_autoload_register([ $this, 'loadClass' ]);
    }

    private function loadClass($class)
    {
        $filePath = $this->createFilePath($class);

        if (is_readable($filePath)) {
            require_once($filePath);
            return;
        } else {
            require_once(__DIR__ . '/../views/404.html');
            exit;
        }
    }

    private function createFilePath($class)
    {
        $classWithNameSpace = ltrim($class, '\\');

        $pieces[] = $this->root;
        $pieces = array_merge($pieces, explode('\\', $classWithNameSpace));

        $path = implode(DIRECTORY_SEPARATOR, $pieces) . '.php';
        if (is_readable($path)) {
            return $path;
        }

        return null;
    }
}