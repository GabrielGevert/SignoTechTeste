<?php

namespace App\Http\Controllers;

use App\Enums\PollStatus;
use App\Http\Requests\CreatePollRequest;
use App\Http\Requests\UpdatePollRequest;
use App\Http\Requests\VoteRequest;
use App\Models\Option;
use App\Models\Poll;
use App\Models\Vote;



class PollController extends Controller
{
    public function store(CreatePollRequest $request)
    {
        // dd($request->all());
        $poll = auth()->user()->polls()->create($request->safe()->except('option'));
        

        $poll->options()->createMany($request->option);

        return redirect()->route('dashboard');
    }

    public function index() 
    {
        $polls = auth()->user()->polls()->select('title', 'status', 'id')->paginate(10);

        return view('dashboard', compact('polls'));
    }

    public function edit(Poll $poll)
    {
        abort_if($poll->status != PollStatus::NAO_INICIADA->value, 404);

        $poll = $poll->load('options');
        return view('polls.editPoll', compact('poll'));
    }

    public function update(UpdatePollRequest $request, Poll $poll) 
    {
        abort_if($poll->status != PollStatus::NAO_INICIADA->value, 404);

        $data = $request->safe()->except('option');

        $poll->update($data);

        $poll->options()->delete();

        $poll->options()->createMany($request->option);

        return redirect()->route('dashboard');
    }

    public function delete(Poll $poll) 
    {
        // if ($poll->status != PollStatus::NAO_INICIADA->value) {
        //     abort(404, 'Enquete não pendente');
        // }

        // Comentário acima -> caso excluir tabela apenas quando estiver pendente, descomentar.
        
        if ($poll->votes()->exists()) {

            $poll->votes()->delete();
        }

        $poll->options()->delete();

        

        $poll->delete();
        
        return back();
    }

    public function show(Poll $poll)
    {
        $poll = $poll->load('options');
        
        $selectedOptionContent = null;

        if (auth()->check()) {
            $userVoted = $poll->votes()->where('user_id', auth()->id())->exists();
            
            if ($userVoted) {
                $selectedOptionId = $poll->votes()->where('user_id', auth()->id())->first()->option_id;
                $selectedOption = Option::find($selectedOptionId);
                $selectedOptionContent = $selectedOption ? $selectedOption->content : null;
            }
        }
        
        return view('polls.showPoll', compact('poll', 'selectedOptionContent'));
    }



    public function vote(VoteRequest $request, Poll $poll)
    {
        abort_if($poll->status != PollStatus::EM_ANDAMENTO->value, 404);

        $vote = $poll->votes()->updateOrCreate(['user_id' => auth()->id()], ['option_id' => $request->option_id]);

        $newOption =  Option::find($request->option_id);
        $newOption->increment('votes_count');

        if ($vote->wasRecentlyCreated) {
            $selectedOption = $newOption;
        } else {
            $selectedOption = $vote->option;
            $selectedOption->decrement('votes_count');
        }

        return back()->with('selectedOption', $selectedOption);
    }   
}
