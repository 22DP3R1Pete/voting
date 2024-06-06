<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteUser extends Model
{
    protected $fillable = ['vote_id', 'user_id'];

    protected $table = 'vote_users';
    protected $primaryKey = ['vote_id', 'user_id'];

    public $timestamps = true;

    public function vote()
    {
        return $this->belongsTo(Vote::class, 'vote_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function index()
{
    $user = Auth::user();
    $votes = Vote::all();
    $votedOptions = $user->voteUsers()->pluck('vote_id')->toArray();

    return Inertia::render('Dashboard', [
        'votes' => $votes,
        'votedOptions' => $votedOptions,
    ]);
}
}
