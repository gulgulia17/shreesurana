<?php

namespace App\Models;

use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_data');
    }

    public function files()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
