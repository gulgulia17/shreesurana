<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'number', 'api_token', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function findById($id)
    {
        return parent::findorFail($id);
    }

    public static function findByNumber($number)
    {
        return parent::where('number', $number);
    }

    public function setUsernameAttribute($value)
    {
        $name = substr($this->attributes['name'], 0, 3);
        $number = substr($this->attributes['number'], 0, 4);

        $username = $name . $number;
        $i = 0;
        while (User::whereUsername($username)->exists()) {
            $i++;
            $username = $name . $number . $i;
        }

        $this->attributes['username'] = $username;
    }
}
