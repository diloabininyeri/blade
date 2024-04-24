<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class WhileDirective implements BladeDirectiveInterface
{

    #[\Override]
    public function getDirectiveRegexPattern(): ?string
    {
        return '/@while(.*)/';
    }

    #[\Override]
    public function replaceTemplate(string $template): string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), static function ($find) {
            return '<?php while' . $find[1] . ' :?>';
        }, $template);
    }
}