<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class EndWhileDirector implements BladeDirectiveInterface
{

    #[\Override]
    public function getDirectiveRegexPattern(): ?string
    {
        return '/@endwhile(.*)/';
    }

    #[\Override] public function replaceTemplate(string $template): string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), static function () {
            return '<?php endwhile; ?>';
        }, $template);
    }
}