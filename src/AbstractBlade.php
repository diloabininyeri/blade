<?php

namespace Zeus\Blade;

use InvalidArgumentException;
use Zeus\Blade\interfaces\BladeDirectiveInterface;

abstract class AbstractBlade
{
    private ?string $template=null;


    protected function __construct(private readonly string $folder)
    {

    }

    /**
     * @param string $template
     * @return string
     */
    final public function renderTemplate(string $template):string
    {
        return $this->template=array_reduce($this->directives, function ($template, $class) {
            /**
             * @var BladeDirectiveInterface $object
             */
            $object = new $class($this->folder);
            if ($object instanceof BladeDirectiveInterface) {
                return $object->replaceTemplate($template);
            }
            $this->throwException($class);
        }, $template);
    }

    public function renderFile(string $bladeName):string
    {
        return $this->renderTemplate(
            file_get_contents($this->folder . DIRECTORY_SEPARATOR . $bladeName)
        );
    }

    /**
     * @return string
     */
    final public function renderWithCustomDirective():string
    {
        foreach ($this->getDynamicDirectives() as $directive=>$closure) {
            $this->template= preg_replace_callback("/@$directive\((.*)\)/", $closure, $this->template);
        }
        return $this->template;
    }

    /***
     * @param string $class
     * @return never
     */
    private function throwException(string $class):never
    {
        throw new InvalidArgumentException("$class must be an instance of BladeDirectiveInterface");
    }
}