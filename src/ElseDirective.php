<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class ElseDirective implements BladeDirectiveInterface
{

    /**
     * @inheritDoc
     */
    public function getDirectiveRegexPattern():?string
    {
        return '/@else$/m';
    }

    /**
     * @inheritDoc
     */
    public function replaceTemplate(string $template):string
    {
        return  preg_replace_callback($this->getDirectiveRegexPattern(), static function () {
            return '<?php else: ?>';
        }, $template);
    }
}