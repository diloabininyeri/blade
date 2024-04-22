<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class ForeachDirective implements BladeDirectiveInterface
{

    /**
     * @inheritDoc
     */
    public function getDirectiveRegexPattern():?string
    {
        return '/@foreach(.*)/';
    }

    /**
     * @inheritDoc
     */
    public function replaceTemplate(string $template):string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), static function ($find) {
            print_r($find);
            return '<?php foreach' . $find[1] . ' :?>';
        }, $template);
    }
}