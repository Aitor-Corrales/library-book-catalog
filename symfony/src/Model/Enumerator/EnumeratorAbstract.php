<?php

namespace App\Model\Enumerator;

use ReflectionClass;

abstract class EnumeratorAbstract
{
    /**
     * @return String[]
     * Returns an associative array with every constant in the class
     */
    public function getEnumList(): array
    {
        return (new ReflectionClass(self::class))->getConstants();
    }
}