<?php

namespace Zeus\Blade;

class Path
{

    public static function blade(string $view, string $folder):string
    {
        return sprintf(
            '%s%s%s.blade.php',
            $folder,
            DIRECTORY_SEPARATOR,
            str_replace('.', '/', $view)
        );
    }

}