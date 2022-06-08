<?php

namespace App\Traits;

use App\Models\User;
use VIITech\Helpers\GlobalHelpers;

class Helpers
{
    /**
     * Allowed Admin Users
     * @param $allow_type
     * @return bool
     */
    public static function allowedAdminUsers($allow_type){
        /** @var User $user */
        $user = backpack_auth()->user();
        if(is_null($user)){
            return false;
        }
        $user_type = $user->type_id;
        if(!GlobalHelpers::isValidVariable($user_type)){
            return false;
        }
        if(!is_array($allow_type) && $user_type == $allow_type){
            return true;
        }else if(is_array($allow_type) && in_array($user_type, $allow_type)){
            return true;
        }
        return false;
    }
}
