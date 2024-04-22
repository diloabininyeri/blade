<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class ElseIfDirective implements BladeDirectiveInterface
{

    /**
     * @inheritDoc
     */
    public function getDirectiveRegexPattern():?string
    {
        return '/@elseif(.*)/';
    }

    /**
     * @inheritDoc
     */
    public function replaceTemplate(string $template):string
    {
        return  preg_replace_callback($this->getDirectiveRegexPattern(), static function ($find) {
            return '<?php elseif('.$find[1].') : ?>';
        }, $template);
    }
}