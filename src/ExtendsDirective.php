<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

readonly class ExtendsDirective implements BladeDirectiveInterface
{


    public function __construct(private string $folder)
    {
    }

    /**
     * @return mixed|string
     */
    public function getDirectiveRegexPattern(): ?string
    {
        return '/@extends\((?P<view>.*)\)/';
    }

    /***
     * @param string $template
     * @return string
     */
    public function replaceTemplate(string $template): string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), function ($find) {
            $blade = trim($find['view'], "'");
            return file_get_contents(
                Path::blade($blade, $this->folder)
            );
        }, $template);
    }
}