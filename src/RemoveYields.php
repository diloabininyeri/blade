<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class RemoveYields implements BladeDirectiveInterface
{

    /**
     * @return mixed|string
     */
    public function getDirectiveRegexPattern():?string
    {
        return '/@yield\((?P<yield_name>.*)\)/';
    }

    /***
     * @param string $template
     * @return string
     */
    public function replaceTemplate(string $template):string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), static function () {
            return null;
        }, $template);
    }
}