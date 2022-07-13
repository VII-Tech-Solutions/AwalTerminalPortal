<?php

namespace App\Constants;
use BenSampo\Enum\Enum;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionException;


class SectionTypes extends CustomEnum
{
    const HEADER = "header";
    const SECTION_1 = "section_1";
    const SECTION_2 = "section_2";
    const SECTION_3 = "section_3";
    const SECTION_4 = "section_4";
    const SECTION_5 = "section_5";
    const SECTION_6 = "section_6";
    const FOOTER = "footer";

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
