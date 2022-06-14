<?php

namespace App\Models;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Traits\ModelTrait;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use VIITech\Helpers\Constants\CastingTypes;

/**
 * Class User
 * @package App\Models
 *
 * @property int user_type
 */
class User extends CustomModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, FilamentUser
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, Notifiable, ModelTrait;
    use HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        Attributes::NAME,
        Attributes::EMAIL,
        Attributes::USER_TYPE,
        Attributes::PASSWORD,
        Attributes::STATUS,
        Attributes::EMAIL_VERIFIED_AT,
    ];

    protected $casts = [
        Attributes::NAME => CastingTypes::STRING,
        Attributes::EMAIL => CastingTypes::STRING,
        Attributes::USER_TYPE => CastingTypes::INTEGER,
        Attributes::PASSWORD => CastingTypes::STRING,
        Attributes::STATUS => CastingTypes::INTEGER,
        Attributes::EMAIL_VERIFIED_AT => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        Attributes::PASSWORD,
        Attributes::REMEMBER_TOKEN,
    ];

    /**
     * Set Attribute: password
     * @param $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->setPassword($value);
    }

    /**
     * Can Access Filament
     * @return bool
     */
    public function canAccessFilament(): bool
    {
        return true;
    }

    /**
     * Can Access
     * @return boolean
     */
    function canAccess($user_type){
        if($user_type == AdminUserType::SUPER_ADMIN){
            return $this->user_type === AdminUserType::SUPER_ADMIN;
        }
        return $this->user_type === AdminUserType::SUPER_ADMIN || $this->user_type === $user_type;
    }
}
