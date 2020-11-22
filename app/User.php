<?php

namespace App;

use App\Models\Lead;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasRoles, HasMediaTrait, SoftDeletes;

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

    public function files()
    {
        return $this->belongsToMany(Models\File::class);
    }

    public function data()
    {
        return $this->belongsToMany(Models\Data::class, 'user_data');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function setUsernameAttribute($value)
    {
        $username = \Illuminate\Support\Str::snake(strtolower($this->attributes['name']));

        for ($i = 1; 1 == User::withTrashed()->whereUsername($username)->exists(); $i++) {
            $username = \Illuminate\Support\Str::snake(strtolower($this->attributes['name'])) . "_{$i}";
        }

        $this->attributes['username'] = $username;
    }
}
