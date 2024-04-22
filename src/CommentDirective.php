<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class CommentDirective implements BladeDirectiveInterface
{

    /***
     * @return string|null
     */
    public function getDirectiveRegexPattern(): ?string
    {
        return '/{{--(.*?)--}}/ms';
    }

    /***
     * @param string $template
     * @return string
     */
    public function replaceTemplate(string $template):string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), static function ($find) {
            return '<?php /*' . $find[1] . '*/ ?>';
        }, $template);
    }
}