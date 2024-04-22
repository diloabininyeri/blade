<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class EndMobileDirective implements BladeDirectiveInterface
{

    /**
     * @inheritDoc
     */
    public function getDirectiveRegexPattern():?string
    {
        return '/@endmobile/';
    }

    /**
     * @inheritDoc
     */
    public function replaceTemplate(string $template):string
    {
        return  preg_replace_callback($this->getDirectiveRegexPattern(), static function () {
            return '<?php endif;?>';
        }, $template);
    }
}