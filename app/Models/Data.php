<?php

namespace App\Models;

use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Data extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_data');
    }

    public function files()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function lead()
    {
        return $this->hasOne(Lead::class);
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
