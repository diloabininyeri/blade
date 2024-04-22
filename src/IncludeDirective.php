<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class IncludeDirective implements BladeDirectiveInterface
{
    public function __construct(private readonly string $folder)
    {
    }

    /**
     * @inheritDoc
     */
    public function getDirectiveRegexPattern(): ?string
    {
        return '/@include\((.*)\)/';
    }

    /**
     * @inheritDoc
     */
    public function replaceTemplate(string $template): string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), function ($find) {
            return file_get_contents(
                $this->getPath(
                    trim($find[1], "'")
                )
            );
        }, $template);
    }

    private function getPath(string $view): string
    {
        return Path::blade($view,$this->folder);
    }
}