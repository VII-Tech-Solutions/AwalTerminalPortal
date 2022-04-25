<?php

namespace App\Constants;

use BenSampo\Enum\Enum;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionException;

class Status extends CustomEnum
{
    const INACTIVE = 0;
    const ACTIVE = 1;
    const IN_PROGRESS = 2;

    static function all()
    {
        try {
            $this_class = new ReflectionClass(__CLASS__);
            $reflectionClassConstants = $this_class->getReflectionConstants();
            $reflectionClassConstants = collect($reflectionClassConstants);
            $public_constants = $reflectionClassConstants->filter(function ($the_constant) {
                /** @var ReflectionClassConstant $the_constant */
                return !$the_constant->isPrivate();
            })->pluck(Attributes::NAME);

            $result = [];
            foreach ($public_constants as $public_constant) {
                $result[ucfirst(strtolower(str_replace('_', ' ',$public_constant)))] = $this_class->getConstant($public_constant);
            }
            $result = array_flip($result);
            return $result;

        } catch (ReflectionException $e) {
            return [];
        }

    }

}
