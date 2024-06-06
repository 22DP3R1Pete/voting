<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vote extends Model
{
    protected $fillable = [
        'title', 'description', 'expiry_date', 'creator', 'user_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($vote) {
            $vote->creator = Auth::user()->email;
        });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function options()
    {
        return $this->hasMany(VoteOption::class);
    }
}
