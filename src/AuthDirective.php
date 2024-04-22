<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class AuthDirective implements BladeDirectiveInterface
{

    /**
     * @inheritDoc
     */
    public function replaceTemplate(string $template): string
    {
        return preg_replace_callback(
            $this->getDirectiveRegexPattern(),
            static fn($f) => '<?php if(user()->check()) :?>',
            $template
        );
    }

    /**
     * @inheritDoc
     */
    public function getDirectiveRegexPattern(): ?string
    {
        return '/@auth(.*)/';
    }
}