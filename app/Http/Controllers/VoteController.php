<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Vote;
use App\Models\VoteUser;
use App\Models\VoteOption;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function create()
    {    
       
        return Inertia::render('CreateVote', [
            'status' => session('status'),
            'creator' => Auth::user()->email,
        ]);
        
    }


    public function vote(Request $request, $voteId, $optionId)
    {
        $user = $request->user();

        $existingVote = VoteUser::where('user_id', $user->id)
            ->where('vote_id', $voteId)
            ->exists();

        if ($existingVote) {
            return redirect()->back()->with('error', 'Jūs jau balsojat.');
        }

        VoteUser::create([
            'user_id' => $user->id,
            'vote_id' => $voteId,
            'vote_option_id' => $optionId,
        ]);

        return redirect()->back()->with('success', 'Jūs nobalsojāt.');
    }


    public function store(Request $request)
    {
        
        $user = Auth::user();
    
        
        $validatedData = $request->validate([
            'title' => 'required|string|min:50|max:255',
            'description' => 'required|string|min:50|max:1000',
            'expiryDate' => 'required|date',
            'options' => 'required|array|min:1',
            'options.*.name' => 'required|string|max:255'
        ]);
    
        
        $vote = new Vote();
        $vote->user_id = $user->id;
    
        
        $vote->title = $validatedData['title'];
        $vote->description = $validatedData['description'];
        $vote->expiry_date = $validatedData['expiryDate'];
    
        
        $vote->save();
    
        
        foreach ($validatedData['options'] as $optionData) {
            $vote->options()->create([
                'name' => $optionData['name']
            ]);
        }
    }
    
    public function vstore(Request $request, $id)
{

    $userId = Auth::id();


    if ($id !== null) {
 
        $voteUser = new VoteUser();
        $voteUser->vote_id = $id; 
        $voteUser->user_id = $userId;
        $voteUser->save();

        
        return response()->json(['message' => 'Голос успешно сохранен'], 200);
    } else {
        
        return response()->json(['error' => 'Идентификатор голосования отсутствует'], 400);
    }
}
   
}
