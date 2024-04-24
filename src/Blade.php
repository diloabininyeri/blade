<?php

namespace Zeus\Blade;

use Closure;
use Zeus\Blade\interfaces\BladeDirectiveInterface;

class Blade extends AbstractBlade
{
    /**
     * @var BladeDirectiveInterface[] $directives
     */
    protected array $directives = [

        CommentDirective::class,
        CsrfDirective::class,
        ExtendsDirective::class,
        YieldDirective::class,
        IncludeIfDirective::class,
        IncludeDirective::class,
        CurlBracesDirective::class,
        BreakDirective::class,
        RemoveYields::class,
        RemoveSectionDirective::class,
        IfDirective::class,
        EndifDirective::class,
        ForDirective::class,
        EndForDirective::class,
        PhpDirective::class,
        EndPhpDirective::class,
        ElseDirective::class,
        ElseIfDirective::class,
        ForeachDirective::class,
        EndforeachDirective::class,
        CurlBracesAllowedHtmlChars::class,
        AuthDirective::class,
        EndAuthDirective::class,
        WhileDirective::class,
        EndWhileDirector::class,
        //MobileDirective::class,
        //EndMobileDirective::class,
        CustomDirective::class,
        CompressBlade::class,
        JsEscapeDirective::class,

    ];

    protected static array  $dynamicDirectives=[];


    /**
     * @return array
     */
    public function getDynamicDirectives(): array
    {
        return self::$dynamicDirectives;
    }

    /**
     * @param string $directive
     * @param Closure $closure
     */
    public static function directive(string $directive, Closure $closure):void
    {
        self::$dynamicDirectives[$directive]=$closure;
    }

    public static function in(string $folder):self
    {
        return new static($folder);
    }
}