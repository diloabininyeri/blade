<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class CsrfDirective implements BladeDirectiveInterface
{
    public function getDirectiveRegexPattern(): ?string
    {
        return null;
    }

    public function replaceTemplate(string $template):string
    {
        $tokenName=CsrfToken::CSRF_INPUT_NAME;
        return str_replace('@csrf', '<input type="hidden" value="{{csrf()->generateToken()}}" name="'.$tokenName.'"/>', $template);
    }
}