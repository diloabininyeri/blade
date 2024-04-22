<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class RemoveSectionDirective implements BladeDirectiveInterface
{
    /**
     * @return mixed|string
     */
    public function getDirectiveRegexPattern():?string
    {
        return '/@section\((?P<yield_name>.*)\)\n*(?P<html_content>.*)\n*@endsection/sU';
    }

    /**
     * @param string $template
     * @return string
     */
    public function replaceTemplate(string $template):string
    {
        return  preg_replace_callback($this->getDirectiveRegexPattern(), static function () {
            return null;
        }, $template);
    }
}