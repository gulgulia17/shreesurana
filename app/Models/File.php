<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        "name", "description", "file","extracted"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function data()
    {
        return $this->hasMany(\App\Models\Data::class);
    }
}
