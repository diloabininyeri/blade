<?php

namespace Zeus\Blade;

use Zeus\Blade\Interfaces\BladeDirectiveInterface;

class IncludeIfDirective implements BladeDirectiveInterface
{
    public function getDirectiveRegexPattern(): ?string
    {
        return '/@includeIf\(([^,]+),\s*\'([^\']+)\'\)/';
    }

    public function replaceTemplate(string $template): string
    {
        return preg_replace_callback(
            $this->getDirectiveRegexPattern(),
            function (array $matches) {
                [, $condition, $file] = $matches;
                return $this->template($condition, $file);
            },
            $template
        );
    }

    private function template(string $condition, string $file): string
    {
        return '<?php if ('.$condition.'): ?>@include('.$file.')<?php endif; ?>';
    }
}
