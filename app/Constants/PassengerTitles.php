<?php

namespace App\Constants;

use ReflectionClass;
use ReflectionClassConstant;
use ReflectionException;

/**
 * Class PassengerTitles
 * @package App\Constants
 */
class PassengerTitles extends CustomEnum
{
    const Mr = 0;
    const Ms = 1;
    const Mrs = 2;
    const Miss = 3;

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
