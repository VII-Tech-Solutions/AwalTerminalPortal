<?php

namespace App\Constants;

use ReflectionClass;
use ReflectionClassConstant;
use ReflectionException;

/**
 * Class FlightClasses
 * @package App\Constants
 */
class FlightClasses extends CustomEnum
{
    const First_Class = 0;
    const Business_Class = 1;
    const Premium_Economy = 2;
    const Economy_class = 3;

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
            return array_flip($result);

        } catch (ReflectionException $e) {
            return [];
        }

    }

}
