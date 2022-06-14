<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Helpers;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canAccessFilament(): bool
    {
        return true;
    }

    /**
     * Create or Update
     * @param array $data
     * @param array|null $find_by
     * @return static|null
     */
    public static function createOrUpdate(array $data, $find_by = null)
    {
        try {
            $item = null;
            if(!is_null($find_by)){
                $q = static::query();
                foreach ($find_by as $key){
                    if ($key == Attributes::EMAIL) {
                        $value = Str::lower($data[$key]);
                    }else{
                        $value = $data[$key];
                    }
                    $q = $q->where($key, $value);
                }
                $item = $q->withTrashed()->first();
            }
            if (is_null($item)) {
                $item = new static();
            }else if (!is_null($item->deleted_at)) {
                $item->restore();
            }
            $item->fill($data);
            if ($item->save()) {
                return $item;
            }
            return null;
        } catch (Exception $e) {
            Helpers::captureException($e);
            return null;
        }
    }

}
