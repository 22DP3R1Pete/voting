<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteOption extends Model
{
    protected $fillable = ['name'];
    protected $primaryKey = 'id';

    public function vote()
    {
        return $this->belongsTo(Vote::class);
    }
}
