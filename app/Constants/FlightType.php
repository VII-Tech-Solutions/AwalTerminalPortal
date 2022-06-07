<?php

namespace App\Constants;

use App\Helpers;
use Exception;
use ReflectionClass;
use ReflectionClassConstant;

class FlightType extends CustomEnum
{
    const Arrival = 1;
    const Departure = 2;

    /**
     * All
     * @return array
     */
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
                $result[Helpers::readableText($public_constant)] = $this_class->getConstant($public_constant);
            }
            return array_flip($result);
        } catch (Exception $e) {
            return [];
        }
    }
}

