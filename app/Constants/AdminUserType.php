<?php

namespace App\Constants;

use App\Helpers;

class AdminUserType extends CustomEnum
{
    const GA = 300;
    const ELITE_ONLY = 400;
    const SUPER_ADMIN = 1000;

    /**
     * Admin
     * @return array
     */
    static function generalAviation(){
        return [self::GA];
    }

    /**
     * Admin
     * @return array
     */
    static function eliteServices(){
        return [self::SUPER_ADMIN, self::ELITE_ONLY];
    }

    /**
     * Super Admin
     * @return int
     */
    static function superAdmin(){
        return self::SUPER_ADMIN;
    }

    /**
     * All Users
     * @return array
     */
    static function allUsers(){
        return self::getValues();
    }

    /**
     * All Except Super Admin
     * @return array
     */
    static function allExceptSuperAdmin()
    {
        $collection = collect();
        $array = static::toArray();
        $array = array_flip($array);
        foreach ($array as $key => $item){
            if($key == self::SUPER_ADMIN){
                continue;
            }
            $collection->put($key, Helpers::readableText($item));
        }
        return $collection->toArray();
    }
}
