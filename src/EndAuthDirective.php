<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class EndAuthDirective implements BladeDirectiveInterface
{

    /**
     * @inheritDoc
     */
    public function getDirectiveRegexPattern():?string
    {
        return '/@endauth/m';
    }

    /**
     * @inheritDoc
     */
    public function replaceTemplate(string $template):string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), static function () {
            return '<?php endif; ?>';
        }, $template);
    }
}