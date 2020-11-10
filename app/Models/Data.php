<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $guarded = [];
    
    public function users()
    {
        return $this->belongsToMany(User::class,'user_data');
    }

    public function files()
    {
        return $this->belongsTo(File::class);
    }
}
