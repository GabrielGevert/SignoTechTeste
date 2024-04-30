<?php

namespace App\Http\Controllers;

use App\Enums\PollStatus;
use App\Http\Requests\CreatePollRequest;


class PollController extends Controller
{
    public function store(CreatePollRequest $request)
    {

        $poll = auth()->user()->polls()->create($request->safe()->except('option'));
        // dd($request->option);

        $poll->options()->createMany($request->option);

        return back();
    }
}
