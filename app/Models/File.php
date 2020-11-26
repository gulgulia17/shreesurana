<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "name", "description", "file", "extracted", "companies_id"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function companies()
    {
        return $this->belongsTo(Company::class);
    }

    public function data()
    {
        return $this->hasMany(\App\Models\Data::class);
    }
}
