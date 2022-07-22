<?php

namespace App\Http\Controllers;

use App\Models\{Poll, Question};
use App\Http\Requests\StorePollRequest;
use App\Http\Requests\UpdatePollRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(10);

        return view('home', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('poll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePollRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $poll = Poll::create([
            'title' => $request->title,
            'status' => $request->status ? true : false,
            'slug' => $request->slug,
            'user_id' => Auth::id(),
        ]);

        foreach($request->question as $key=>$question)
        {
            Question::create([
                'question' => $question,
                'answer' => 'x',
                'type' => $request->type[$key],
                'order' => $key,
                'poll_id' => $poll->id,
            ]);
        }

        return redirect(route('poll.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePollRequest  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePollRequest $request, Poll $poll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        //
    }
}
