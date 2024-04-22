<?php

namespace Zeus\Blade\filters;

use Exception;
use Zeus\Blade\exceptions\BladeFilterNotFoundException;

abstract class AbstractBladeFilter
{

    /**
     * @param $name
     * @param $value
     * @return mixed
     * @throws BladeFilterNotFoundException
     * @see PhoneFilter::filter() for example using
     */
    final public function filter($name, $value): mixed
    {
        try {
            $class = $this->getFilterArray()[$name];
            return (new $class)->filter($value);
        } catch (Exception $exception) {
            throw new BladeFilterNotFoundException(
                sprintf('%s filter not found in the %s::filters ',
                    $name, BladeFilters::class)
            );
        }
    }

    /**
     * @return mixed
     */
    private function getFilterArray():array
    {
        return $this->filters;
    }
}