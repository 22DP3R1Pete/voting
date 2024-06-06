<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Vote;
use App\Models\VoteOption;

class DashboardController extends Controller
{
    public function index()
    {
        $votes = Vote::all();
        $voteOptions = VoteOption::all(); 
        
        return Inertia::render('Dashboard', [
            'votes' => $votes,
            'voteOptions' => $voteOptions,
        ]);
    }
}