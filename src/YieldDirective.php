<?php

namespace Zeus\Blade;

use Zeus\Blade\interfaces\BladeDirectiveInterface;

class YieldDirective implements BladeDirectiveInterface
{
    /**
     * @var string
     */
    private string  $yieldName;

    /**
     * @var string|null
     */
    private ?string $template=null;

    /**
     * @return mixed|string
     */
    public function getDirectiveRegexPattern():?string
    {
        return '/@yield\((?P<yield_name>.*)\)/';
    }

    /***
     * @param string $template
     * @return string
     */
    public function replaceTemplate(string $template):string
    {
        $this->template=$template;
        return preg_replace_callback($this->getDirectiveRegexPattern(), function ($find) {
            $this->yieldName = trim($find['yield_name'], '\'');
            return  $this->replaceYieldWithSection($this->template);
        }, $template);
    }

    /**
     * @param string $template
     * @return string
     */
    private function replaceYieldWithSection(string $template): string
    {
        $re = "/@section\(('$this->yieldName')\)\n*(?P<html_content>.*)\n*@endsection/sU";
        preg_match($re, $this->template, $matches, PREG_OFFSET_CAPTURE, 0);

        return $matches['html_content'][0];
    }
}