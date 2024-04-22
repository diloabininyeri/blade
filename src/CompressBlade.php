<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class CompressBlade implements BladeDirectiveInterface
{

    /**
     * @inheritDoc
     */
    public function getDirectiveRegexPattern(): ?string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function replaceTemplate(string $template):string
    {
        return str_replace(array("\n\n", '    '), '', $template);
    }
}