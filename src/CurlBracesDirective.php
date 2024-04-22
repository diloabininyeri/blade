<?php

namespace Zeus\Blade;

use Zeus\Blade\exceptions\BladeFilterNotFoundException;
use Zeus\Blade\interfaces\BladeDirectiveInterface;

class CurlBracesDirective implements BladeDirectiveInterface
{

    /**
     * @inheritDoc
     */
    public function getDirectiveRegexPattern():?string
    {
        return '/.?{{(.*)}}/sU';
    }

    /**
     * @inheritDoc
     */
    public function replaceTemplate(string $template):string
    {
        return preg_replace_callback($this->getDirectiveRegexPattern(), function ($find) {
            $firstLetter = $this->getFirstLetter($find);

            if ($firstLetter === '@') {
                return $find[0];
            }

            if ($firstLetter !== ' ') {
                return $firstLetter . $this->buildContent($find);
            }

            return $this->buildContent($find);
        }, $template);
    }

    /**
     * @param $find
     * @return mixed
     */
    private function getFirstLetter($find)
    {
        return $find[0][0];
    }

    /**
     * @param $find
     * @return string
     * @throws BladeFilterNotFoundException
     *
     */
    private function buildContent($find): string
    {
        $content = $find[1];
        if (str_contains($content, '|')) {
            [$statement, $filter] = explode('|', $content);
            if (is_callable($filter)) {
                $content = $filter($statement);
            } else {
                $content = (new BladeFilters())->filter($filter, $statement);
            }
        }
        return '<?php echo htmlspecialchars(' . $content . ');?>';
    }
}