<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'response_id', 'data_id', 'later', 'user_id', 'remark', 'closed'
    ];
    protected $appends = ['is_allowed'];

    public function getIsAllowedAttribute()
    {
        if (isset($this->later)) {
            if ($this->user->id == auth()->id()) {
                return Carbon::parse($this->later)->format('Y-m-d H:i') > Carbon::now()->format('Y-m-d H:i');
            }
        }
        return true;
    }

    public function data()
    {
        return $this->belongsTo(Data::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
