<?php

namespace app\framework;

use Exception;

class Template
{
    public static function render(string $view, array $data): void
    {
        $file = __DIR__ . "/../views/{$view}.php";

        if (!file_exists($file)) {
            throw new Exception("A view {$view} não existe");
        }

        ob_start();

        extract($data);

        require $file;

        $content = ob_get_contents();

        ob_end_clean();

        echo $content;
    }

}