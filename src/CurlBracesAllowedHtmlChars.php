<?php

namespace Zeus\Blade;


use Zeus\Blade\interfaces\BladeDirectiveInterface;

class CurlBracesAllowedHtmlChars implements BladeDirectiveInterface
{

    /**
     * @inheritDoc
     */
    public function getDirectiveRegexPattern():?string
    {
        return '/{!!(.*)!!}/';
    }

    /**
     * @inheritDoc
     */
    public function replaceTemplate(string $template):string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), static function ($find) {
            return '<?php echo' . $find[1] . '; ?>';
        }, $template);
    }
}