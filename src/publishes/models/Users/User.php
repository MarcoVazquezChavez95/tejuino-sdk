<?php

namespace App\Models\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tejuino\Admin\Traits\HasFiles;
use Tejuino\Admin\Traits\HasHash;

class User extends Authenticatable
{
    use Notifiable, HasHash, HasFiles;

    protected $fillable = [
        'role_id', 'name', 'last_name', 'email', 'password', 'image'
    ];
    protected $file_dir = 'files/users/';


    /** BOOT */

    protected static function boot()
    {
        parent::boot();

        static::created(function($user){
            $user->createHash();
            $user->createFolder();
        });
    }


    /** ATTRIBUTES */

    public function getImageAttribute($value)
    {
        return $this->getUrl($value, 'default.png');
    }

    public function isAdmin()
    {
        return $this->role_id == 4 || $this->role_id == 5;
    }

    public function isSuper()
    {
        return $this->role_id == 5;
    }


    /** SCOPES */

    public function scopeDetailed($query)
    {
        return $query->with([
            'role'
        ]);
    }

    public function scopeWhereUser($query)
    {
        return $query->where('role_id', 1);
    }

    public function scopeWhereAdmin($query)
    {
        return $query->whereIn('role_id', [4, 5]);
    }

    public function scopeFromFacebook($query)
    {
        return $query->where('registration_mode', 'facebook');
    }

    public function scopeFromEmail($query)
    {
        return $query->where('registration_mode', 'email');
    }


    /** RELATIONSHIPS */

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
