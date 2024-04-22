<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class MobileDirective implements BladeDirectiveInterface
{
    /**
     * @inheritDoc
     */
    public function replaceTemplate(string $template):string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), static function ($f) {
            return '<?php if(request()->isMobile()):?>';
        }, $template);
    }

    /**
     * @inheritDoc
     */
    public function getDirectiveRegexPattern():?string
    {
        return '/@mobile(.*)/';
    }
}