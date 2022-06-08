<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Traits\ModelTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use VIITech\Helpers\Constants\CastingTypes;

/**
 * Class User
 * @package App\Models
 */
class User extends CustomModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, Notifiable, CrudTrait, ModelTrait;

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
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->setPassword($value);
    }
}
