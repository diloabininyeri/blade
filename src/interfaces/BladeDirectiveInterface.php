<?php

namespace Zeus\Blade\interfaces;

/**
 * Interface BladeDirectiveInterface
 */
interface BladeDirectiveInterface
{

    /**
     * @return string|null
     */
    public function getDirectiveRegexPattern(): ?string;

    /**
     * @param string $template
     * @return mixed
     */
    public function replaceTemplate(string $template): string;
}