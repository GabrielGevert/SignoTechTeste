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

        return back();
    }

    public function index() 
    {
        $polls = auth()->user()->polls()->select('title', 'status', 'id')->paginate(10);

        return view('dashboard', compact('polls'));
    }

    public function edit(Poll $poll)
    {
        $poll = $poll->load('options');
        return view('polls.editPoll', compact('poll'));
    }

    public function update(UpdatePollRequest $request, Poll $poll) 
    {
        $data = $request->safe()->except('option');

        $poll->update($data);

        $poll->options()->delete();

        $poll->options()->createMany($request->option);

        return redirect()->route('dashboard');
    }

    public function delete(Poll $poll) 
    {
        if ($poll->status != PollStatus::PENDING->value) {
            abort(404, 'Enquete não pendente');
        }
        
        $poll->options()->delete();

        $poll->delete();
        
        return back();
    }

    public function show(Poll $poll)
    {
        $poll = $poll->load('options');

        if (auth()->check() && auth()->user()->id) {
            return view('polls.showPoll', compact('poll'));
        }

        abort_if($poll->status != PollStatus::STARTED->value, 404);

        return view('polls.showPoll', compact('poll'));
    }


}
