<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class BreakDirective implements BladeDirectiveInterface
{

    #[\Override]
    public function getDirectiveRegexPattern(): ?string
    {
        return '/@break(.*)/';
    }

    #[\Override]
    public function replaceTemplate(string $template): string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), static function ($find) {
            return '<?php if(' . $find[1] . '){ break; }?>';
        }, $template);
    }
}